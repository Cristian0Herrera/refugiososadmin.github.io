<?php

namespace App\Http\Controllers;

use App\Models\Refugiados;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{ 
    public function RefugiadosRecords (Refugiados $refugiados) 
    {
        $refugiados = Refugiados::all();
        $pdf = Pdf::loadView('pdf.example', ['refugiados' => $refugiados]);
        return $pdf->stream();
    }
}
