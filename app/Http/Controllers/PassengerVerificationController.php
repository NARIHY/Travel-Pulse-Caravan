<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PassengerVerificationController extends Controller
{

    /**
     * Listing of all reservation
     * @return \Illuminate\View\View
     */
    public function reservation(): View
    {
        $trip = Trip::where('date_depart', '>=', now())
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
        return view('admin.entreprise.reservation.index', [
            'trip' => $trip
        ]);
    }

    /**
     * Go to listing all of all passenger in the reservation
     * @return \Illuminate\View\View
     */
    public function verify(string $id): View
    {
        $reservation = Reservation::where('trip_id', $id)
                                        ->paginate(15);
        return view('admin.entreprise.reservation.passenger', [
            'reservation' => $reservation
        ]);
    }

    /**
     * To do for ticket verifications
     * @param string $identification
     * @return \Illuminate\View\View
     */
    public function passenger(string $identification): View
    {
        $passenger = Reservation::where('identification', $identification)
                                    ->get();
        return view('admin.entreprise.reservation.view', [
            'passenger' => $passenger
        ]);
    }
}
