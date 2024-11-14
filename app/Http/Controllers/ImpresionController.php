<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Services\RabbitMQService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImpresionController extends Controller
{
    protected $rabbitMQService;

    public function __construct(RabbitMQService $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function enviarImpresion(Request $request, $id)
    {
        try {
            // Buscar al candidato por ID
            $candidato = Candidato::findOrFail($id);

            // Obtener todos los campos necesarios del candidato
            $campos = [
                'id' => $candidato->id,
                'nombre' => $candidato->nombre,
                'apellido_paterno' => $candidato->apellido_paterno,
                'apellido_materno' => $candidato->apellido_materno,
                'rfc' => $candidato->rfc,
                'curp' => $candidato->curp,
                'nss' => $candidato->nss,
                'direccion1' => $candidato->direccion1,
                'direccion2' => $candidato->direccion2,
                'estado' => $candidato->estado,
                'ciudad' => $candidato->ciudad,
                'cp' => $candidato->cp,
                'pais' => $candidato->pais,
                'puesto' => $candidato->puesto,
                'salario_diario' => $candidato->salario_diario,
                'fecha_ingreso' => $candidato->fecha_ingreso,
                'correo_electronico' => $candidato->correo_electronico
            ];

            // Enviar el mensaje al exchange 'Contratos' con los datos del candidato
            $this->rabbitMQService->sendMessage('contratos', $campos, '*');

            // Consultar el estado de impresión cada 5 segundos hasta que cambie a 1
            while (true) {
                $status = DB::table('candidatos')->where('id', $id)->value('status_impresion');

                if ($status == 1) {
                    break;
                }

                // Esperar 5 segundos antes de la siguiente consulta
                sleep(5);
            }

            // Redirigir a la vista de carga si se completó correctamente
            return view('impresion')->with(['message' => 'Impresión completada', 'candidato' => $candidato]);
        } catch (\Exception $e) {
            // Manejar el error y mostrar un mensaje al usuario
            return redirect()->back()->withErrors(['error' => 'Hubo un problema al enviar la solicitud de impresión.']);
        }
    }
}
