<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogExecutionTime
{
    public function handle(Request $request, Closure $next)
    {
        $startTime = microtime(true);

        $response = $next($request);

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);

        Log::info('Execution Time', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'execution_time_ms' => $executionTime
        ]);

        return $response;
    }
}
