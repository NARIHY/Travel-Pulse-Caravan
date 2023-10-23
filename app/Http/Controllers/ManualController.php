<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ManualController extends Controller
{
    //summary of manual

    /**
     * Greeting users ||
     * @return \Illuminate\View\View
     */
    public function greeting(): View
    {
        return view($this->view().'index');
    }

    /**
     * Steep 1 authentification
     * @return \Illuminate\View\View
     */
    public function authetificate(): View
    {
        return view($this->view().'steep.auth.auth');
    }
    private function view(): string
    {
        $view = "manual.";
        return $view;
    }
}
