<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::post('/guardar-pdf', [PdfController::class, 'guardarPdf']);
