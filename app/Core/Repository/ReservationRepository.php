<?php

namespace App\Core\Repository;

use App\Core\Entity\Reservation;

interface ReservationRepository
{
    public function store(Reservation $reservation): ?int;

    public function getByUid(string $uid): ?Reservation;

    public function updateStatus(string $uid, string $status): bool;
}
