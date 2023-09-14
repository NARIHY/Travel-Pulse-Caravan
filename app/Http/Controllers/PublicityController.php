<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicityRequest;
use App\Http\Requests\PublicityUpdateRequest;
use App\Models\Publicity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PublicityController extends Controller
{
    /**
     * list information given in the dashboard
     * @return View
     */

    public function listing(): View
    {
        $publicity = Publicity::orderBy('created_at', 'desc')
                                        ->paginate(20);
        return view($this->viewPath().'index', [
            'publicity' => $publicity
        ]);
    }


    /**
     * Creation view
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view($this->viewPath().'action.random');
    }


    /**
     * Store information given
     * @param \App\Http\Requests\PublicityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PublicityRequest $request): RedirectResponse
    {
        try {
            //get the information validated
            $data = $request->validated();

            $home = Publicity::create($data);
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    //count file type image
                    $pictureType =  ['image/jpeg', 'image/png'];
                    $picture = in_array($file->getMimeType(), $pictureType);
                    //count video files
                    $videoType = ['video/mp4','video/quicktime','video/x-msvideo'];
                    $video = in_array($file->getMimeType(), $videoType);
                    if ($picture === true && $video === true) {
                        return redirect()->route($this->routes().'create')->with('error', 'Desoler on ne peut pas importer des photo ou des video à la fois');
                    }
                    // adding files upload to the collection
                    $home->addMedia($file)->toMediaCollection('publicite_home', 'public');
                }
            }
            return redirect()->route($this->routes().'listing')->with('success', 'Sauvgarde réussi');

        } catch (\Exception $e) {
            return redirect()->route($this->routes().'create')->with('error', 'Oupss, il y a eu une erreur'.$e->getMessage());
        }

    }
    /**
     * Redirect us to the edition view
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $home = Publicity::findOrFail($id);
        //get the media
        $mediaCollection = Media::where('collection_name', 'publicite_home')
            ->where('model_type', Publicity::class)
            ->where('model_id', $id)
            ->get();

        return view($this->viewPath().'action.random', [
            'home' => $home,
            'mediaCollection' => $mediaCollection
        ]);
    }


    /**
     * Updated information to publicity
     * @param \App\Http\Requests\PublicityUpdateRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(PublicityUpdateRequest $request, string $id)
    {
        try {
            // Validate the incoming request data
            $data = $request->validated();

            // Find the existing Home model by its ID
            $home = Publicity::findOrFail($id);



            // Update home information
            $home->update($data);

            // Adding new media files (up to a limit of 3)
            if ($request->hasFile('media')) {
                 // Clear all media associated with the Home model
                $home->clearMediaCollection('publicite_home');
                $mediaCount = 0;

                foreach ($request->file('media') as $file) {
                    // Check the MIME type of the file (image/jpeg, image/png, or video/*)
                    $allowedMimeTypes = ['image/jpeg', 'image/png', 'video/mp4', 'video/quicktime', 'video/x-msvideo'];

                    if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                        return redirect()->route($this->routes().'edit', ['id' => $id])->with('error', 'Unsupported file type.');
                    }

                    // Check the file size (e.g., maximum of 5 MB)
                    $maxFileSize = 512000000; // 5 GB in bytes

                    if ($file->getSize() > $maxFileSize) {
                        return redirect()->route($this->routes().'edit', ['id' => $id])->with('error', 'File size exceeds the allowed limit.');
                    }

                    // Add the uploaded file to the media collection
                    $home->addMedia($file)->toMediaCollection('publicite_home', 'public');
                    $mediaCount++;

                    if ($mediaCount >= 3) {
                        break; // Limit of 3 media files reached
                    }
                }
            }

            return redirect()->route($this->routes().'edit', ['id' => $id])->with('success', 'Mis à jour réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'edit', ['id' => $id])->with('error', 'Oops, Il y a eu une erreur: '.$e->getMessage());
        }
    }

    /**
     * Delete an publicity
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(string $id): RedirectResponse
    {
        $home = Publicity::findOrFail($id);
        $home->clearMediaCollection('publicite_home');
        $home->delete();
        return redirect()->route($this->routes().'listing')->with('success', 'Supréssion réussi');
    }

    /**
     * View path
     * @return string
     */
    private function viewPath(): string
    {
        $view = "admin.visualInterface.publicite.";
        return $view;
    }
    /**
     * Route path
     * @return string
     */
    private function routes(): string
    {
        $routes = "Admin.Publicite.";
        return $routes;
    }
}
