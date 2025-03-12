<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImpresionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function () {
    return view('inicio');
});


// Ruta de registro de usuario
Route::get('/Usuario/Registro', function () {
    return view('/usuarios.UsuariosAgregar');
})->middleware('auth')->name('UsuarioAgregar');

//Ruta para registro de candidato
Route::get('/Registro/Candidato', function () {
    return view('/candidatos.CandidatosAgregar');
})->middleware('auth')->name('RegistroC');


Route::get('/principal', [AuthController::class, 'principal'])->middleware('auth')->name('principal');

// Rutas de inicio de sesión
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('sesion');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//RUTAS DE USUARIO
// Ruta para crear usuario
Route::post('/usuarios', [UsuarioController::class, 'crear'])->middleware('auth')->name('usuarios.crear');
//Ruta de vista de usuarios
Route::get('/usuariosGestor', [UsuarioController::class, 'listar'])->middleware('auth')->name('usuarios.listar');
//RUTA PARA VER USUARIO
Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->middleware('auth')->name('usuarios.editar');
//Ruta que manda para actualizar el usuario
Route::patch('/usuarios/{id}', [UsuarioController::class, 'actualizar'])->middleware('auth')->name('usuarios.actualizar');
//Ruta para eliminar usuario
Route::delete('/usuarios/{id}', [UsuarioController::class, 'eliminar'])->middleware('auth')->name('usuarios.eliminar');

//RUTAS DE CANDIDATO
//Ruta de vista de candidato
Route::post('/candidatos', [CandidatoController::class, 'crear'])->middleware('auth')->name('candidatos.crear');
//Ruta de crear candidato
Route::get('/candidatosGestor', [CandidatoController::class, 'listar'])->middleware('auth')->name('candidatos.listar');
//Ruta para ver candidato especifico
Route::get('/candidatos/{id}', [CandidatoController::class, 'mostrar'])->middleware('auth')->name('candidatos.mostrar');
//Ruta para ver editar candidato
Route::get('/candidatos/editar/{id}', [CandidatoController::class, 'editar'])->middleware('auth')->name('candidatos.editar');
//Ruta que manda para actualizar el candidato
Route::patch('/candidatos/{id}', [CandidatoController::class, 'actualizar'])->middleware('auth')->name('candidatos.actualizar');
//Ruta para eliminar candidato
Route::delete('/candidatos/{id}', [CandidatoController::class, 'eliminar'])->middleware('auth')->name('candidatos.eliminar');

//RUTAS DE IMPRESION
Route::get('/impresion/{id}', [ImpresionController::class, 'enviarImpresion'])->middleware('auth')->name('impresion.enviar');
//Ruta de js
Route::get('/impresion/descargar/{id}', [ImpresionController::class, 'descargarPdf']);

//RUTAS DE EMPLEADOS
Route::get('/empleadosGestor', [EmpleadoController::class, 'listar'])->middleware('auth')->name('empleados.listar');
Route::post('/empleados', [EmpleadoController::class, 'crear'])->middleware('auth')->name('empleados.crear');
Route::patch('/empleados/{id}', [EmpleadoController::class, 'actualizar'])->middleware('auth')->name('empleados.actualizar');
Route::delete('/empleados/{id}', [EmpleadoController::class, 'eliminar'])->middleware('auth')->name('empleados.eliminar');


