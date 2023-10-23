<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeAdminRequest;
use App\Http\Requests\HomeAdminUpdateRequest;
use App\Models\HomeAdmin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeAdminController extends Controller
{
    /**
     * return to home dashboard listing
     * @return View
     */
    public function index(): View
    {
        $home = HomeAdmin::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.visualInterface.home.index', [
            'home' => $home
        ]);
    }

    /**
     * NOTE - Creation of one publication
     * @return View()
     */
    public function create(): View
    {
        $home = new HomeAdmin();
        return view('admin.visualInterface.home.action.random', [
            'home' => $home
        ]);
    }

    /**
     * TODO - Upload information
     * This is used when users upload pictures or videos in the home create view
     *
     * @param HomeAdminRequest $request
     * @return RedirectResponse
     */
    public function store(HomeAdminRequest $request): RedirectResponse
    {
        try {
            // Step 1: Retrieve validated data from the form
            $data = $request->validated();

            // Step 2: Create a HomeAdmin instance with validated data
            $home = HomeAdmin::create($data);

            // Step 3: Manage the upload of the image or video
            if ($request->hasFile('media')) {
                try {
                    // Add the uploaded media to the 'home_collection' collection on the specified disk
                    $media = $home->addMedia($request->file('media'))
                        ->toMediaCollection('home_collection', 'public'); // Change 'disk_name' to the actual disk name
                    //storage Path
                    $storagePath = $media->getPath();
                    $home->update(['media'=> $storagePath]);
                    // You can also set additional media properties here if needed
                } catch (\Exception $mediaException) {
                    // Handle media-related exceptions
                    throw new \Exception('An error occurred while adding media: ' . $mediaException->getMessage());
                }
            }
            //copy files
            $this->copyFiles();
            // Step 4: Redirect with success message
            return redirect()->route('Admin.Home.index')->with('success', 'Created successful post');
        } catch (\Exception $e) {
            // Handle general exceptions
            $errorMessage = 'Une erreur est survenue lors de la création de la publication: ' . $e->getMessage();
            return redirect()->route('Admin.Home.index')->with('error', $errorMessage);
        }
    }




   /**
     * TODO - Edit information
     * This is used when editing existing home content along with associated media
     *
     * @param string $id
     * @return View|RedirectResponse
     */
    public function edit(string $id): View | RedirectResponse
    {
        try {
            // Step 1: Retrieve the existing HomeAdmin instance based on the provided ID
            $home = HomeAdmin::findOrFail($id);

            // Step 2: Get the media associated with the HomeAdmin instance from the 'media_collection' collection
            $mediaCollection = Media::where('collection_name', 'home_collection')
                                        ->where('model_type', HomeAdmin::class)
                                        ->where('model_id', $id)
                                        ->get();

            // Step 3: Pass the HomeAdmin instance and associated media to the view
            return view('admin.visualInterface.home.action.random', [
                'home' => $home,
                'mediaCollection' => $mediaCollection
            ]);
        } catch (\Exception $e) {
            // Handle exceptions, if any
            $errorMessage = 'An error occurred while retrieving data : ' . $e->getMessage();
            return redirect()->route('Admin.Home.index')->with('error', $errorMessage);
        }
    }

    /**
     * This methods is not perfect now this has an expeption when users upload new pictures. To resolve the problem
     * we need to delete the oldMedia when user upload a new media but away the script work
     *
     * @param string $id
     * @param HomeAdmin $home
     * @param HomeAdminUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(string $id, HomeAdmin $home, HomeAdminUpdateRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $home = HomeAdmin::findOrFail($id);
            $home->update($data);
            if (!empty($request->hasFile('media'))) {
                try {
                    // used to delete an old  media files when update action is on
                    $delete = Media::where('collection_name', 'home_collection')
                                        ->where('model_type', HomeAdmin::class)
                                        ->where('model_id', $id)
                                        ->delete();
                    // Add the uploaded media to the 'home_collection' collection on the specified disk
                    $media = $home->addMedia($request->file('media'))
                        ->toMediaCollection('home_collection', 'public'); // Change 'disk_name' to the actual disk name
                    //Now we store the new files in the home_admins entities
                    $storagePath = $media->getPath();
                    $home->update(['media'=> $storagePath]);
                    // You can also set additional media properties here if needed
                    $this->copyFiles();
                } catch (\Exception $mediaException) {
                    // Handle media-related exceptions
                    throw new \Exception('An error occurred while adding media: ' . $mediaException->getMessage());
                }
            }
            return redirect()->route('Admin.Home.edit', ['id' => $id])->with('success', 'Modification successful');
        } catch(\Exception $e) {
            return redirect()->route('Admin.Home.edit', ['id' => $id])->with('error', 'Error while editing' . $e->getMessage());
        }
    }



    /**
     * NOTE - Suppression with spatie/media-library
     * The spatie/media-library package for Laravel is a great tool to easily manage media files in your applications.
     *  Here's how you can use it to manage media associated with your templates, such as your HomeAdmin template.
     *
     * Step 1: Install the package
     * this is the comande -> composer require spatie/laravel-medialibrary
     *
     * Step 2: Configuration
     * After you install the package, you must publish and run the migrations to create the necessary tables:
     * this is the comande -> php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
     *                     -> php artisan migrate
     *
     * Install there if not you will have an errors
     *
     *
     *  */
    public function delete(string $id): RedirectResponse
    {
        try {
            $home = HomeAdmin::findOrFail($id);


            // Supprimer le fichier média associé du stockage s'il existe
            if ($home->media) {

                if (Storage::disk('public')->exists($home->media)) {
                     Storage::disk('public')->delete($home->media);
                }
            }

            // Supprimer l'objet HomeAdmin lui-même
            $home->delete();

            return redirect()->route('Admin.Home.index')->with('success', 'Deletion successful');
        } catch (\Exception $e) {
            return redirect()->route('Admin.Home.index')->with('error', 'an error occurred during deletion');
        }
    }


    /**
     * When users upload files, it copy every files in storage to public /
     * it's the same roles to php artisan generate:link
     * @return void
     */
    private function copyFiles()
    {
        $sourceDirectory = storage_path('app/public');
        $destinationDirectory = public_path('storage');
        if (File::isDirectory($sourceDirectory)) {
            File::copyDirectory($sourceDirectory, $destinationDirectory);
        }
    }

}
