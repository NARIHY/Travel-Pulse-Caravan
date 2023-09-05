<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestinationRequest;
use App\Http\Requests\PassengerRequest;
use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\Travel;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{

    /**
     * list the reservation view where reservation_time > now
     *
     * @return View
     */
    public function index(): View
    {
        $reservation = Reservation::orderBy('created_at')
                                        ->where('reservation_date', '>', now())
                                        ->paginate(20);
        return view($this->viewPath().'index', [
            'reservation' => $reservation
        ]);
    }

    /**
     * begin view of reservation
     *
     * @return View
     */
    public function passenger(): View 
    {
        return view($this->viewPath().'passenger.index');
    }

    /**
     * to add passenger in passenger list
     *
     * @param PassengerRequest $request
     * @return RedirectResponse
     */
    public function passenger_add(PassengerRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            if($request->validated('phone_number') === $request->validated('emergency_contact')) {
                return redirect()->route($this->routes().'create.passenger')->with('error', 'Le numéro de téléphone du voyageur ne peut pas être le même que celui du personne à contacter en cas d\'urgence');
            }
            $passenger = Passenger::create($data);
            
            return redirect()->route($this->routes().'passenger.city', ['passenger_id' => $passenger->id, 'purcount' => 25])->with('success','25');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'create.passenger')->with('error', 'Une erreur s\'est survenue'.$e->getMessage());
        }
    }

    /**
     * To get the traveling user information
     * Where is he/she
     * where he/she go
     *
     * @param string $passenger_id
     * @param string $purcount
     * @return View
     */
    public function destination(string $passenger_id, string $purcount) : View 
    {
        $city = Travel::pluck('place');
        return view($this->viewPath().'trip.index', [
            'purcount' => $purcount,
            'passenger_id' => $passenger_id,
            'city' => $city
        ]);
    }

    /**
     * Update the information
     *
     * @param DestinationRequest $request
     * @param string $passenger_id
     * @param string $purcount
     * @return RedirectResponse
     */
    public function destination_save(DestinationRequest $request, string $passenger_id, string $purcount): RedirectResponse
    {
        try {
            $place_depart = $request->validated('place_depart');
            $place_arrivals = $request->validated('place_arrivals');
            $purcounts = $purcount + 25;
            return redirect()->route($this->routes().'passenger.city.reserve', ['passenger_id' => $passenger_id, 'purcount' => $purcounts, 'depart' => $place_depart, 'arrivals' => $place_arrivals]);
        } catch(\Exception $e) {
            return redirect()->route($this->route().'passenger.city', ['passenger_id' => $passenger_id, 'purcount' => $purcount])->with('error', 'Il y a une erreur lors du sauvgarde'.$e->getMessage());
        }
    }
    /**
     * return a reservation view 
     * we are at 50% 
     *
     * @param string $passenger_id
     * @param string $purcount
     * @param string $depart
     * @param string $arrivals
     * @return View
     */
    public function reservate(string $passenger_id, string $purcount, string $depart, string $arrivals): View
    {
        $trip = Trip::where('date_depart', '>', now())
                        ->orderBy('created_at', 'desc')
                        ->where('place_depart', $depart)
                        ->where('place_arrivals', $arrivals)
                        ->paginate(15);
        return view($this->viewPath().'reservate.index', [
            'purcount' => $purcount,
            'arrivals' => $arrivals,
            'passenger_id' => $passenger_id,
            'depart' => $depart,
            'trip' => $trip
        ]);
        
    }

    /**
     * Return user to the payement view
     *
     * @param string $passenger_id
     * @param string $purcount
     * @param string $depart
     * @param string $arrivals
     * @param string $tripId
     * @return View
     */
    public function payement(string $passenger_id, string $purcount, string $depart, string $arrivals, string $tripId):View 
    {
        return view($this->viewPath().'payement.index', [
            'purcount' => $purcount ,
            'arrivals' => $arrivals,
            'passenger_id' => $passenger_id,
            'depart' => $depart,
            'tripId' => $tripId
        ]);
    }

    /**
     * post payement
     *
     * @param string $passenger_id
     * @param string $purcount
     * @param string $depart
     * @param string $arrivals
     * @param string $tripId
     * @return RedirectResponse
     */
    public function success(string $passenger_id, string $purcount, string $depart, string $arrivals, string $tripId) : RedirectResponse
    {
        
        $data = [
            'trip_id' => $tripId,
            'passenger_id' => $passenger_id,
            'reservation_status' => 'reserver'
        ];
        $reservation = Reservation::create($data);
        return redirect()->route($this->routes().'passenger.city.finale', ['purcount' => $purcount + 25]);
    }

    public function finale(string $purcount): View 
    {
        return view($this->viewPath().'finale.index', [
            'purcount' => $purcount
        ]);
    }
    /**
     * this is already the same 
     * view path directory
     *
     * @return string
     */
    private function viewPath(): string 
    {
        $path ="admin.entreprise.trip.reservation.";
        return $path;
    }

    /**
     * routes path directory
     *
     * @return string
     */
    private function  routes(): string 
    {
        $routes = "Admin.Entreprise.trip.reservation.";
        return $routes;
    }
}
