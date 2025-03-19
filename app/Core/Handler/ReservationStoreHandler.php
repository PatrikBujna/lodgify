<?php

namespace App\Core\Handler;

use App\Core\Base\Response\GeneralResponse;
use App\Core\Base\Service\CacheServiceInterface;
use App\Core\Base\Service\QueueServiceInterface;
use App\Core\Entity\Showtime;
use App\Core\Factory\ReservationFactory;
use App\Core\Repository\ReservationRepository;
use App\Core\Validator\ReservationSeatsValidator;
use App\Jobs\ExpireReservationJob;
use Exception;

class ReservationStoreHandler
{
    private ShowtimeIndexHandler $reservationStoreHandler;
    private ReservationFactory $reservationFactory;
    private ReservationRepository $reservationRepository;
    private ReservationSeatsValidator $reservationSeatsValidator;
    private CacheServiceInterface $cacheService;
    private QueueServiceInterface $queueService;

    public function __construct(
        ShowtimeIndexHandler $reservationStoreHandler,
        ReservationFactory $reservationFactory,
        ReservationRepository $reservationRepository,
        ReservationSeatsValidator $reservationSeatsValidator,
        CacheServiceInterface $cacheService,
        QueueServiceInterface $queueService
    ) {
        $this->reservationStoreHandler = $reservationStoreHandler;
        $this->reservationFactory = $reservationFactory;
        $this->reservationRepository = $reservationRepository;
        $this->reservationSeatsValidator = $reservationSeatsValidator;
        $this->cacheService = $cacheService;
        $this->queueService = $queueService;
    }

    public function store(int $showtimeId, array $reservation): GeneralResponse
    {
        $showtimeResponse = $this->reservationStoreHandler->getById($showtimeId);
        if ($showtimeResponse->getStatusCode() !== 200) {
            return $showtimeResponse;
        }
        /** @var Showtime $showtime */
        $showtime = $showtimeResponse->getData();

        $validationResponse = $this->validateSeats($showtime, $reservation);
        if ($validationResponse->getStatusCode() !== 200) {
            return $validationResponse;
        }

        $reservation = $this->reservationFactory->create($showtime, $reservation);

        try {
            $lockKey = "lock:showtime:{$showtimeId}:seats:".json_encode($reservation->getSeats());
            $lock = $this->cacheService->setnx($lockKey, now()->addSeconds(10));
            if (!$lock) {
                return new GeneralResponse(
                    409,
                    null,
                    'Please try again, another user is reserving these seats'
                );
            }

            $reservationId = $this->reservationRepository->store($reservation);
            if ($reservationId !== null) {
                $result = $this->reservationStoreHandler->updateSeats($showtime, $reservation->getSeats());
            }
        } catch (Exception $e) {
            return new GeneralResponse(
                500,
                null,
                'An error occurred while saving reservation'
            );
        }

        if ($reservationId !== null && $result->getStatusCode() === 200) {
            $this->queueService->dispatch(
                (new ExpireReservationJob($reservationId))->delay(now()->addMinutes(10))
            );
            $this->cacheService->delete($lockKey);

            return new GeneralResponse(
                201,
                $reservation->toArray(),
                'Reservation with id ' . $reservation->getUid() . ' saved successfully'
            );
        }

        return new GeneralResponse(
            422,
            null,
            'Reservation not saved'
        );
    }

    private function validateSeats(Showtime $showtime, array $reservation): GeneralResponse
    {
        if ($this->reservationSeatsValidator->setsAreContiguous($reservation['seats']) === false) {
            return new GeneralResponse(
                422,
                null,
                'Seats are not contiguous'
            );
        }

        if ($this->reservationSeatsValidator->seatsAreAvailable(
                $reservation['seats'],
                $showtime->getReservedSeats(),
                $showtime->getAvailableSeats()
            ) === false) {
            return new GeneralResponse(
                422,
                null,
                'Seats are not available'
            );
        }

        return new GeneralResponse(
            200,
            null,
            'Seats validated successfully'
        );
    }
}
