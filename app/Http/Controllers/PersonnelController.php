<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PersonnelController extends Controller
{
    public function index(): View
    {
        return view('public.personel.index');
    }
}
