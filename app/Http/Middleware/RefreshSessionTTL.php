<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RefreshSessionTTL
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            session()->setId(session()->getId());  // Refresca el ID de sesión
            session()->save();  // Guarda la sesión
            \Log::info('TTL de la sesión ha sido refrescado para el usuario: ' . auth()->user()->id);
        }

        return $next($request);
    }
}
