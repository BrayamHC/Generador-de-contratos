<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class VacacionesController extends Controller{


    public function listar ()
    {
        return view('vacaciones.VacacionesGestor');
    }










}