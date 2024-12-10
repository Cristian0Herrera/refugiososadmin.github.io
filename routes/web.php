<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/pdf/generate/refugiados', [PdfController::class, 'RefugiadosRecords'])->name('pdf.example');
