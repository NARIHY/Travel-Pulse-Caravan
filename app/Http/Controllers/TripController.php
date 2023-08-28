<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Car;
use App\Models\Category;
use App\Models\Statement;
use App\Models\Status;
use App\Models\Travel;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TripController extends Controller
{

    /**
     * get actuality travel reservation
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
     * creation of new trip
     *
     * @return View
     */
    public function create():View 
    {
        $city = Travel::pluck('place');
        $car = Car::where('vehicule_info', 'apte')
                        ->pluck('plate_number');
        //for the flote category we only get the car category
        $statement = Status::pluck('status');
        return view($this->viewPath().'action.random', [
            'city' => $city,
            'car' => $car,
            'statement' => $statement
        ]);
    }

    public function store(TripRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();          
            $car = Car::where('plate_number', $request->validated('car'))
                                ->value('category');
            $flote = Category::where('id', $car)
                                    ->value('flotte');
            //verify date_depart if date has a reservation return an error
            $daysToGo = $request->validated('date_depart');
            $verification = Trip::where('car', $request->validated('car'))
                                        ->where('date_depart', $daysToGo)
                                        ->count();
            if ($verification > 0) {
                return redirect()->route($this->routes().'create')->with('error', 'Cette voiture ne peut pas être mis sur le planing pour ce jour  car elle y est déjàs inscrit'); 
            }            
            //trip creation            
            $trip = Trip::create($data);
            $trip->update(['flote' => $flote]);
            return redirect()->route($this->routes().'index')->with('success', 'Ajout du trajet réussi');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'create')->with('error', 'il y a eu une erreur'.$e->getMessage());
        }
    }

    /**
     * needed to edit an information of trip given
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id):View 
    {
        $city = Travel::pluck('place');
        $car = Car::where('vehicule_info', 'apte')
                        ->pluck('plate_number');
        //for the flote category we only get the car category
        $statement = Status::pluck('status');
        $trip = Trip::findOrFail($id);
        return view($this->viewPath().'action.random', [
            'city' => $city,
            'car' => $car,
            'statement' => $statement,
            'trip' => $trip
        ]);
    }

    /**
     * needed when user need to update the trip reservation when there has a problem
     *
     * @param TripRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(TripRequest $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validated();
            $trip = Trip::findOrFail($id);
            $trip->update($data);
            return redirect()->route($this->routes().'update', ['id' => $id])->with('success', 'Modification réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'update', ['id' => $id])->with('error', 'il y a eu une erreur lors de la modification'.$e->getMessage());
        }
    }

    public function delete(string $id):RedirectResponse 
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();
        return redirect()->route($this->routes().'index')->with('success', 'Suppréssion réussi');

    }

    /**
     * return viewPath
     *
     * @return string
     */
    private function viewPath():string 
    {
        $view = "admin.entreprise.trip."; 
        return $view;
    }

    /**
     * return routesPath
     *
     * @return string
     */
    private function routes(): string 
    {
        $routes ="Admin.Entreprise.trip.planified.";
        return $routes;
    }
}
