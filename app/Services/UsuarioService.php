<?php

namespace App\Services;


use App\Objects\UsuarioObj;
use App\Models\Usuario;





class UsuarioService
{

    public static function listar($obtenerObjetos = false)
    {

        // Cargar usuarios y mapearlos a objetos de UsuarioObj
        return Usuario::all()->map(function ($user) use ($obtenerObjetos) {
            $usuarioObj = new UsuarioObj();
            $usuarioObj->setUsuarioId($user->id);
            $usuarioObj->setNombreUsuario($user->usuario);
            $usuarioObj->setNombreCompletoUsuario($user->nombre_completo);
            $usuarioObj->setCorreo($user->correo);
            $usuarioObj->setSuperUsuario($user->superusuario);
            $usuarioObj->setFechaCreacionUsuario($user->created_at->format('Y-m-d H:i:s'));

            return $obtenerObjetos ? $usuarioObj->obtenerObj() : $usuarioObj;
        })->toArray();
    }
}
