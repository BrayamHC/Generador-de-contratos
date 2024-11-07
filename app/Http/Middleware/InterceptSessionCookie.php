<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InterceptSessionCookie
{
    public function handle(Request $request, Closure $next)
    {
        $sessionId = $request->cookie('laravel_session');
            \Log::info('Cookie de sesión interceptada: ' . $sessionId); // Aquí puedes manipular el contenido de la sesión si es necesario
        return $next($request);
    }
}
