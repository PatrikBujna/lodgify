<?php

namespace App\Core\Repository;

use App\Core\Entity\Showtime;

interface ShowtimeRepository
{
    public function store(Showtime $showtime): bool;

    public function getAll(): array;

    public function getById(int $id): ?Showtime;

    public function update(Showtime $showtime): bool;
}
