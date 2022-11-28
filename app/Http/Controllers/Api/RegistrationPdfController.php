<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use Barryvdh\DomPDF\PDF as PDF;



class RegistrationPdfController extends Controller
{

    public function generateLotPdf($id)
    {
        $lot = Lot::find($id);
        $data = ['data' => $lot];
        $pdf = PDF::loadView('pdf.lot', $data);
        return $pdf->download('lot.pdf');
    }
}
