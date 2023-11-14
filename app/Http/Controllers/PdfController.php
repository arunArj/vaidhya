<?php

namespace App\Http\Controllers;

use App\Models\BookAppointments;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function index(Request $request){
        $id =$request->input('id');
        $record = BookAppointments::find($id);
        $data=[
            'patient' =>$record->patients->name,
            'doctor' =>$record->doctors_id,
            'doctor' =>$record->doctors_id,

        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf = $pdf->loadView('pdf.invoice',$data);
        //return $pdf->download('invoice2.pdf');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();

    }
}
