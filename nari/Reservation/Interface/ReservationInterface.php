<?php
namespace Nari\Reservation\Interface;

interface ReservationInterface
{
    /**
     * this method makes it possible to check the number of spaces available in vehicles when
     * of a reservation, if the car no longer has space then it returns false
     * @author Narihy <maheninarandrianarisoa@gmail.com>
     * @return bool
     */
    public function verify(): bool;


}
