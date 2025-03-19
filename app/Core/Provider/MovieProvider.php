<?php

namespace App\Core\Provider;

use App\Core\Entity\Movie;

interface MovieProvider
{
    public function getMovieById(string $id): ?Movie;
}
