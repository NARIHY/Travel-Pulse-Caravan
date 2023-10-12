<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Car;
use App\Models\Category;
use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\Statement;
use App\Models\Status;
use App\Models\Travel;
use App\Models\Trip;
use App\Notifications\TripChangingNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TripController extends Controller
{

    /**
     * get actuality travel reservation
     *
     * @return View
     */
    public function index(): View
    {
        $trip = Trip::where('date_depart', '>', now())
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);

        return view($this->viewPath().'index', [
            'trip' => $trip
        ]);
    }

    /**
     * creation of new trip
     *
     * @return View
     */
    public function create():View
    {
        $city = Travel::pluck('place');
        $car = Car::where('vehicule_info', 'apte')
                        ->pluck('id','plate_number');
        //for the flote category we only get the car category
        $statement = Status::pluck('status');
        return view($this->viewPath().'action.random', [
            'city' => $city,
            'car' => $car,
            'statement' => $statement
        ]);
    }

    public function store(TripRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $car = Car::where('id', $request->validated('car'))
                                ->value('category');
            $flote = Category::where('id', $car)
                                    ->value('id');
            //verify date_depart if date has a reservation return an error
            $daysToGo = $request->validated('date_depart');
            $verification = Trip::where('car', $request->validated('car'))
                                        ->where('date_depart', $daysToGo)
                                        ->count();
            if ($verification > 0) {
                return redirect()->route($this->routes().'create')->with('error', 'This car cannot be put on the schedule for this day because it is already registered there');
            }
            //trip creation
            $trip = Trip::create($data);
            $trip->update(['flote' => $flote]);
            return redirect()->route($this->routes().'index')->with('success', 'Added successful journey');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'create')->with('error', 'there was a mistake'.$e->getMessage());
        }
    }

    /**
     * needed to edit an information of trip given
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id):View
    {
        $city = Travel::pluck('place');
        $car = Car::where('vehicule_info', 'apte')
                        ->pluck('id','plate_number');
        //for the flote category we only get the car category
        $statement = Status::pluck('status');
        $trip = Trip::findOrFail($id);
        return view($this->viewPath().'action.random', [
            'city' => $city,
            'car' => $car,
            'statement' => $statement,
            'trip' => $trip
        ]);
    }

    /**
     * needed when user need to update the trip reservation when there has a problem
     *
     * @param TripRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(TripRequest $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validated();
            //get the trip identification
            $trip = Trip::findOrFail($id);
            //verify if the car already have an trips, if not continu the script
            $car = $request->validated('car');
            //verify if the car is different to the car reservation in the trip
            if ($trip->car !== $car) {
                $verify = Trip::where('car', $car)
                            ->where('created_at', $trip->created_at)
                            ->get();
                // if verify === true
                if(empty($verify)) {
                    return redirect()->route($this->routes().'update', ['id' => $id])->with('error', 'The car is available for this date');
                }
            }
            //Now we notify every passenger who follow the trip
            //Get every passenger in the travel
            $passenger = Reservation::where('trip_id', $trip->id)
                                        ->get();
            //boucle to get every passenger
            foreach($passenger as $passengers) {
                //to differency the id of trip and the id of many passenger to send notification
                $i = $passengers->passenger_id;
                $pass = Passenger::findOrFail($i);
                $pass->notify(new TripChangingNotification($trip));
            }
            //after save the modification
            $trip->update($data);


            return redirect()->route($this->routes().'update', ['id' => $id])->with('success', 'Modification successful');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'update', ['id' => $id])->with('error', 'there was an error while editing'.$e->getMessage());
        }
    }

    public function delete(string $id):RedirectResponse
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();
        return redirect()->route($this->routes().'index')->with('success', 'Deletion successful');

    }

    /**
     * return viewPath
     *
     * @return string
     */
    private function viewPath():string
    {
        $view = "admin.entreprise.trip.";
        return $view;
    }

    /**
     * return routesPath
     *
     * @return string
     */
    private function routes(): string
    {
        $routes ="Admin.Entreprise.trip.planified.";
        return $routes;
    }
}
