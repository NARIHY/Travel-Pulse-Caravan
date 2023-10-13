<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
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
        return view('admin.index', [
            'car' => $car,
            'fleet' => $fleet
        ]);
    }
}
