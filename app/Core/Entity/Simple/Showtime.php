<?php

namespace App\Core\Entity\Simple;

use App\Core\Base\Arrayable;
use App\Core\Entity\Showtime as ShowtimeInterface;
use DateTime;

class Showtime implements ShowtimeInterface, Arrayable
{
    private string $movieId;
    private string $title;
    private string $auditorium;
    private DateTime $startTime;
    private array $availableSeats;
    private ?array $reservedSeats;
    private ?int $id;

    public function __construct(
        string $movieId,
        string $title,
        string $auditorium,
        DateTime $startTime,
        array $availableSeats,
        ?array $reservedSeats
    ) {
        $this->movieId = $movieId;
        $this->title = $title;
        $this->auditorium = $auditorium;
        $this->startTime = $startTime;
        $this->availableSeats = $availableSeats;
        $this->reservedSeats = $reservedSeats;
    }

    public function getMovieId(): string
    {
        return $this->movieId;
    }

    public function setMovieId(string $movieId): void
    {
        $this->movieId = $movieId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuditorium(): string
    {
        return $this->auditorium;
    }

    public function setAuditorium(string $auditorium): void
    {
        $this->auditorium = $auditorium;
    }

    public function getStartTime(): DateTime
    {
        return $this->startTime;
    }

    public function setStartTime(DateTime $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getAvailableSeats(): array
    {
        return $this->availableSeats;
    }

    public function setAvailableSeats(array $availableSeats): void
    {
        $this->availableSeats = $availableSeats;
    }

    public function getReservedSeats(): ?array
    {
        return $this->reservedSeats;
    }

    public function setReservedSeats(?array $reservedSeats): void
    {
        $this->reservedSeats = $reservedSeats;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'movie_id' => $this->movieId,
            'title' => $this->title,
            'auditorium' => $this->auditorium,
            'start_time' => $this->startTime->format('Y-m-d H:i:s'),
            'available_seats' => json_encode($this->availableSeats),
            'reserved_seats' => json_encode($this->reservedSeats)
        ];
    }
}
