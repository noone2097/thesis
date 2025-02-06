<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('AdminMiddleware handle method called', [
            'path' => $request->path(),
            'user' => Auth::user()?->id,
            'is_admin' => Auth::user()?->is_admin ?? false
        ]);

        if (!Auth::check() || !Auth::user()->is_admin) {
            Log::warning('Unauthorized access attempt', [
                'path' => $request->path(),
                'user' => Auth::user()?->id
            ]);
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
