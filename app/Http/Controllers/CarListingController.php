<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CarListingController extends Controller
{
    public function index(): View
    {
        $category = Category::paginate(6);
        return view($this->ViewPath(). 'index', [
            'category' => $category
        ]);
    }

    public function listing(string $id, string $category): View | RedirectResponse
    {
        try {
            $flote = Category::findOrFail($id);
            
            $car = Car::orderBy('created_at', 'desc')
                            ->where('category', $flote->id)
                            ->paginate(15);
                            
            return view($this->ViewPath().'listing', [
                'car' => $car,
                'flote' => $flote
            ]);
        } catch (\Exception $e) {
            $uri = $category !== $flote->flotte;
            // Vérification de correspondance de catégorie
            if ($uri === false)
            {
                //tueUrl
                $trueUrl = route(route($this->routes().'listing', ['id' => $flote->id, 'category' => $flote->flotte]));
                // Redirection permanente (301) vers l'URL avec la catégorie corrigée
                return Redirect::to($trueUrl, 301);
            } else {
                return redirect()->route($this->routes(). 'index')->with('error', 'Échec lors de la récupération des voitures par flote'. $e->getMessage());
            }
        }
    }

    

    /**
     * Needed to return a routes path
     *
     * @return String 
     */
    private function routes(): String 
    {
        return 'Admin.Entreprise.flote.car.listing.flote.';
    }

    /**
     * nedeed to return a view in a path
     *
     * @return String
     */
    private function ViewPath(): String 
    {
        return 'admin.entreprise.flote.listing.';
    }

    
}
