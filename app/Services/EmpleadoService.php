<?php

namespace App\Services;

use App\Models\Empleado;
use App\Objects\EmpleadoObj;

class EmpleadoService
{
    public static function listar($obtenerObjetos = false)
    {

        // Cargar usuarios y mapearlos a objetos de UsuarioObj
        return Empleado::all()->map(function ($empleado) use ($obtenerObjetos) {
            $empleadoObj = new EmpleadoObj();
            $empleadoObj->setEmpleadoId($empleado->id);
            $empleadoObj->setNombreEmpleado($empleado->nombre);
            $empleadoObj->setApellidoPaterno($empleado->apellido_paterno);
            $empleadoObj->setApellidoMaterno($empleado->apellido_materno);
            $empleadoObj->setEstatus($empleado->status);
            $empleadoObj->setRfc($empleado->rfc);
            $empleadoObj->setCurp($empleado->curp);
            $empleadoObj->setNss($empleado->nss);
            $empleadoObj->setDireccion1($empleado->direccion1);
            $empleadoObj->setDireccion2($empleado->direccion2);
            $empleadoObj->setEstado($empleado->estado);
            $empleadoObj->setCiudad($empleado->ciudad);
            $empleadoObj->setCp($empleado->cp);
            $empleadoObj->setPais($empleado->pais);
            $empleadoObj->setPuesto($empleado->puesto);
            $empleadoObj->setSalarioDiario($empleado->salario_diario);
            $empleadoObj->setFechaIngreso($empleado->fecha_ingreso);
            $empleadoObj->setCorreoElectronico($empleado->correo_electronico);

            return $obtenerObjetos ? $empleadoObj->obtenerObj() : $empleadoObj;
        })->toArray();
    }
}
