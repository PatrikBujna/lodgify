<?php

namespace App\Core\Handler;

use App\Core\Base\Response\GeneralResponse;
use App\Core\Factory\ShowtimeFactory;
use App\Core\Repository\ShowtimeRepository;
use Exception;

class ShowtimeStoreHandler
{
    private MovieHandler $movieHandler;
    private ShowtimeFactory $showtimeFactory;
    private ShowtimeRepository $showtimeRepository;

    public function __construct(
        MovieHandler $movieHandler,
        ShowtimeFactory $showtimeFactory,
        ShowtimeRepository $showtimeRepository
    ) {
        $this->movieHandler = $movieHandler;
        $this->showtimeFactory = $showtimeFactory;
        $this->showtimeRepository = $showtimeRepository;
    }

    public function store(string $movieId, array $showtime): GeneralResponse
    {
        $movieResponse = $this->movieHandler->getById($movieId);

        if ($movieResponse->getStatusCode() !== 200) {
            return $movieResponse;
        }

        $showtime = $this->showtimeFactory->create($movieResponse->getData(), $showtime);

        try {
            $result = $this->showtimeRepository->store($showtime);
        } catch (Exception $e) {
            return new GeneralResponse(
                500,
                null,
                'An error occurred while saving the showtime'
            );
        }

        if ($result === true) {
            return new GeneralResponse(
                201,
                $showtime->toArray(),
                'Showtime saved successfully'
            );
        }

        return new GeneralResponse(
            422,
            null,
            'Showtime not saved'
        );
    }
}
