<?php

namespace App\Http\Controllers;

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
}
