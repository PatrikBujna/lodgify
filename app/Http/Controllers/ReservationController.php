<?php

namespace App\Http\Controllers;

use App\Core\Handler\ReservationConfirmHandler;
use App\Core\Handler\ReservationStoreHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController
{
    private ReservationStoreHandler $reservationStoreHandler;
    private ReservationConfirmHandler $reservationConfirmHandler;

    public function __construct(
        ReservationStoreHandler $reservationStoreHandler,
        ReservationConfirmHandler $reservationConfirmHandler
    ) {
        $this->reservationStoreHandler = $reservationStoreHandler;
        $this->reservationConfirmHandler = $reservationConfirmHandler;
    }

    public function create(Request $request, int $showtimeId): JsonResponse
    {
        $validated = $request->validate([
            'seats' => 'required|array|min:1'
        ]);

        $response = $this->reservationStoreHandler->store($showtimeId, $validated);

        return response()->json($response->toArray(), $response->getStatusCode());
    }

    public function confirm(int $showtimeId, string $reservationGuid): JsonResponse
    {
        $response = $this->reservationConfirmHandler->confirm($reservationGuid);

        return response()->json($response->toArray(), $response->getStatusCode());
    }
}
