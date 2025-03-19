<?php

namespace App\Core\Illuminate\Model;

use App\Core\Entity\Reservation;
use Illuminate\Database\Eloquent\Model;

class ReservationModel extends Model implements Reservation
{
    protected $table = 'reservations';
    protected $fillable = ['showtime_id', 'seats', 'status'];

    public function getShowtimeId(): int
    {
        return $this->getAttribute('movie_id');
    }

    public function setShowtimeId(int $showtimeId): void
    {
        $this->setAttribute('movie_id', $showtimeId);
    }

    public function getSeats(): array
    {
        return $this->getAttribute('seats');
    }

    public function setSeats(array $seats): void
    {
        $this->setAttribute('seats', $seats);
    }

    public function getStatus(): string
    {
        return $this->getAttribute('status');
    }

    public function setStatus(string $status): void
    {
        $this->setAttribute('status', $status);
    }

    public function getUid(): string
    {
        return $this->getAttribute('uid');
    }

    public function setUid(string $uid): void
    {
        $this->setAttribute('uid', $uid);
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }
}
