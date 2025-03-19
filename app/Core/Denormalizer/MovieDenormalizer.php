<?php

namespace App\Core\Denormalizer;

use App\Core\Entity\Simple\Movie;
use App\Core\Exception\CannotDenormalizeToObjectException;
use Exception;

class MovieDenormalizer
{
    public function denormalize(array $data): Movie
    {
        try {
            return new Movie(
                $data['imdbID'],
                $data['Title'],
                $data['Year'],
                $data['Runtime'],
                $data['Genre'],
                $data['Director'],
                $data['Actors'],
                $data['Plot'],
                $data['Poster']
            );
        } catch (Exception $e) {
            throw new CannotDenormalizeToObjectException(Movie::class);
        }
    }

}
