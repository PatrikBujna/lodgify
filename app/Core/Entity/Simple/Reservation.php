<?php

namespace App\Core\Entity\Simple;

use App\Core\Base\Arrayable;
use App\Core\Entity\Reservation as ReservationInterface;

class Reservation implements ReservationInterface, Arrayable
{
    private int $showtimeId;
    private array $seats;
    private string $status;
    private string $uid;
    private ?int $id;

    public function __construct(int $showtimeId, array $seats, string $status, string $uid)
    {
        $this->showtimeId = $showtimeId;
        $this->seats = $seats;
        $this->status = $status;
        $this->uid = $uid;
    }

    public function getShowtimeId(): int
    {
        return $this->showtimeId;
    }

    public function setShowtimeId(int $showtimeId): void
    {
        $this->showtimeId = $showtimeId;
    }

    public function getSeats(): array
    {
        return $this->seats;
    }

    public function setSeats(array $seats): void
    {
        $this->seats = $seats;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     */
    public function setUid(string $uid): void
    {
        $this->uid = $uid;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'showtime_id' => $this->showtimeId,
            'seats' => json_encode($this->seats),
            'status' => $this->status,
            'uid' => $this->uid
        ];
    }
}
