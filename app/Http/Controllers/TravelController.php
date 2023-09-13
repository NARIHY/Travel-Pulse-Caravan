<?php

namespace App\Http\Controllers;

use App\Http\Requests\TravelRequest;
use App\Models\Travel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TravelController extends Controller
{

    /**
     * nedeed when you list the trip destination and depart
     *
     * @return View
     */
    public function index():View
    {
        $travel = Travel::orderBy('created_at', 'asc')
                            ->paginate(15);
        return view($this->viewPath().'index', [
            'travel' => $travel
        ]);
    }

    /**
     * Create a new place
     *
     * @return View
     */
    public function create(): View
    {
        return view($this->viewPath(). 'action.random');
    }

    /**
     * store the information given
     *
     * @param TravelRequest $request
     * @return RedirectResponse
     */
    public function store(TravelRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $travel = Travel::create($data);
            return redirect()->route($this->routes().'index')->with('error', 'Ajout du place réussi');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'action.random')->with('error', 'il y a une erreur lor de l\'ajout'. $e->getMessage());
        }
    }

    /**
     * return a viewPath
     *
     * @return string
     */
    private function viewPath(): string
    {
        $path = "admin.entreprise.trip.travel.";
        return $path;
    }

    /**
     * return a routes path
     *
     * @return string
     */
    private function routes(): string
    {
        $routes = "Admin.Entreprise.trip.travel.";
        return $routes;
    }
}
