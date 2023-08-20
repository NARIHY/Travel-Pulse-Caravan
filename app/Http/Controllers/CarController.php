<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
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
        return view($this->path().'action.random', [
            'car' => $car,
            'category' => $category
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
        $category = Category::pluck('flotte', 'id');
        $mediaCollection = Media::where('collection_name', 'car_info')
                                        ->where('model_type', Car::class)
                                        ->where('model_id', $id)
                                        ->get();
        return view($this->path().'action.random', [
            'car' => $car,
            'category' => $category,
            'mediaCollection' => $mediaCollection
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
