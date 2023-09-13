<?php
namespace Nari;
use App\Models\Car;
use App\Models\Category;
use App\Models\Passenger;
use App\Models\Trip;
use Nari\Interface\PdfInterface;
use Dompdf\Dompdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Pdf implements PdfInterface
{
    public $passenger_id;

    public $trip_id;
    /**
     * Generating pdf
     *
     *
     */
    public function generatePDF()
    {
        //for passengers information
        $passenger = Passenger::findOrFail($this->passenger_id);
        //for trip information
        $trip = Trip::findOrFail($this->trip_id);
        //get trip categories
        $flotte = Category::findOrFail($trip->flote);
        // Convert date of depart
        $date = strtotime($trip->date_depart);
        //car plate_number
        $car = Car::findOrFail($trip->car);

        $array = [
            'compagnie' => 'Travel Pulse Caravan',
            'flote' => $flotte->flotte,
            'trajet' => $trip->place_depart .'-'.$trip->place_arrivals,
            'heure de départ' => date('D d M Y', $date),
            'Immatriculation' => $car->plate_number,
            'nom du passager' => $passenger->name,
            'prenon du passager' => $passenger->last_name,
            'telephone du passager' => $passenger->phone_number,
            'email du passager' => $passenger->email
        ];

        $items = [];
        foreach ($array as $key => $value) {
            $items[] = "$key: $value";
        }

        $string = implode("\n", $items);

        $qrCode = QrCode::size(125)
                        ->color(200, 150, 0)
                        ->generate($string);

        $carDepart = date('D d M Y', $date);
        // Générer le contenu HTML pour le PDF
        $html = view('pdf.reservation', [
            'car' => $car,
            'passenger' => $passenger,
            'qrCode' => $qrCode,
            'trip' => $trip,
            'flotte' => $flotte,
            'carDepart' => $carDepart
        ])->render();



        // Générer le PDF avec Dompdf
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A5', 'landscape');
        $pdf->render();

        // Retourner le PDF en tant que réponse HTTP
        return $pdf->stream('reservation_'.$trip->id.'_'.$passenger->id.'_'.$car->brand.'.pdf');
    }

    public function __construct($passenger_id, $trip_id)
    {
        $this->passenger_id = $passenger_id;
        $this->trip_id = $trip_id;
    }
}
