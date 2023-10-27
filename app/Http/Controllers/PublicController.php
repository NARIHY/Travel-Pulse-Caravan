<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Compteur;
use App\Models\HomeAdmin;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Home view
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $compteur = Compteur::create();
        $home = HomeAdmin::orderBy('created_at', 'desc')
                            ->paginate(1);
        $before = HomeAdmin::orderBy('created_at', 'desc')->skip(1)->take(1)->get();
        $category = Category::orderBy('id', 'asc')
                                ->get();
        return view('public.index', [
            'home' => $home,
            'before' => $before,
            'category' => $category
        ]);
    }

    /**
     * Prestation view
     * @return \Illuminate\View\View
     */
    public function service(): View
    {
        $lite = Information::orderBy('created_at', 'desc')
                                ->where('title', 1)
                                ->limit(1)
                                ->get();
        $prenium = Information::orderBy('created_at', 'desc')
                                ->where('title', 2)
                                ->limit(1)
                                ->get();
        $vip = Information::orderBy('created_at', 'desc')
                                ->where('title', 3)
                                ->limit(1)
                                ->get();
        $vvip = Information::orderBy('created_at', 'desc')
                                ->where('title', 4)
                                ->limit(1)
                                ->get();
        $colis = Information::orderBy('created_at', 'desc')
                                ->where('title', 5)
                                ->limit(1)
                                ->get();

        return view('public.service.index', [
            'lite' => $lite,
            'prenium' => $prenium,
            'vip' => $vip,
            'vvip' => $vvip,
            'colis' => $colis
        ]);
    }

    /**
     * Contact public view
     * @return \Illuminate\View\View
     */
    public function contact(): View
    {
        return view('public.contact.contact');
    }

    public function information(): View
    {
        return view('public.information.index');
    }
}
