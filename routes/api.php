<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShowtimeController;
use Illuminate\Support\Facades\Route;

Route::prefix('showtimes')->middleware(['execution.time'])->group(function () {
    Route::post('/{movieId}', [ShowtimeController::class, 'create']);
    Route::get('/', [ShowtimeController::class, 'index']);

    Route::post('/{showtimeId}/reservations', [ReservationController::class, 'create']);
    Route::patch('/{showtimeId}/reservations/{reservationGuid}/confirmation', [ReservationController::class, 'confirm']);
});
