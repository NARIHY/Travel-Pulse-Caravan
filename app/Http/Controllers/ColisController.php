<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ColisController extends Controller
{
    public function index(): View
    {
        return view('public.colis.index');
    }

    public function condition()
    {
        return view('public.policy.condition');
    }
    public function terme()
    {
        return view('public.policy.terme');
    }
}
