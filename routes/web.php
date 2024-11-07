<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CandidatoController;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Ruta de registro de usuario
Route::get('/Registro/Usuario', function () {
    return view('RegistroS');
});
//Ruta para registro de candidato
Route::get('/Registro/Candidato', function () {
    return view('RegistroC');
});
Route::get('/principal', [AuthController::class, 'principal'])->name('principal');

// Rutas de inicio de sesión
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('sesion');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//RUTAS DE USUARIO
// Ruta para crear usuario
Route::post('/usuarios', [UsuarioController::class, 'crear'])->name('usuarios.crear');
//Ruta de vista de usuarios
Route::get('/usuarios', [UsuarioController::class, 'listar'])->name('usuarios.listar');
//RUTA PARA VER USUARIO
Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->name('usuarios.editar');
//Ruta que manda para actualizar el usuario
Route::patch('/usuarios/{id}', [UsuarioController::class, 'actualizar'])->name('usuarios.actualizar');
//Ruta para eliminar usuario
Route::delete('/usuarios/{id}', [UsuarioController::class, 'eliminar'])->name('usuarios.eliminar');

//RUTAS DE CANDIDATO
//Ruta de vista de candidato
Route::post('/candidatos', [CandidatoController::class, 'crear'])->name('candidatos.crear');
//Ruta de crear candidato
Route::get('/candidatos', [CandidatoController::class, 'listar'])->name('candidatos.listar');
//Ruta para ver candidato especifico
Route::get('/candidatos/{id}', [CandidatoController::class, 'mostrar'])->name('candidatos.mostrar');
//Ruta para ver editar candidato
Route::get('/candidatos/{id}/editar', [CandidatoController::class, 'editar'])->name('candidatos.editar');
//Ruta que manda para actualizar el candidato
Route::post('/candidatos/{id}/editar', [CandidatoController::class, 'actualizar'])->name('candidatos.actualizar');
//Ruta para eliminar candidato
Route::delete('/candidatos/{id}', [CandidatoController::class, 'eliminar'])->name('candidatos.eliminar');
