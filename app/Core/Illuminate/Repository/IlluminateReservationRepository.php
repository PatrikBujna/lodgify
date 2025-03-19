<?php

namespace App\Core\Illuminate\Repository;

use App\Core\Entity\Reservation;
use App\Core\Illuminate\Model\ReservationModel;
use App\Core\Repository\ReservationRepository;
use Illuminate\Support\Facades\DB;

class IlluminateReservationRepository implements ReservationRepository
{
    private string $table = 'reservations';
    private ReservationModel $model;

    public function __construct(ReservationModel $model)
    {
        $this->model = $model;
    }

    public function store(Reservation $reservation): ?int
    {
        $result = DB::table($this->table)->insert($reservation->toArray());

        if ($result === true) {
            return DB::getPdo()->lastInsertId();
        }

        return null;
    }

    public function getByUid(string $uid): ?Reservation
    {
        $result = $this->model->where('uid', $uid)->first();

        if ($result === null) {
            return null;
        }

        return $result;
    }

    public function updateStatus(string $uid, string $status): bool
    {
        return DB::table($this->table)->where('uid', $uid)->update(['status' => $status]);
    }
}
