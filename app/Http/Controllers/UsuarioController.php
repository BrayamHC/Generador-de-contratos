<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Usuario; // Asegúrate de que el nombre del modelo sea 'Usuario'

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
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear el usuario
        Usuario::create([ // Cambia 'usuario::crear' por 'Usuario::create'
            'usuario' => $request->usuario, // Asegúrate de que el nombre del campo sea correcto
            'correo' => $request->correo, // Asegúrate de que el nombre del campo sea correcto
            'nombre_completo' => $request->nombre_completo, // Usa 'nombre_completo' en lugar de 'nombre'
            'password' => Hash::make($request->password), // Asegúrate de que el nombre del campo sea correcto
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
    
    


    public function editar(Request $request,$id)
    {
        
        $usuarios = Usuario::findOrFail($id);
        return view('EditarU', compact('usuarios'));
    }
    
    public function listar()
    {
        // Cargar usuarios con sus relaciones de imagen de perfil y thumbnails
        $usuarios = Usuario::all(); // Se obtienen todos los usuarios

        // Pasar los usuarios a la vista
        return view('usuarios', compact('usuarios'));
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


