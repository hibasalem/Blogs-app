<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class logger
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            \Log::info('User Request Log', [
                'user_id' => $user->id,
                'user_name' => $user->name ?? null,
                'user_email' => $user->email ?? null,
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'timestamp' => now()->toDateTimeString(),
            ]);
        } else {
            \Log::info('Guest Request Log', [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'timestamp' => now()->toDateTimeString(),
            ]);
        }

        return $next($request);
    }
}
