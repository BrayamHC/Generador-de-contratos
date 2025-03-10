<?php

namespace App\Objects;

/*
|--------------------------------------------------------------------------
| Clase para crear objetos de usuario
|--------------------------------------------------------------------------
*/


class UsuarioObj
{
    private  $usuarioId;
    private  $nombreUsuario;
    private  $correoUsuario;
    private  $nombreCompletoUsuario;
    private  $superUsuario;
    private  $fechaCreacionUsuario;





    /****************************************/
    /**************** Getters ***************/
    /****************************************/
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }
    public function getCorreoUsuario()
    {
        return $this->correoUsuario;
    }
    public function getNombreCompletoUsuario()
    {
        return $this->nombreCompletoUsuario;
    }
    public function getSuperUsuario()
    {
        return $this->superUsuario;
    }
    public function getFechaCreacionUsuario()
    {
        return $this->fechaCreacionUsuario;
    }
    /****************************************/
    /**************** Setters ***************/
    /****************************************/
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }
    public function setNombreCompletoUsuario($nombreCompletoUsuario)
    {
        $this->nombreCompletoUsuario = $nombreCompletoUsuario;
    }
    public function setCorreo($correoUsuario)
    {
        $this->correoUsuario = $correoUsuario;
    }
    public function setSuperUsuario($superUsuario)
    {
        $this->superUsuario = $superUsuario;
    }
    public function setFechaCreacionUsuario($fechaCreacionUsuario)
    {
        $this->fechaCreacionUsuario = $fechaCreacionUsuario;
    }

    /****************************************/
    /**************** Métodos ***************/
    /****************************************/

    public function toJSON()
    {
        $UsuarioObj = $this->obtenerObj();
        return json_encode($UsuarioObj);
    }

    public function inicializarDesdeObj($datos)
    {
        $this->usuarioId                        = $datos->id;
        $this->nombreUsuario                    = $datos->nombre;
        $this->correoUsuario                    = $datos->correo;
        $this->nombreCompletoUsuario            = $datos->nombre_completo;
        $this->superUsuario                     = $datos->superusuario;
        $this->fechaCreacionUsuario             = $datos->created_at;
    }

    public function obtenerObj()
    {
        $usuarioObj = get_object_vars($this);
        return $usuarioObj;
    }
}
