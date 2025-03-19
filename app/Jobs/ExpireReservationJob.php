<?php
namespace App\Jobs;

use App\Core\Illuminate\Model\ReservationModel;
use App\Core\Illuminate\Model\ShowtimeModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExpireReservationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reservationId;

    public function __construct($reservationId)
    {
        $this->reservationId = $reservationId;
    }

    public function handle()
    {
        $reservation = ReservationModel::find($this->reservationId);
        if ($reservation && $reservation->status === 'pending') {
            $reservation->status = 'expired';
            $reservation->save();

            $showtime = ShowtimeModel::find($reservation->showtime_id);
            if ($showtime) {
                $availableSeats = json_decode($showtime->available_seats);
                $availableSeats = array_merge($availableSeats, json_decode($reservation->seats));

                $showtime->available_seats = json_encode($availableSeats);
                $showtime->reserved_seats = json_encode(array_diff(json_decode($showtime->reserved_seats), json_decode($reservation->seats)));
                $showtime->save();
            }
        }
    }
}

