<?php
namespace Nari\Reservation;

use App\Models\Car;

use Nari\Reservation\Interface\ReservationInterface;

class Reservation
{
    private $reservation;
    private $car;
    /**
     * If true there are no place disponible
     * If false There are some place disponnible
     * @return bool
     */
    public function verify(): bool
    {

        if ($this->placeDisponible() <= $this->countReservation()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get number of place car disponnible  to reservate
     * @return string
     */
    private function placeDisponible(): string
    {
        $cars = Car::findOrFail($this->car);
        $place = $cars->place;
        $disponiblePlace = $place - 2;
        return $disponiblePlace;
    }


    /**
     * Count people who reservate
     * @return string
     */
    private function countReservation(): string
    {
        $verify = \App\Models\Reservation::where('trip_id', $this->reservation)
                                                ->where('stat', null)
                                                ->count();
        return $verify;
    }

    /**
     * Count place disponible
     * @return string
     */
    public function count(): string
    {
        $cars = Car::findOrFail($this->car);
        $place = $cars->place;
        $disponiblePlace = $place - 2;
        $verify = \App\Models\Reservation::where('trip_id', $this->reservation)
                                            ->where('stat', null)
                                            ->count();
        $c = $disponiblePlace - $verify;
        return $c;
    }

    /**
     * We need carInformation and car to instance the reservationCustomized
     * @param string $reservation
     * @param string $car
     */
    public function __construct(string $reservation, string $car)
    {
        $this->reservation = $reservation;
        $this->car = $car;
    }
}
