<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller{


    public function listar ()
    {
        return view('/proyectos.ProyectosGestor');
    }










}