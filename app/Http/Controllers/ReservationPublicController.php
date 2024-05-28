<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationRequest;
use App\Http\Requests\PassengerRequest;
use App\Mail\UserReservationMail;
use App\Models\Car;
use App\Models\Passenger;
use App\Models\Travel;
use App\Models\Trip;
use Barryvdh\DomPDF\Facade\Pdf;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
//use Nari\Reservation\Reservation;
use Dompdf\Dompdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ReservationPublicController extends Controller
{
    /**
     * Return Public reservation view
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $trip = Trip::where('date_depart', '>=', now())
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
        return view('public.reservation.index', [
            'trip' => $trip
        ]);
    }

    /**
     * Carview
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function car(string $id): View
    {
        $car = Car::findOrFail($id);
        $media = Media::where('collection_name', 'car_info')
                                        ->where('model_type', Car::class)
                                        ->where('model_id', $id)
                                        ->get();
        return view('public.reservation.car',[
            'car' => $car,
            'media' => $media
        ]);
    }

    /**
     * begin view of reservation
     *
     * @return View
     */
    public function passenger(string $tripId, string $carId): View
    {
        return view('public.reservation.client.passenger', [
            'tripId' => $tripId,
            'carId' => $carId
        ]);
    }

    /**
     * Add a passenger to the passenger list with email verification.
     * verify if the are place in the reservation
     * return an email with pdf attachement
     *
     *
     * @param PassengerRequest $request
     * @return RedirectResponse
     */
    public function passenger_add(PassengerRequest $request, string $tripId, string $carId): RedirectResponse
    {
        try {
            // Get the validated data from the request
            $data = $request->validated();
            // Get the email address from the validated data
            $email = $data['email']; // Use $data instead of $request->validated('email')

            // Create an instance of the email validator
            $validator = new EmailValidator();
            // Configure multiple validations to apply (RFCValidation and DNSCheckValidation)
            $multipleValidations = new MultipleValidationWithAnd([
                new RFCValidation(),
                new DNSCheckValidation()
            ]);
            // Check if the email address is valid using the configured validations
            if ($validator->isValid($email, $multipleValidations)) {
                // The email address is valid
                // Check if the traveler's phone number is the same as the emergency contact's
                if ($data['phone_number'] === $data['emergency_contact']) {
                    return redirect()->route('Public.Reservation.Auth.passenger', ['tripId' => $tripId, 'carId' => $carId])->with('error', 'The two numbers must not match');
                }
                //Verify if the email already exists in the reservation
                //get every email
                $emailGet = \App\Models\Reservation::where('trip_id', $tripId)
                                                        ->where('stat', '!=', 'abord')
                                                        ->get();
                foreach($emailGet as $emails) {
                    $passengersId = Passenger::findOrFail($emails->passenger_id);
                    // if true -> error redirections
                    if($passengersId->email === $email) {
                        return redirect()->route('Public.Reservation.Auth.passenger', ['tripId' => $tripId, 'carId' => $carId])->with('error', 'The passenger cannot register twice in this reservation');
                    }
                }
                // Verify if there are already places
                try {
                    $verify = new \Nari\Reservation\Reservation($tripId, $carId);
                    $verif = $verify->verify();
                } catch (\Exception $e) {
                    // Enregistrez l'exception dans les journaux Laravel pour le débogage
                    \Log::error('Error verifying the reservation: ' . $e->getMessage());
                    // Vous pouvez également afficher un message d'erreur personnalisé ici si nécessaire
                    $verif = false; // Par exemple
                }
                // If true, redirect
                if ($verif === true) {
                    return redirect()->route('Public.Reservation.Auth.passenger', ['tripId' => $tripId, 'carId' => $carId])->with('error', 'Oops, reservation is no longer available');
                }
                // Create an instance of the Passenger model with the validated data
                $passenger = Passenger::create($data);
                //Add user id to the passenger
                $user = Auth::user();
                $u = [
                    'user_id' => $user->id
                ];
                $passenger->update($u);
                // Generate a random token of 32 bytes (256 bits)
                $token = bin2hex(random_bytes(32));
                // Hash the token using SHA-256
                $securityTicket = hash('sha256', $token);
                $datas = [
                    'trip_id' => $tripId,
                    'passenger_id' => $passenger->id,
                    'reservation_date' => now(),
                    'reservation_status' => 'reserve', // Fixed a typo here
                    'identification' => $securityTicket
                ];
                // Create a Reservation instance
                $reservation = \App\Models\Reservation::create($datas);
                // Redirect to the success page with parameters and a success message
                return redirect()->route('Public.Reservation.Auth.telma', ['reservationId' => $reservation->id]);
            } else {
                // The email address is not valid
                return redirect()->route('Public.Reservation.Auth.passenger', ['tripId' => $tripId, 'carId' => $carId])->with('error', 'The email address you entered is invalid or does not exist');
            }
        } catch (\Exception $e) {
            // In case of an error, redirect with an error message
            return redirect()->route('Public.Reservation.Auth.passenger', ['tripId' => $tripId, 'carId' => $carId])->with('error', 'An error has occurred : ' . $e->getMessage());
        }
    }


    /**
     * active when user validate information on reservation
     * @param string $reservationId
     * @return \Illuminate\View\View
     */
    public function success(string $reservationId): View
    {
        $reservation = \App\Models\Reservation::findOrFail($reservationId);
        $qrCode = QrCode::size(175)
                        ->color(200, 150, 0)
                        ->generate($reservation->identification);
        $trip = Trip::findOrFail($reservation->trip_id);
        $passenger = Passenger::findOrFail($reservation->passenger_id);
        Mail::to($passenger->email)->send(new UserReservationMail($reservation->id));
        return view('public.reservation.client.success', [
            'reservation' => $reservation,
            'qrCode' => $qrCode,
            'trip' => $trip,
            'passenger' => $passenger
        ]);
    }

    /**
     * generate pdf from ticke attachement to mail
     * @param mixed $reservationId
     * @return mixed
     */
    public function generatePDF($reservationId)
    {
        $reservation = \App\Models\Reservation::findOrFail($reservationId);
        $qrCode = QrCode::size(175)
                        ->color(200, 150, 0)
                        ->generate(route('Admin.Verification.Passenger.view',['identification' => $reservation->identification]));
        $trip = Trip::findOrFail($reservation->trip_id);
        $passenger = Passenger::findOrFail($reservation->passenger_id);

        // Générer le contenu HTML pour le PDF
        $html = view('pdf.pdfReservation', [
            'reservation' => $reservation,
            'qrCode' => $qrCode,
            'trip' => $trip,
            'passenger' => $passenger
        ])->render();

        // Générer le PDF avec Dompdf
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A5', 'landscape');
        $pdf->render();

        return $pdf->stream('reservation_'.$reservation->id.'_'.$passenger->id.'.pdf');
    }


    /**
     * Just change these when you are in a go Live //production
     * Payements with mobile money in scandbox
     * No interfaces but you can add view for it
     * @param string $reservationId
     * @return RedirectResponse
     */
    public function telma(string $reservationId)
    {
        //important function that generates X-Coretionnal-id
        function generateRandomCorrelationId() {
            // You can customize your correlation ID generation here
            return 'CORR-' . uniqid();
        }
        //verry important
        $reservation = \App\Models\Reservation::findOrFail($reservationId);
        // Replace the following information with your real access and application data
        $customerKey = '';
        $customerSecret = '';
        $accessToken = '';
        // API URL
        //https://devapi.mvola.mg/mvola/mm/transactions/type/merchantpay/1.0.0/
        // scandbox api
        $credentials = base64_encode($customerKey . ':' . $customerSecret);
        $correlationId = 'X-CorrelationId: ' . generateRandomCorrelationId();
        //$url = 'https://devapi.mvola.mg/token';
        $apiUrl = 'https://devapi.mvola.mg/$accessToken'; // Replace with the actual token URL
        // You can customize the reference format
        $originalTransactionReference = 'TX' . uniqid();
        // Data you want to send in the POST request (in JSON format for example)
        $postData = json_encode([
            'amount' => 5000, // Replace with the transaction amount
            'currency' => 'Ar', // Replace with currency code
            'descriptionText' => 'Achat d\'un ticket de reservation', // Replace with description
            'requestDate' => '2023-10-13T12:00:00.000Z', // Replace with transaction date
            'debitParty' => '0343500003', // Replace with the customer's phone number
            'creditParty' => '0343500004', // Replace with the merchant's phone number
            'metadata' => [
                'partnerName' => 'Travel Pulse Caravan', // Replace with partner name
                'requestingOrganisation' => 'Transaction Reference', // Replace with the transaction reference
                'originalTransactionReference' => $originalTransactionReference, // Random transaction references
                'fc' => 'USD', // Replace with foreign currency
                'amountFc' => 100.50, // Replace with amount based on foreign currency
            ]
        ]);
        //Initialisation of curl
        $curl = curl_init($apiUrl);
        // Configuring cURL options
        $headers = [
            'Authorization: Bearer ' . $accessToken, // Use the token in the Bearer header
            //correlationId, instanciation in the amount variable
            $correlationId,
            //languages Fr or Mg
            'UserLanguage: MG',
            //Types
            'Content-Type: application/json', // Specify the content type in JSON
            //callback url if success | change if you need to change it
            'X-Callback-URL: http://caravan.briqueweb.com/',
            //appliaction cache
            'Cache-Control: no-cache'
        ];
        // Set cURL to return the response as a string instead of directly outputting it.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Configure cURL to perform a POST request.
        curl_setopt($curl, CURLOPT_POST, 1);
        // Set the data to be sent in the POST request. The data is stored in the $postData variable.
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        // Set the HTTP headers for the request, which are defined in the $headers array.
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // curl response
        $response = curl_exec($curl);
        //If no response
        if ($response === false) {
            die('Erreur cURL : ' . curl_error($curl));
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        //If it's finished then redirect to a callBack url || it doesn't work in the scandbox
        //but if you need to verify these if success or not get the response code
        // Check if the HTTP request was successful (usually 200 OK)
        if ($httpCode === 200) {
            return redirect()->route('Public.Reservation.Auth.success', ['reservationId' => $reservation->id])->with('success', 'Booking successful');
        } else {
            //if error
            return redirect()->route('Public.Reservation.Auth.success', ['reservationId' => $reservation->id])->with('error', 'Failure');
        }
    }

}
