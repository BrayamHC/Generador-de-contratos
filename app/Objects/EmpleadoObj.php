<?php

namespace App\Objects;

class EmpleadoObj
{

    private $empleadoId;
    private $nombreEmpleado;
    private $apellidoMaterno;
    private $apellidoPaterno;
    private $estatus;
    private $rfc;
    private $curp;
    private $nss;
    private $direccion1;
    private $direccion2;
    private $estado;
    private $ciudad;
    private $cp;
    private $pais;
    private $puesto;
    private $salarioDiario;
    private $fechaIngreso;
    private $correoElectronico;

    /****************************************/
    /**************** Getters ***************/
    /****************************************/


    public function getEmpleadoId()
    {
        return $this->empleadoId;
    }
    public function getNombreEmpleado()
    {
        return $this->nombreEmpleado;
    }
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }
    public function getEstatus()
    {
        return $this->estatus;
    }
    public function getRfc()
    {
        return $this->rfc;
    }
    public function getCurp()
    {
        return $this->curp;
    }
    public function getNss()
    {
        return $this->nss;
    }
    public function getDireccion1()
    {
        return $this->direccion1;
    }
    public function getDireccion2()
    {
        return $this->direccion2;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getCiudad()
    {
        return $this->ciudad;
    }
    public function getCp()
    {
        return $this->cp;
    }
    public function getPais()
    {
        return $this->pais;
    }
    public function getPuesto()
    {
        return $this->puesto;
    }
    public function getSalarioDiario()
    {
        return $this->salarioDiario;
    }
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }
    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }


    /****************************************/
    /**************** Setters ***************/
    /****************************************/


    public function setEmpleadoId($empleadoId)
    {
        $this->empleadoId = $empleadoId;
    }
    public function setNombreEmpleado($nombreEmpleado)
    {
        $this->nombreEmpleado = $nombreEmpleado;
    }
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;
    }
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;
    }
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;
    }
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;
    }
    public function setCurp($curp)
    {
        $this->curp = $curp;
    }
    public function setNss($nss)
    {
        $this->nss = $nss;
    }
    public function setDireccion1($direccion1)
    {
        $this->direccion1 = $direccion1;
    }
    public function setDireccion2($direccion2)
    {
        $this->direccion2 = $direccion2;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }
    public function setCp($cp)
    {
        $this->cp = $cp;
    }
    public function setPais($pais)
    {
        $this->pais = $pais;
    }
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    }
    public function setSalarioDiario($salarioDiario)
    {
        $this->salarioDiario = $salarioDiario;
    }
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
    }
    public function setCorreoElectronico($correoElectronico)
    {
        $this->correoElectronico = $correoElectronico;
    }

    public function toJSON()
    {
        $empleadoObj = $this->obtenerObj();
        return json_encode($empleadoObj);
    }

    public function inicializarDesdeObj($datos)
    {
        $this->empleadoId                = $datos->empleado_id;
        $this->nombreEmpleado            = $datos->nombre_empleado;
        $this->apellidoMaterno           = $datos->apellido_materno;
        $this->apellidoPaterno           = $datos->apellido_paterno;
        $this->estatus                   = $datos->status;
        $this->rfc                       = $datos->rfc;
        $this->curp                      = $datos->curp;
        $this->nss                       = $datos->nss;
        $this->direccion1                = $datos->direccion1;
        $this->direccion2                = $datos->direccion2;
        $this->estado                    = $datos->estado;
        $this->ciudad                    = $datos->ciudad;
        $this->cp                        = $datos->cp;
        $this->pais                      = $datos->pais;
        $this->puesto                    = $datos->puesto;
        $this->salarioDiario             = $datos->salario_diario;
        $this->fechaIngreso              = $datos->fecha_ingreso;
        $this->correoElectronico         = $datos->correo_electronico;
    }

    public function obtenerObj()
    {
        $empleadoObj = get_object_vars($this);
        return $empleadoObj;
    }
}
