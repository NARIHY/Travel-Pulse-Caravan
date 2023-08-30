<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassengerRequest;
use App\Models\Passenger;
use App\Models\Reservation;
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
            $passenger = Passenger::create($data);
            return redirect()->route($this->routes().'passenger.city', ['passenger_id' => $passenger->id, 'purcount' => 25])->with('success','25');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'create.passenger')->with('error', 'Une erreur s\'est survenue'.$e->getMessage());
        }
    }

    public function destination(string $passenger_id, string $purcount) : View 
    {
        return view($this->viewPath().'trip.index', [
            'purcount' => $purcount,
            'passenger_id' => $passenger_id
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
