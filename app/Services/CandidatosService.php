<?php

namespace App\Services;


use App\Objects\CandidatoObj;
use App\Models\Candidato;





class CandidatosService
{

    public static function listar($obtenerObjetos = false)
    {

        // Cargar usuarios y mapearlos a objetos de UsuarioObj
        return Candidato::all()->map(function ($candidato) use ($obtenerObjetos) {
            $candidatoObj = new CandidatoObj();
            $candidatoObj->setCandidatoId($candidato->id);
            $candidatoObj->setNombreCandidato($candidato->nombre);
            $candidatoObj->setApellidoPaterno($candidato->apellido_paterno);
            $candidatoObj->setApellidoMaterno($candidato->apellido_materno);
            $candidatoObj->setEstatus($candidato->status);
            $candidatoObj->setRfc($candidato->rfc);
            $candidatoObj->setCurp($candidato->curp);
            $candidatoObj->setNss($candidato->nss);
            $candidatoObj->setDireccion1($candidato->direccion1);
            $candidatoObj->setDireccion2($candidato->direccion2);
            $candidatoObj->setEstado($candidato->estado);
            $candidatoObj->setCiudad($candidato->ciudad);
            $candidatoObj->setCp($candidato->cp);
            $candidatoObj->setPais($candidato->pais);
            $candidatoObj->setPuesto($candidato->puesto);
            $candidatoObj->setSalarioDiario($candidato->salario_diario);
            $candidatoObj->setFechaIngreso($candidato->fecha_ingreso);
            $candidatoObj->setCorreoElectronico($candidato->correo_electronico);

            return $obtenerObjetos ? $candidatoObj->obtenerObj() : $candidatoObj;
        })->toArray();
    }
}
