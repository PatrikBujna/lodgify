<?php

namespace App\Core\Entity;

use DateTime;

interface Showtime
{
    public function getMovieId(): string;

    public function setMovieId(string $movieId): void;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getAuditorium(): string;

    public function setAuditorium(string $auditorium): void;

    public function getStartTime(): DateTime;

    public function setStartTime(DateTime $startTime): void;

    public function getAvailableSeats(): array;

    public function setAvailableSeats(array $availableSeats): void;

    public function getReservedSeats(): ?array;

    public function setReservedSeats(?array $reservedSeats): void;

    public function getId(): ?int;

    public function toArray();
}
