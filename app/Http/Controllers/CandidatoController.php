<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use Illuminate\Support\Facades\Validator;



class CandidatoController extends Controller
{
    public function crear(Request $request)
{
    // Validación de los datos de entrada
    $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:50',
        'apellido_paterno' => 'required|string|max:50',
        'apellido_materno' => 'required|string|max:50',
        'rfc' => 'nullable|string|max:13',
        'curp' => 'nullable|string|max:18',
        'nss' => 'nullable|integer',
        'direccion1' => 'nullable|string|max:50',
        'direccion2' => 'nullable|string|max:50',
        'estado' => 'nullable|string|max:50',
        'ciudad' => 'nullable|string|max:50',
        'cp' => 'nullable|integer',
        'pais' => 'nullable|string|max:50',
        'puesto' => 'nullable|string|max:50',
        'salario_diario' => 'nullable|numeric',
        'fecha_ingreso' => 'nullable|date',
        'correo_electronico' => 'nullable|string|max:50|unique:candidatos',
    ]);

    // Verificar si la validación falla
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Recolectar todos los campos del formulario
    $campos = $request->only([
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'rfc',
        'curp',
        'nss',
        'direccion1',
        'direccion2',
        'estado',
        'ciudad',
        'cp',
        'pais',
        'puesto',
        'salario_diario',
        'fecha_ingreso',
        'correo_electronico'
    ]);

    // Verificar si alguno de los campos está vacío
    $camposCompletos = !in_array(null, $campos) && !in_array('', $campos);

    // Asignar el estatus
    $status = $camposCompletos ? 'completo' : 'en proceso';

    // Crear un nuevo candidato con los datos validados
    Candidato::create([
        'nombre' => $request->nombre,
        'apellido_paterno' => $request->apellido_paterno,
        'apellido_materno' => $request->apellido_materno,
        'rfc' => $request->rfc,
        'curp' => $request->curp,
        'nss' => $request->nss,
        'direccion1' => $request->direccion1,
        'direccion2' => $request->direccion2,
        'estado' => $request->estado,
        'ciudad' => $request->ciudad,
        'cp' => $request->cp,
        'pais' => $request->pais,
        'puesto' => $request->puesto,
        'salario_diario' => $request->salario_diario,
        'fecha_ingreso' => $request->fecha_ingreso,
        'correo_electronico' => $request->correo_electronico,
        'status' => $status,  // Asignar el estatus aquí
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('candidatos.listar')->with('success', 'Candidato registrado con éxito.');
}

    

    
    public function actualizar(Request $request, $id)
    {
        // Validación de los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'rfc' => 'nullable|string|max:255',
            'curp' => 'nullable|string|max:255',
            'nss' => 'nullable|string|max:255',
            'direccion1' => 'nullable|string|max:255',
            'direccion2' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'cp' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'puesto' => 'nullable|string|max:255',
            'salario_diario' => 'nullable|numeric',
            'fecha_ingreso' => 'nullable|date',
            'correo_electronico' => 'nullable|email|max:255',
        ]);
    
        // Buscar al candidato por ID
        $candidato = Candidato::findOrFail($id);
    
        // Obtener todos los campos del formulario
        $campos = $request->only([
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'rfc',
            'curp',
            'nss',
            'direccion1',
            'direccion2',
            'estado',
            'ciudad',
            'cp',
            'pais',
            'puesto',
            'salario_diario',
            'fecha_ingreso',
            'correo_electronico'
        ]);
    
        // Verificar si alguno de los campos está vacío
        $camposCompletos = !in_array(null, $campos) && !in_array('', $campos);
    
        // Asignar el estatus según si todos los campos están llenos o no
        $status = $camposCompletos ? 'completo' : 'en proceso';
    
        // Actualizar los datos del candidato, incluyendo el nuevo estatus
        $candidato->fill(array_merge($campos, ['status' => $status]));
        $candidato->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('candidatos.listar')->with('success', 'Candidato actualizado exitosamente');
    }
    

    public function eliminar(Request $request, $id)
    {
        
        // Buscar al candidato por su ID
        $candidato = Candidato::findOrFail($id);

        $idsello = $request->query('idsello');
        if(!$this->validarIdsello($id, $idsello)){
            return redirect()->route('candidatos.listar')->with('error', 'ACCESO NO AUTORIZADO');
        }
        
        // Eliminar el candidato
        $candidato->delete();
        
        // Redirigir con un mensaje de éxito
        return redirect()->route('candidatos.listar')->with('success', 'Candidato eliminado exitosamente');
    }
    
    public function listar()
    {
        // Cargar candidatos
        $candidatos = Candidato::all(); // Se obtienen todos los candidatos
    
        // Pasar los candidatos a la vista
        return view('candidatos', compact('candidatos')); // Cambia 'usuarios' por 'candidatos.index'
    }

    public function mostrar(Request $request,$id)
    {
        $idsello = $request->query('idsello');
        if(!$this->validarIdsello($id, $idsello)){
            return redirect()->route('candidatos.listar')->with('error', 'ACCESO NO AUTORIZADO');
        }
        $candidato = Candidato::findOrFail($id); // Encuentra al candidato o devuelve un error 404
        return view('DetallesC', compact('candidato'));
    }

    public function editar(Request $request,$id)
    {

        $idsello = $request->query('idsello');
        if(!$this->validarIdsello($id, $idsello)){
            return redirect()->route('candidatos.listar')->with('error', 'ACCESO NO AUTORIZADO');
        }

        $candidato = Candidato::findOrFail($id);
        return view('EditarC', compact('candidato'));

        
    }


    private function validarIdsello($id, $idsello)
    {
        $expectedIdsello = substr(hash('sha256', $id . config('constants.URL_SALT')), -8);
        return $idsello === $expectedIdsello;
    }





}
