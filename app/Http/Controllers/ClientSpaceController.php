<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientSpaceController extends Controller
{
    public function client(): View
    {
        //get passenger id
        $user = Auth::user();
        //Get passenger where user Id are in the passenger user_id
        $passenger = Passenger::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('public.client.index', [
            'user' => $user,
            'passenger' => $passenger
        ]);
    }

    public function abord(string $reservationId): RedirectResponse
    {
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->update(['stat' => 'abord']);
        return redirect()->route('Client.index');
    }
}
