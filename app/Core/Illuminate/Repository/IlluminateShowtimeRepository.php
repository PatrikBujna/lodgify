<?php

namespace App\Core\Illuminate\Repository;

use App\Core\Entity\Showtime;
use App\Core\Illuminate\Model\ShowtimeModel;
use App\Core\Repository\ShowtimeRepository;
use Illuminate\Support\Facades\DB;

class IlluminateShowtimeRepository implements ShowtimeRepository
{
    private string $table = 'showtimes';
    private ShowtimeModel $model;

    public function __construct(ShowtimeModel $model)
    {
        $this->model = $model;
    }

    public function store(Showtime $showtime): bool
    {
        return DB::table($this->table)->insert($showtime->toArray());
    }

    public function getAll(): array
    {
        return $this->model->get()->toArray();
    }

    public function getById(int $id): ?Showtime
    {
        $showtime = $this->model->where('id', $id)->first();

        if (empty($showtime)) {
            return null;
        }

        return $showtime;
    }

    public function update(Showtime $showtime): bool
    {
        return DB::table($this->table)->where('id', $showtime->getId())->update($showtime->toArray());
    }
}
