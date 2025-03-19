<?php

namespace App\Core\Entity;

interface Reservation
{
    public function getShowtimeId(): int;

    public function setShowtimeId(int $showtimeId): void;

    public function getSeats(): array;

    public function setSeats(array $seats): void;

    public function getStatus(): string;

    public function setStatus(string $status): void;

    public function getUid(): string;

    public function setUid(string $uid): void;

    public function getId(): ?int;
}
