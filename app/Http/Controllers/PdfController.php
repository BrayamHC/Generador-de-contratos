<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Candidato;

class PdfController extends Controller
{
  public function guardarPdf(Request $request)
  {
    if ($request->hasFile('pdf')) {
      $file = $request->file('pdf');
      $originalFileName = $file->getClientOriginalName();

      // Extraer el ID del candidato del nombre del archivo
      preg_match('/impresion_contrato_candidato_(\d+)\.pdf/', $originalFileName, $matches);

      if (isset($matches[1])) {
        $candidatoId = $matches[1];

        // Buscar al candidato por ID
        $candidato = Candidato::find($candidatoId);
        if ($candidato) {
          // Guardar el archivo en storage/app/pdfs
          $filePath = $file->storeAs('pdfs', $originalFileName, 'pdfs');

          // Actualizar el status_impresion a 1
          $candidato->status_impresion = 1;
          $candidato->save();

          return response()->json([
            'success' => true,
            'message' => 'Archivo PDF recibido y almacenado exitosamente',
            'path' => $filePath
          ]);
        } else {
          return response()->json([
            'success' => false,
            'message' => 'Candidato no encontrado con el ID proporcionado'
          ], 404);
        }
      } else {
        return response()->json([
          'success' => false,
          'message' => 'El nombre del archivo no contiene un ID de candidato válido'
        ], 400);
      }
    } else {
      return response()->json([
        'success' => false,
        'message' => 'No se recibió ningún archivo'
      ], 400);
    }
  }
}
