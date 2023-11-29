<?php

namespace App\Http\Controllers;

use App\Models\BookAppointments;
use App\Models\OPBill;
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
    public function opbill($record){
       // dd($record);
        $record = BookAppointments::find($record);
        $data=[
            'id'=>$record->id,
            'name'=>$record->patients->name,
            'date'=>$record->visit_date,
            'fee'=>$record->fee,
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf = $pdf->loadView('pdf.opbill',$data);
        //return $pdf->download('invoice2.pdf');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();

    }
    public function ipbill($record){
        $record = OPBill::find($record);

        $data=[
            'id'=>$record->id,
            'name'=>$record->patients->name,
            'name'=>$record->patients->mrd_no,
            'name'=>$record->patients->phone,
            'room'=>$record->visit_date,
            'ip_number'=>$record->ip_number,
            'gst_no'=>$record->gst_no,
            'do_admission'=>$record->do_admission,
            'do_discharge'=>$record->do_discharge,
            'bill_no'=>$record->do_admission,
        ];
        $fees=[];
        foreach($record->tests as $item){
            if($record->patients->user_type == '0'){
                $fee= $item->local_fee;
            }
            else if($record->patients->user_type == '1'){
                $fee= $item->indian_fee;
            }else{
                $fee= $item->int_fee;
            }
          $fees[]=[
            'title'=>$item->title,
            'fee'=>$fee
          ];
        }
        $data['tests'] = $fees;
        $pdf = App::make('dompdf.wrapper');
        $pdf = $pdf->loadView('pdf.ipbill',$data);
        return $pdf->stream();
    }
}

