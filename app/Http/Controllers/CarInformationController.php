<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarInformationRequest;
use App\Models\Car;
use App\Models\CarInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CarInformationController extends Controller
{

    /**
     * list to the car information in a view
     *
     * @return View
     */
    public function index(): View
    {
        $carInformation = CarInformation::orderBy('created_at', 'desc')
                                                ->paginate(15);
        return view($this->viewPath(). 'index', [
            'carInformation' => $carInformation
        ]);
    }

    /**
     * creation view of adding new information in a car
     *
     * @return View
     */
    public function create (): View
    {
        $carIdInformation = DB::table('car_information')->pluck('car');
        //get car if car doesn't exist in car information
        $carRecup = Car::whereNotIn('id', $carIdInformation)
                        ->pluck('id','plate_number');
        return view($this->viewPath(). 'action.random', [
            'car' => $carRecup
        ]);
    }

    /**
     * Store information given by user on car information adding view
     * @param \App\Http\Requests\CarInformationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CarInformationRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $min_weight = $request->validated('min-weight');
            $max_weight = $request->validated('max-weight');
            //verification if min_weight<max weight and max_weight>min_weight
            if($min_weight>$max_weight && $max_weight<$min_weight) {
                return redirect()->route($this->routes().'create')->with('error', 'la charge minimale du voiture doit etre inferieur a la charge maximale du voiture ou la cahrge maximale du voiture ne doit pas etre inferieur a la charge minimale du voiture');
            }

            //verify if car id is already exists in the car Information
            $carId = CarInformation::where('car', $request->validated('car'))
                                    ->get();
            //if true return an error
            if ($carId === true) {
                return redirect()->route($this->routes().'create')->with('error', 'la voiture a laquelle vous ajouter de nouvelle information possede déjàs des informations');
            }
            //else we continu the script
            $carinformation = CarInformation::create($data);
            $carinformation->car()->sync(['car_id' => $carinformation->id], $request->validated('car'));

            return redirect()->route($this->routes().'index')->with('success', 'ajout des information réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'create')->with('error', 'une erreur s\'est survenu lor de l\ajout'. $e->getMessage());
        }
    }

    /**
     * GO to the edition car information
     *  ->variable:
     *            - carInformation: get the car to update
     *            - carRecup: get every car by desc
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id): View
    {
        $carInformation = CarInformation::findOrFail($id);

        $carRecup = Car::where('id', $carInformation->car)
                            ->get();

        return view($this->viewPath(). 'action.random', [
            'carInformation' => $carInformation,
            'car' => $carRecup
        ]);
    }
    /**
     * Update a car's information.
     *
     * @param string $id The ID of the car information to be updated.
     * @param CarInformationRequest $request The validated request containing updated data.
     *
     * @return RedirectResponse A redirect response based on the outcome of the update process.
     */
    public function update(string $id, CarInformationRequest $request): RedirectResponse
    {
        try {
            $carInformation = CarInformation::findOrFail($id);
            //get request validated and insert it into $data= []
            $data = $request->validated();
            //verify if numbers of mileage insert by user is lower than the mileage of the car already registered
            if ($carInformation->kilometers <  $data['kilometers']) {
                //return error
                return redirect()->route($this->route().'edit', ['id' => $carInformation->id])->with('error', 'The mileage number of you entered is lower than the mileage of the current car');
            }
            //Verify if $carInformation->maintains is before $request->validated('maintains') return an error
            $maintainsDate = Carbon::parse($data['maintains']);
            $carMaintainsDate = Carbon::parse($carInformation->maintains);
            //we used Carbon
            if ($maintainsDate->isBefore($carMaintainsDate)) {
                return redirect()->route($this->route().'edit', ['id' => $carInformation->id])->with('error', 'The maintenance date must be later than the current date.');
            }
            //if there is no eror save these information
            $carInformation->update($data);
            //relation needed
            $carInformation->car()->sync(['car_id' => $carInformation->id], $request->validated('car'));
            return redirect()->route($this->routes().'edit', ['id' => $carInformation->id])->with('success', 'updated successfully');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'edit', ['id' => $carInformation->id])->with('error', 'Oops, there was one or more errors'. $e->getMessage());
        }
    }

    /**
     * return an routes path
     *
     * @return string
     */
    private function routes(): string
    {
        $routes = "Admin.Entreprise.flote.car.carInformation.";
        return $routes;
    }
    /**
     * return an instance of carInformationView
     *
     * @return string
     */
    private function viewPath(): string
    {
        $viewPath = "admin.entreprise.flote.car.car_information.";
        return $viewPath;
    }
}
