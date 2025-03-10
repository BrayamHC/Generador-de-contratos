<?php

namespace App\Http\Middleware;

use App\Constantes\StatusConsts;
use App\Services\DespachoService;
use App\Services\EmpresaService;
use App\Services\PermisoUsuarioService;
use App\Services\UsuarioService;
use App\Utilerias\ApiResponse;
use App\Utilerias\TextoUtils;
use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;

class ValidarSesionUsuario{

    public function handle ($request, Closure $next){

    $token = $request->cookie('dxtractor_session_user_token') ?? $request->header('Authorization');

    if (!$token) {
        Log::error('El token no se encontro en la cookie ' . json_encode($request));
        throw new AuthenticationException("Sesión no válida o expirada.");
    }
     // Verificar si el token existe en Redis
    $usuario = Redis::get($token);




}
}
