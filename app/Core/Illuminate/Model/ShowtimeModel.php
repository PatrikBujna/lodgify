<?php

namespace App\Core\Illuminate\Model;

use App\Core\Entity\Showtime;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class ShowtimeModel extends Model implements Showtime
{
    protected $table = 'showtimes';
    protected $fillable = ['movie_id', 'room_id', 'start_time', 'end_time'];
    protected $hidden = ['created_at', 'updated_at'];

    public function getMovieId(): string
    {
        return $this->getAttribute('movie_id');
    }

    public function setMovieId(string $movieId): void
    {
        $this->setAttribute('movie_id', $movieId);
    }

    public function getTitle(): string
    {
        return $this->getAttribute('title');
    }

    public function setTitle(string $title): void
    {
        $this->setAttribute('title', $title);
    }

    public function getAuditorium(): string
    {
        return $this->getAttribute('auditorium');
    }

    public function setAuditorium(string $auditorium): void
    {
        $this->setAttribute('auditorium', $auditorium);
    }

    public function getStartTime(): DateTime
    {
        return $this->getAttribute('start_time');
    }

    public function setStartTime(DateTime $startTime): void
    {
        $this->setAttribute('start_time', $startTime);
    }

    public function getAvailableSeats(): array
    {
        if ($this->getAttribute('available_seats') === 'null' || $this->getAttribute('available_seats') === null) {
            return [];
        }

        return json_decode($this->getAttribute('available_seats'), true);
    }

    public function setAvailableSeats(array $availableSeats): void
    {
        $this->setAttribute('available_seats', $availableSeats);
    }

    public function getReservedSeats(): ?array
    {
        if ($this->getAttribute('reserved_seats') === 'null' || $this->getAttribute('reserved_seats') === null) {
            return [];
        }

        return json_decode($this->getAttribute('reserved_seats'), true);
    }

    public function setReservedSeats(?array $reservedSeats): void
    {
        $this->setAttribute('reserved_seats', $reservedSeats);
    }

    public function getId(): ?int
    {
        if ($this->getAttribute('id') === 'null') {
            return null;
        }

        return $this->getAttribute('id');
    }
}
