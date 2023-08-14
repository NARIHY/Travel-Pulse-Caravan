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
     * @param HomeAdmin $home
     * @param HomeAdminRequest $request
     * @return RedirectResponse() 
    */
    public function store(HomeAdmin $home, HomeAdminRequest $request):RedirectResponse
    {
       
        $home = HomeAdmin::create($request->validated());
        $picture = $request->validated('picture');
        if ($picture !== null && !$picture->getError()) {
            $data['picture'] = $picture->store('home', 'public');
        }
        $home->update($data);
        $video = $request->validated('video');
        if ($video !== null && !$video->getError()) {
            $data['video'] = $video->store('home', 'public');
        }
        $home->update($data);
        return redirect()->route('Admin.Home.index')->with('success', 'Création de la publication réussi');
    }

    public function edit(HomeAdmin $home, string $id): View
    {
        $home = HomeAdmin::findOrFAil($id);
        return view('admin.visualInterface.home.action.random', [
            'home' => $home
        ]);
    }
}
