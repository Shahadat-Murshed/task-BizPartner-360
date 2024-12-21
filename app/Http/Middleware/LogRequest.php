<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Structuring  the log data
        $log = [
            'Time' => now(),
            'Method' => $request->method(),
            'URL' => $request->fullUrl(),
        ];

        // Logging the data in the custom log file
        Log::channel('custom')->info(json_encode($log));

        return $next($request);
    }
}
