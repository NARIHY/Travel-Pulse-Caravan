<?php

namespace App\Http\Controllers;

use App\Http\Requests\InformationRequest;
use App\Http\Requests\InformationUpdateRequest;
use App\Models\Category;
use App\Models\Information;
use App\Models\Tpc;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class InformationController extends Controller
{


    /**
     * list information given in the dashboard
     */
    public function listing(): View
    {
        $information = Information::orderBy('created_at', 'desc')
                                        ->paginate(20);
        return view($this->viewPath().'index', [
            'information' => $information
        ]);
    }

    /**
     * view of creation
     * @return View
     */
    public function create(): View
    {
        //we inject travel pulse caravan
        $tpc = Tpc::where('id', '1')
                    ->value('name');
        $category = Category::pluck('id','flotte');
        return view($this->viewPath().'action.random', [

            'category' => $category
        ]);
    }


    /**
     * TODO - Upload information
     * This is used when users upload pictures or videos in the home create view
     *
     * @param InformationRequest $request
     * @return RedirectResponse
     */
    public function store(InformationRequest $request): RedirectResponse
    {
        try {
            // Step 1: Retrieve validated data from the form
            $data = $request->validated();

            // Step 2: Create a HomeAdmin instance with validated data
            $home = Information::create($data);
            // Step 3: Manage the upload of the image or video
            if ($request->hasFile('media')) {
                try {
                    // Add the uploaded media to the 'home_collection' collection on the specified disk
                    $media = $home->addMedia($request->file('media'))
                        ->toMediaCollection('information_home', 'public'); // Change 'disk_name' to the actual disk name
                    //storage Path
                    $storagePath = $media->getPath();
                    $home->update(['media'=> $storagePath]);
                    // You can also set additional media properties here if needed
                } catch (\Exception $mediaException) {
                    // Handle media-related exceptions
                    throw new \Exception('Oupss, il y a eu une erreur ' . $mediaException->getMessage());
                }
            }
            // Step 4: Redirect with success message
            return redirect()->route($this->routes().'listing')->with('success', 'Création de l\'information réussie');
        } catch (\Exception $e) {
            // Handle general exceptions
            $errorMessage = 'Une erreur est survenue lors de la création de l\'information: ' . $e->getMessage();
            return redirect()->route($this->routes().'create')->with('error', $errorMessage);
        }
    }

    /**
     * deleting information
     * @param string $id
     * @return RedirectResponse
     *
     */
    public function delete(string $id): RedirectResponse
    {
        try {
            $information = Information::findOrFail($id);
            $med = Media::where('model_id', $id)
                                ->where('model_type', Information::class)
                                ->latest('id')
                                ->value('id');
            $media = Media::findOrFail($med);

            // Supprimer le fichier média associé du stockage s'il existe
                if (Storage::disk('public')->exists($media->getUrl())) {
                    Storage::disk('public')->delete($media->getUrl());
                }
            // Supprimer l'objet HomeAdmin lui-même
            $information->delete();

            return redirect()->route('Admin.Information.listing')->with('success', 'Suppression réussie');
        } catch (\Exception $e) {
            return redirect()->route('Admin.Information.listing')->with('error', 'une erreur c\'est survenu lors de la suppréssion'.$e->getMessage());
        }
    }

    /**
     * Display the edit view for a specific information entry.
     *
     * This method retrieves an Information model by its ID, retrieves a list of categories,
     * and retrieves the latest associated media ID for the information entry.
     *
     * @param  string $id The ID of the information entry to be edited.
     * @return \Illuminate\Contracts\View\View The edit view with the information, category options, and media ID.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the specified information entry is not found.
    */
    public function edit(string $id): View
    {
        $information = Information::findOrFail($id);
        $category = Category::pluck('id','flotte');
        $med = Media::where('model_id', $id)
                                ->where('model_type', Information::class)
                                ->latest('id')
                                ->value('id');
        $media = Media::findOrFail($med);
        $medias = Media::where('model_id', $id)
                                ->where('model_type', Information::class)
                                ->latest('id')
                                ->value('mime_type');
        return view($this->viewPath().'action.random', [
            'information' => $information,
            'category' => $category,
            'media' => $media,
            'medias' => $medias
        ]);
    }

     /**
     * This methods is not perfect now this has an expeption when users upload new pictures. To resolve the problem
     * we need to delete the oldMedia when user upload a new media but away the script work
     *
     * @param string $id
     * @param Information $home
     * @param InformationUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(string $id, Information $home, InformationUpdateRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $home = Information::findOrFail($id);
            $home->update($data);
            if (!empty($request->hasFile('media'))) {
                try {
                    $med = Media::where('model_id', $id)
                                ->where('model_type', Information::class)
                                ->latest('id')
                                ->value('id');
                    $medias = Media::findOrFail($med);

                    // Supprimer le fichier média associé du stockage s'il existe
                        if (Storage::disk('public')->exists($medias->getUrl())) {
                            Storage::disk('public')->delete($medias->getUrl());
                        }
                    // Add the uploaded media to the 'home_collection' collection on the specified disk
                    $media = $home->addMedia($request->file('media'))
                        ->toMediaCollection('information_home', 'public'); // Change 'disk_name' to the actual disk name
                    //Now we store the new files in the home_admins entities
                    $storagePath = $media->getPath();
                    $home->update(['media'=> $storagePath]);
                    // You can also set additional media properties here if needed
                } catch (\Exception $mediaException) {
                    // Handle media-related exceptions
                    throw new \Exception('An error occurred while adding media: ' . $mediaException->getMessage());
                }
            }
            return redirect()->route($this->routes().'edit', ['id' => $home->id])->with('success', 'Modification réussi');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'edit', ['id' => $home->id])->with('error', 'Erreur lors de la modification' . $e->getMessage());
        }
    }

    /**
     * View path
     * @return string
     */
    private function viewPath(): string
    {
        $view = "admin.visualInterface.information.";
        return $view;
    }
    /**
     * Route path
     * @return string
     */
    private function routes(): string
    {
        $routes = "Admin.Information.";
        return $routes;
    }
}
