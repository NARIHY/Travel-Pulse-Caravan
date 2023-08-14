<?php

namespace App\Http\Controllers;

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
        return view('admin.index');
    }
}
