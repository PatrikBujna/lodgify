<?php

namespace App\Http\Controllers;

use App\Core\Handler\ShowtimeIndexHandler;
use App\Core\Handler\ShowtimeStoreHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    private ShowtimeStoreHandler $showtimeStoreHandler;
    private ShowtimeIndexHandler $showtimeIndexHandler;

    public function __construct(ShowtimeStoreHandler $showtimeStoreHandler, ShowtimeIndexHandler $showtimeIndexHandler)
    {
        $this->showtimeStoreHandler = $showtimeStoreHandler;
        $this->showtimeIndexHandler = $showtimeIndexHandler;
    }

    public function create(Request $request, string $movieId): JsonResponse
    {
        $validated = $request->validate([
            'auditorium' => 'required|string',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'seats' => 'required|array|min:1'
        ]);

        $response = $this->showtimeStoreHandler->store($movieId, $validated);

        return response()->json($response->toArray(), $response->getStatusCode());
    }

    public function index(): JsonResponse
    {
        $response = $this->showtimeIndexHandler->getAll();

        return response()->json($response->toArray(), $response->getStatusCode());
    }
}
