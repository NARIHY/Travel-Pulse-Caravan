<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeAdminRequest;
use App\Models\HomeAdmin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * @param HomeAdmin $home
     * @param HomeAdminRequest $request
     * @return RedirectResponse() 
    */
   public function store(HomeAdminRequest $request): RedirectResponse
{
    $data = $request->validated(); // Retrieve validated data from the form

    // Create a HomeAdmin instance with validated data
    $home = HomeAdmin::create($data);

    // Manage the upload of the image or video
    if ($request->hasFile('media')) {
        $mediaPath = $request->file('media')->store('home', 'public');
        $mediaName = basename($mediaPath);
        $home->update(['media' => $mediaName]);
    }

    return redirect()->route('Admin.Home.index')->with('success', 'Création de la publication réussie');
}

   

    public function edit(HomeAdmin $home, string $id): View
    {
        $home = HomeAdmin::findOrFAil($id);
        return view('admin.visualInterface.home.action.random', [
            'home' => $home
        ]);
    }
}
