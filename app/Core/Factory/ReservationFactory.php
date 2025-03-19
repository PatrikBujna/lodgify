<?php

namespace App\Core\Factory;

use App\Core\Entity\Showtime;
use App\Core\Entity\Simple\Reservation;

class ReservationFactory
{
    public function create(Showtime $showtime, array $reservation): Reservation
    {
        return new Reservation(
            $showtime->getid(),
            $reservation['seats'],
            'pending',
            uniqid()
        );
    }
}
