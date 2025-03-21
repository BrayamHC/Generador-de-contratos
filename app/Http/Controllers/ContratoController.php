<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ContratoController extends Controller{


    public function listar ()
    {
        return view('contratos.ContratosGestor');
    }










}