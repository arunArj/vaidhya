<?php

namespace App\Http\Controllers;

use App\Models\BookAppointments;
use App\Models\OPBill;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
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
        if($record->patients->sex=='0'){
            $gender = 'male';
        }elseif($record->patients->sex=='1'){
            $gender = 'female';
        }
        else{
            $gender = 'other';
        }
        $data=[
            'id'=>$record->id,
            'name'=>$record->patients->name,
            'age'=>$record->patients->age,
            'date'=>$record->visit_date,
            'fee'=>$record->fee,
            'billno'=>$record->opbill_no,
            'sex'=>$gender,
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf = $pdf->loadView('pdf.opbill',$data);
        //return $pdf->download('invoice2.pdf');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();

    }
    public function ipbill($record){
        $record = OPBill::find($record);
        $start = $record->do_admission;
        $end =  $record->do_discharge;
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse( $end );
        if($record->patients->sex=='0'){
            $sex ='Male';
        }
        elseif($record->patients->sex=='1'){
            $sex ='Female';
        }
        else{
            $sex ='Other';
        }
        // Find the difference in days
        $diffInDays = $endDate->diffInDays($startDate);
        $data=[
            'id'=>$record->id,
            'name'=>$record->patients->name,
            'mrd_no'=>$record->patients->mrd_no,
            'sex'=>$sex,
            'phone'=>$record->patients->phone,
            'room'=>$record->room_no,
            'room_rent'=>$diffInDays*$record->room_rent,
            'ip_number'=>$record->ip_number,
            'gst_no'=>$record->gst_no,
            'do_admission'=>$record->do_admission,
            'do_discharge'=>$record->do_discharge,
            'bill_no'=>$record->bill_no,
            'admission_fee'=>$record->admission_fee,
            'consultaion_fee'=>$record->consultaion_fee,
            'pshysio'=>$record->pshysio,
            'nursing_fee'=>$record->nursing_fee,
            'date'=>$record->created_at,
            'total'=>$record->total,
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

