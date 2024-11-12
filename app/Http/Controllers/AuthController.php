<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Asegúrate de que este es el modelo correcto
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('login'); // Muestra la vista de login
    }

    public function principal()
    {
        return view('principal'); // Muestra la vista de login
    }
 
// En AuthController.php
public function login(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'usuario' => 'required', // Cambié 'email' por 'required' si 'usuario' no es un correo
        'password' => 'required',
    ]);

    // Intentar obtener el usuario por nombre de usuario
    $usuario = Usuario::where('usuario', $request->usuario)->first(); // Usa 'correo' o 'usuario' según tu preferencia

    if ($usuario) {
        // Verificar si la contraseña es correcta
        if (Hash::check($request->password, $usuario->password)) {
            Auth::login($usuario);
            // Redirigir a la página principal con un mensaje de éxito
            return redirect('/principal')->with('success', 'Has iniciado sesión con éxito');
        } else {
            return back()->withErrors(['password' => 'Las credenciales son incorrectas.']);
        }
    }

    return back()->withErrors(['usuario' => 'El usuario no existe.']);
}

    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
}