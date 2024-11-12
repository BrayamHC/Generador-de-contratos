<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function guardarPdf(Request $request)
    {
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');

            // Guarda el archivo en storage/app/public
            $filePath = $file->storeAs('public', 'contrato_' . time() . '.pdf');

            return response()->json([
                'success' => true,
                'message' => 'Archivo PDF recibido y almacenado exitosamente',
                'path' => $filePath
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se recibió ningún archivo'
            ], 400);
        }
    }
}
