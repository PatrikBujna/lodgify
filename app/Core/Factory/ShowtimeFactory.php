<?php

namespace App\Core\Factory;

use App\Core\Entity\Movie;
use App\Core\Entity\Simple\Showtime;
use DateTime;

class ShowtimeFactory
{
    public function create(Movie $movie, array $showtime): Showtime
    {
        return new Showtime(
            $movie->getImdbId(),
            $movie->getTitle(),
            $showtime['auditorium'],
            new DateTime($showtime['start_time']),
            $showtime['seats'],
            null
        );
    }
}
