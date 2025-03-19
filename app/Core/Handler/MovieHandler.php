<?php
namespace App\Core\Handler;

use App\Core\Base\Response\GeneralResponse;
use App\Core\Provider\MovieProvider;

class MovieHandler
{
    private MovieProvider $movieProvider;

    public function __construct(MovieProvider $movieProvider)
    {
        $this->movieProvider = $movieProvider;
    }

    public function getById(string $id): GeneralResponse
    {
        $movie = $this->movieProvider->getMovieById($id);
        if ($movie === null) {
            return new GeneralResponse(
                404,
                null,
                'Movie not found'
            );
        }

        return new GeneralResponse(
            200,
            $movie,
            'Movie retrieved successfully'
        );
    }
}
