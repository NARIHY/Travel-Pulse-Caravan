<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestinationRequest;
use App\Http\Requests\PassengerRequest;
use App\Mail\UserReservationMail;
use App\Models\Car;
use App\Models\Category;
use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\Travel;
use App\Models\Trip;
use Dompdf\Dompdf;
use Dompdf\Options;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Nari\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{



    /**
     * list the reservation view where reservation_time > now
     *
     * @return View
     */
    public function index(): View
    {

        $trip = Trip::where('date_depart', '>', now())
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(15);
        return view($this->viewPath().'index', [
            'trip' => $trip
        ]);
    }

    /**
     * begin view of reservation
     *
     * @return View
     */
    public function passenger(): View
    {
        return view($this->viewPath().'passenger.index');
    }

    /**
     * Add a passenger to the passenger list with email verification.
     *
     * @param PassengerRequest $request
     * @return RedirectResponse
     */
    public function passenger_add(PassengerRequest $request): RedirectResponse
    {
        try {
            // Get the validated data from the request
            $data = $request->validated();
            // Get the validated email address from the request
            $email = $request->validated('email');
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
                if ($request->validated('phone_number') === $request->validated('emergency_contact')) {
                    return redirect()->route($this->routes().'create.passenger')->with('error', 'The traveler\'s phone number cannot be the same as the emergency contact\'s');
                }
                // Create an instance of the Passenger model with the validated data
                $passenger = Passenger::create($data);
                // Redirect to the passenger.city page with parameters and a success message
                return redirect()->route($this->routes().'passenger.city', ['passenger_id' => $passenger->id, 'purcount' => 25])->with('success', '25');
            } else {
                // The email address is not valid
                return redirect()->route($this->routes().'create.passenger')->with('error', 'The email address you entered is not valid or does not exist');
            }
        } catch (\Exception $e) {
            // In case of an error, redirect with an error message
            return redirect()->route($this->routes().'create.passenger')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * To get the traveling user information
     * Where is he/she
     * where he/she go
     *
     * @param string $passenger_id
     * @param string $purcount
     * @return View
     */
    public function destination(string $passenger_id, string $purcount) : View
    {
        $city = Travel::pluck('place');
        return view($this->viewPath().'trip.index', [
            'purcount' => $purcount,
            'passenger_id' => $passenger_id,
            'city' => $city
        ]);
    }

    /**
     * Update the information
     *
     * @param DestinationRequest $request
     * @param string $passenger_id
     * @param string $purcount
     * @return RedirectResponse
     */
    public function destination_save(DestinationRequest $request, string $passenger_id, string $purcount): RedirectResponse
    {
        try {
            $place_depart = $request->validated('place_depart');
            $place_arrivals = $request->validated('place_arrivals');
            $purcounts = $purcount + 25;
            return redirect()->route($this->routes().'passenger.city.reserve', ['passenger_id' => $passenger_id, 'purcount' => $purcounts, 'depart' => $place_depart, 'arrivals' => $place_arrivals]);
        } catch(\Exception $e) {
            return redirect()->route($this->route().'passenger.city', ['passenger_id' => $passenger_id, 'purcount' => $purcount])->with('error', 'There was an error saving'.$e->getMessage());
        }
    }
    /**
     * return a reservation view
     * we are at 50%
     *
     * @param string $passenger_id
     * @param string $purcount
     * @param string $depart
     * @param string $arrivals
     * @return View
     */
    public function reservate(string $passenger_id, string $purcount, string $depart, string $arrivals): View
    {
        $trip = Trip::where('date_depart', '>', now())
                        ->orderBy('created_at', 'desc')
                        ->where('place_depart', $depart)
                        ->where('place_arrivals', $arrivals)
                        ->paginate(15);
        //checks if there are place
        return view($this->viewPath().'reservate.index', [
            'purcount' => $purcount,
            'arrivals' => $arrivals,
            'passenger_id' => $passenger_id,
            'depart' => $depart,
            'trip' => $trip
        ]);

    }

    /**
     * Return user to the payement view
     *
     * @param string $passenger_id
     * @param string $purcount
     * @param string $depart
     * @param string $arrivals
     * @param string $tripId
     * @return View
     */
    public function payement(string $passenger_id, string $purcount, string $depart, string $arrivals, string $tripId):View
    {
        return view($this->viewPath().'payement.index', [
            'purcount' => $purcount ,
            'arrivals' => $arrivals,
            'passenger_id' => $passenger_id,
            'depart' => $depart,
            'tripId' => $tripId
        ]);
    }

    /**
     * post payement
     *
     * @param string $passenger_id
     * @param string $purcount
     * @param string $depart
     * @param string $arrivals
     * @param string $tripId
     * @return RedirectResponse
     */
    public function success(string $passenger_id, string $purcount, string $depart, string $arrivals, string $tripId) : RedirectResponse
    {
        //for securisate reservation ticket
        // Generate random token of 32 octets (256 bits)
        $token = bin2hex(random_bytes(32));

        // Hach token le hachage SHA-256 du token
        $securityTicket = hash('sha256', $token);

        $data = [
            'trip_id' => $tripId,
            'passenger_id' => $passenger_id,
            'reservation_date' => date('Y-m-d H:i:s'),
            'reservation_status' => 'reserver',
            'identification' => $securityTicket
        ];
        $passenger = Passenger::findOrFail($passenger_id);
        $reservation = Reservation::create($data);
        Mail::to($passenger->email)->send(new UserReservationMail($reservation->id));
        return redirect()->route($this->routes().'passenger.city.finale', ['purcount' => $purcount + 25,'passenger_id' => $passenger_id, 'tripId' => $tripId]);
    }
    //s
    public function finale(string $purcount, string $tripId, string $passenger_id): View
    {
        return view($this->viewPath().'finale.index', [
            'purcount' => $purcount,
            'tripId' => $tripId,
            'passenger_id' => $passenger_id
        ]);
    }


    /**
     * generate pdf from ticke attachement to mail
     * @param mixed $reservationId
     * @return mixed
     */
    public function generatePDF($reservationId)
{
    $reservation = Reservation::findOrFail($reservationId);
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
     * this is already the same
     * view path directory
     *
     * @return string
     */
    private function viewPath(): string
    {
        $path ="admin.entreprise.trip.reservation.";
        return $path;
    }

    /**
     * routes path directory
     *
     * @return string
     */
    private function  routes(): string
    {
        $routes = "Admin.Entreprise.trip.reservation.";
        return $routes;
    }
}
