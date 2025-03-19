<?php

namespace App\Core\Validator;

class ReservationSeatsValidator
{
    public function setsAreContiguous(array $seats): bool
    {
        $seatsByRow = [];
        foreach ($seats as $seat) {
            $row = $seat[0]; // Extract row letter (e.g., 'A' from 'A1')
            $seatsByRow[$row][] = intval(substr($seat, 1)); // Store numeric part
        }

        // If multiple rows are selected, return false
        if (count($seatsByRow) > 1) {
            return false;
        }

        // Get the only row's seat numbers
        $seatNumbers = reset($seatsByRow);
        sort($seatNumbers); // Sort numerically

        // Ensure numbers are consecutive
        for ($i = 1; $i < count($seatNumbers); $i++) {
            if ($seatNumbers[$i] !== $seatNumbers[$i - 1] + 1) {
                return false;
            }
        }

        return true;
    }

    public function seatsAreAvailable(array $seats, array $reservedSeats, array $availableSeats): bool
    {
        foreach ($seats as $seat) {
            if (in_array($seat, $availableSeats) === false) {
                return false;
            }

            if (in_array($seat, $reservedSeats)) {
                return false;
            }
        }

        return true;
    }
}
