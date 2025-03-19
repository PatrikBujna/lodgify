<?php

namespace App\Core\Handler;

use App\Core\Base\Response\GeneralResponse;
use App\Core\Entity\Showtime;
use App\Core\Repository\ShowtimeRepository;

class ShowtimeIndexHandler
{
    private ShowtimeRepository $showtimeRepository;

    public function __construct(ShowtimeRepository $showtimeRepository)
    {
        $this->showtimeRepository = $showtimeRepository;
    }

    public function getAll(): GeneralResponse
    {
        $showtimes = $this->showtimeRepository->getAll();

        if (empty($showtimes)) {
            return new GeneralResponse(
                404,
                null,
                'No showtimes found'
            );
        }

        return new GeneralResponse(
            200,
            $showtimes,
            'Showtimes retrieved successfully'
        );
    }

    public function getById(int $showtimeId): GeneralResponse
    {
        $showtime = $this->showtimeRepository->getById($showtimeId);

        if (empty($showtime)) {
            return new GeneralResponse(
                404,
                null,
                'Showtime not found'
            );
        }

        return new GeneralResponse(
            200,
            $showtime,
            'Showtime retrieved successfully'
        );
    }

    public function updateSeats(Showtime $showtime, array $seats): GeneralResponse
    {
        $showtime->setReservedSeats(array_merge($showtime->getReservedSeats(), $seats));
        $showtime->setAvailableSeats(array_values(array_diff($showtime->getAvailableSeats(), $seats)));

        $result = $this->showtimeRepository->update($showtime);

        if ($result === true) {
            return new GeneralResponse(
                200,
                null,
                'Showtime updated successfully'
            );
        }

        return new GeneralResponse(
            422,
            null,
            'Showtime not updated'
        );
    }
}
