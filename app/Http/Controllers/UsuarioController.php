<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Usuario; // Asegúrate de que el nombre del modelo sea 'Usuario'
use Illuminate\Support\Facades\Auth;


class UsuarioController extends Controller
{
  public function crear(Request $request)
  {
    // Validación de datos
    $validator = Validator::make($request->all(), [
      'usuario' => 'required|string|max:255|unique:usuarios',
      'correo' => 'required|string|max:255|unique:usuarios',
      'nombre_completo' => 'required|string|max:255',
      'password' => 'required|string|confirmed',
      'superusuario' => 'nullable|boolean',
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    // Crear el usuario
    Usuario::create([
      'usuario' => $request->usuario,
      'correo' => $request->correo,
      'nombre_completo' => $request->nombre_completo,
      'password' => Hash::make($request->password),
      'superusuario' => (int)$request->input('superusuario', 0),
    ]);

    return redirect()->route('usuarios.listar')->with('success', 'Usuario registrado con éxito.');
  }

  public function actualizar(Request $request, $id)
  {
    // Validación de los datos de entrada
    $request->validate([
      'usuario' => 'required|string|max:255', // Sin validación de unicidad
      'correo' => 'required|email|max:255', // Sin validación de unicidad
      'nombre_completo' => 'required|string|max:255',
      'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional, debe ser confirmada si se proporciona
    ]);

    // Buscar al usuario por ID
    $usuario = Usuario::findOrFail($id);

    // Obtener solo los campos del formulario que se desean actualizar
    $campos = $request->only([
      'usuario',
      'correo',
      'nombre_completo',
    ]);

    // Si la contraseña fue proporcionada, encriptarla con Hash::make
    if ($request->filled('password')) {
      $campos['password'] = Hash::make($request->password);
    }

    // Actualizar el usuario
    $usuario->update($campos);

    // Redirigir con un mensaje de éxito
    return redirect()->route('usuarios.listar')->with('success', 'Usuario actualizado exitosamente');
  }




  public function editar(Request $request, $id)
  {

    $usuarios = Usuario::findOrFail($id);
    return view('EditarU', compact('usuarios'));
  }

  public function listar()
  {
    $usuario = Auth::user();
    // Cargar usuarios
    $usuarios = Usuario::all(); // Se obtienen todos los usuarios

    // Pasar los usuarios a la vista
    return view('usuarios', compact('usuarios', 'usuario'));
  }
  public function eliminar(Request $request, $id)
  {
    // Buscar al candidato por su ID
    $usuarios = Usuario::findOrFail($id);

    // Eliminar el candidato
    $usuarios->delete();

    // Redirigir con un mensaje de éxito
    return redirect()->route('usuarios.listar')->with('success', 'Usuario eliminado exitosamente');
  }
}
