<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Compteur;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * This is already used to join the dashboard view
     * @return View
     */
    public function index(): View
    {
        //car count
        $car = Car::count();
        //fleet
        $fleet = Category::count();
        //Get total visits
        $visits = Compteur::count();
        //only visits for today
        $today = Carbon::today();
        $visitsToday = Compteur::whereDate('created_at', $today)->count();
        //for this months
        $visitsThisMonth = Compteur::whereMonth('created_at', $today->month)->count();
        //for this year
        $visitsThisYear = Compteur::whereYear('created_at', $today->year)->count();
        //for user
        $totalUsers  = User::count();
        //admin
        $totaleAdmin = User::where('role', '!=', '1')
                                ->count();
        return view('admin.index', [
            'car' => $car,
            'fleet' => $fleet,
            'visits'=> $visits,
            'visitsToday' => $visitsToday,
            'visitsThisMonth' => $visitsThisMonth,
            'visitsThisYear' => $visitsThisYear,
            'totalUsers' => $totalUsers,
            'totaleAdmin' => $totaleAdmin
        ]);
    }
}
