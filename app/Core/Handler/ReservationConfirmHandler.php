<?php

namespace App\Core\Handler;

use App\Core\Base\Response\GeneralResponse;
use App\Core\Entity\Reservation;
use App\Core\Repository\ReservationRepository;

class ReservationConfirmHandler
{
    private ReservationRepository $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function confirm(string $reservationGuid): GeneralResponse
    {
        $reservation = $this->reservationRepository->getByUid($reservationGuid);
        $reservationValidationResponse = $this->validateReservation($reservation);
        if ($reservationValidationResponse->getStatusCode() !== 200) {
            return $reservationValidationResponse;
        }

        $this->reservationRepository->updateStatus($reservationGuid, 'confirmed');

        return new GeneralResponse(
            200,
            $reservation->toArray(),
            'Reservation confirmed successfully'
        );
    }

    private function validateReservation(?Reservation $reservation): GeneralResponse
    {
        if ($reservation === null) {
            return new GeneralResponse(
                404,
                null,
                'Reservation not found');
        }

        if ($reservation->getStatus() === 'expired') {
            return new GeneralResponse(
                400,
                null,
                'Reservation expired'
            );
        }

        if ($reservation->getStatus() !== 'pending') {
            return new GeneralResponse(
                400,
                null,
                'Reservation already confirmed'
            );
        }

        return new GeneralResponse(
            200,
            null,
            'Reservation retrieved successfully'
        );
    }

}
