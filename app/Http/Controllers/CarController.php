<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Models\CarInformation;
use App\Models\Category;
use App\Models\PlaceNumber;
use App\Models\Statement;
use Barryvdh\DomPDF\PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Dompdf\Dompdf;
use Dompdf\Options;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CarController extends Controller
{
    /**
     * Return an view of all car in the compagny
     *
     * @return View
     */
    public function index(): View
    {
        $car = Car::orderBy('id', 'asc')->paginate(15);
        return view($this->path().'index', [
            'car' => $car
        ]);
    }

    /**
     * this is used to join the adding new car view
     *
     * @return View
     */
    public function create(): View
    {
        $category = Category::pluck('flotte', 'id');
        $car = New Car();
        $statement = Statement::pluck('state');
        $place = PlaceNumber::pluck('place');
        return view($this->path().'action.random', [
            'car' => $car,
            'category' => $category,
            'statement' => $statement,
            'place' => $place
        ]);
    }

    

    /**
     * Action todo when user insert the car information in database
     *
     * 
     * @param CarRequest $request
     * @return RedirectResponse
     */
    public function store(CarRequest $request): RedirectResponse
    {
        try {
            /** @var $data //nedeed to get validated request */
            $data = $request->validated();
            //Insert the information in dataBase
            $car = Car::create($data);
            //relation n-n to category-car
            $car->category()->sync(['car_id' => $car->id], $request->validated('category'));
            //about the media
            if ($request->hasFile('media')) {
                try {
                    // Add the uploaded media to the 'home_collection' collection on the specified disk
                    $media = $car->addMedia($request->file('media'))
                        ->toMediaCollection('car_info', 'public'); // Change 'disk_name' to the actual disk name
                    //storage Path
                    $storagePath = $media->getPath();
                    $car->update(['media'=> $storagePath]);
                    // You can also set additional media properties here if needed
                } catch (\Exception $mediaException) {
                    // Handle media-related exceptions
                    throw new \Exception('An error occurred while adding media: ' . $mediaException->getMessage());
                }
            }
            
            return redirect()->route($this->routes().'index')->with('success', 'Ajout réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'create')->with('error', 'Une erreur s\'est survenu' . $e->getMessage());
        }
    }


    /**
     * return An instance of Car in the edition
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $car = Car::findOrFAil($id);
        $statement = Statement::pluck('state');
        $category = Category::pluck('flotte', 'id');
        $mediaCollection = Media::where('collection_name', 'car_info')
                                        ->where('model_type', Car::class)
                                        ->where('model_id', $id)
                                        ->get();
        $place = PlaceNumber::pluck('place');
        return view($this->path().'action.random', [
            'car' => $car,
            'category' => $category,
            'mediaCollection' => $mediaCollection,
            'statement' => $statement,
            'place' => $place
        ]);
    }


    /**
     * To do When we need to update an information
     *
     * @param Car $car
     * @param string $id
     * @param CarUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(Car $car, string $id, CarUpdateRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $car = Car::findOrFail($id);
            $car->update($data);
            $car->category()->sync(['car_id' => $car->id], $request->validated('category'));
            if (!empty($request->hasFile('media'))) {
                try {
                    // used to delete an old  media files when update action is on 
                    $delete = Media::where('collection_name', 'car_info')
                                        ->where('model_type', Car::class)
                                        ->where('model_id', $id)
                                        ->delete();
                    // Add the uploaded media to the 'home_collection' collection on the specified disk
                    $media = $car->addMedia($request->file('media'))
                        ->toMediaCollection('car_info', 'public'); // Change 'disk_name' to the actual disk name
                    //Now we store the new files in the home_admins entities
                    $storagePath = $media->getPath();
                    $car->update(['media'=> $storagePath]);    
                    // You can also set additional media properties here if needed
                } catch (\Exception $mediaException) {
                    // Handle media-related exceptions
                    throw new \Exception('An error occurred while adding media: ' . $mediaException->getMessage());
                }
            }
            return redirect()->route($this->routes().'edit', ['id' => $id])->with('success', 'Modification réussi');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'edit', ['id' => $id])->with('error', 'Erreur lors de la modification' . $e->getMessage());
        }
    }


    /**
     * Nedeed to delete an car information
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function delete(string $id): RedirectResponse
    {
        try {
            $home = Car::findOrFail($id);
           

            // Supprimer le fichier média associé du stockage s'il existe
            if ($home->media) {
                
                if (Storage::disk('public')->exists($home->media)) {
                     Storage::disk('public')->delete($home->media);           
                }
            }
            
            // Supprimer l'objet HomeAdmin lui-même
            $home->delete();

            return redirect()->route($this->routes(). 'index')->with('success', 'Suppression réussie');
        } catch (\Exception $e) {
            return redirect()->route($this->routes(). 'index')->with('error', 'une erreur c\'est survenu lors de la suppréssion');
        }
    }

    /**
     * Return an information car by car-
     *
     * @param string $id
     * @return View
     */
    public function view(string $id): View 
    {
        $car = Car::findOrFail($id);
        $mediaCollection = Media::where('collection_name', 'car_info')
                                        ->where('model_type', Car::class)
                                        ->where('model_id', $id)
                                        ->get();
        $category = Category::findOrFail($car->category)->value('flotte');
        $flote = Category::where('id', $car->category)
                                    ->value('flotte');
        $carIn = CarInformation::where('car', $id)
                            ->value('id');
        $carInformation = CarInformation::findOrFail($carIn);
        //convertion stringe to date
        $date = strtotime($carInformation->maintains);
        $array = [
            'Model' => $car->model,
            'Marque' => $car->brand,
            'kilometrage' => number_format($carInformation->kilometers, thousands_separator:' '). 'Km ',
            'Capacité de la réservoir' => $carInformation->max_fuel . 'l',
            'poid minimale' => number_format($carInformation->min_weight, thousands_separator: ' '). ' Kg',
            'poid maximale' => number_format($carInformation->max_weight, thousands_separator: ' '). ' Kg',
            'Immatriculation' => $car->plate_number,
            'Nombre de place' => $car->place,
            'Année de sortie' => $car->year,
            'date d\'expiration Visite technique' => date('D d M Y', $date),
            'flote' => $flote,
            'compagnie' => 'Travel Pulse Caravan'
        ];
            $items = [];
        foreach ($array as $key =>$value) {
            $items[]= "$key: $value"; 
        }
        $string = implode("\n", $items);
        
        $qrCode = QrCode::size(150)
                            ->color(0,0,0)
                            ->generate($string);
       
        return view($this->path(). 'view.view', [
            'car' => $car,
            'mediaCollection' => $mediaCollection,
            'qrCode' => $qrCode
        ]);
    }
    

    public function generatePDF(string $id)
    {
        $car = Car::findOrFail($id);
        $mediaCollection = Media::where('collection_name', 'car_info')
                                ->where('model_type', Car::class)
                                ->where('model_id', $id)
                                ->get();
        $category = Category::findOrFail($car->category)->value('flotte');
        $carIn = CarInformation::where('car', $id)
                            ->value('id');
        $carInformation = CarInformation::findOrFail($carIn);
        $flote = Category::where('id', $car->category)
                                    ->value('flotte');
    
        // Convertir la date en timestamp
        $date = strtotime($carInformation->maintains);
    
        $array = [
            'Model' => $car->model,
            'Marque' => $car->brand,
            'kilometrage' => number_format($carInformation->kilometers, 0, '.', ' ') . ' Km',
            'Capacité de la réservoir' => $carInformation->max_fuel . 'l',
            'poid minimale' => number_format($carInformation->min_weight, 0, '.', ' ') . ' Kg',
            'poid maximale' => number_format($carInformation->max_weight, 0, '.', ' ') . ' Kg',
            'Immatriculation' => $car->plate_number,
            'Nombre de place' => $car->place,
            'Année de sortie' => $car->year,
            'date d\'expiration Visite technique' => date('D d M Y', $date),
            'flote' => $flote,
            'compagnie' => 'Travel Pulse Caravan'
        ];
    
        $items = [];
        foreach ($array as $key => $value) {
            $items[] = "$key: $value";
        }
    
        $string = implode("\n", $items);
    
        $qrCode = QrCode::size(150)
                        ->color(0, 0, 0)
                        ->generate($string);
                        
    
        // Générer le contenu HTML pour le PDF
        $html = view($this->path().'pdf.index', [
            'car' => $car,
            'mediaCollection' => $mediaCollection,
            'qrCode' => $qrCode,
            'carInformation' => $carInformation
        ])->render();

        
    
        // Générer le PDF avec Dompdf
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
    
        // Retourner le PDF en tant que réponse HTTP
        return $pdf->stream($car->model.'_'.$car->brand.'.pdf');
    }
    

    /**
     * Private function who is very nedded because this return a instance of fileViewPath
     *
     * @return string
     */
    private function path(): string
    {
        $path = 'admin.entreprise.flote.car.';
        return $path;
    }

    /**
     * Private function who return an instance of routes
     *
     * @return string
     */
    private function routes():string 
    {
        $routes = 'Admin.Entreprise.flote.car.';
        return $routes;
    }
}
