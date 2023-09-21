<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeAdmin;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        $home = HomeAdmin::orderBy('created_at', 'desc')
                            ->paginate(2);
        $category = Category::orderBy('id', 'asc')
                                ->get();
        return view('public.index', [
            'home' => $home,
            'category' => $category
        ]);
    }
}
