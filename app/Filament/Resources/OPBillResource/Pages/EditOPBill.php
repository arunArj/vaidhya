<?php

namespace App\Filament\Resources\OPBillResource\Pages;

use App\Filament\Resources\OPBillResource;
use App\Models\IncomeExpense;
use App\Models\MedicalTests;
use App\Models\Patients;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOPBill extends EditRecord
{
    protected static string $resource = OPBillResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getTitle(): string
    {
        return __('IP Bill');
    }
    protected function afterSave(): void
    {

        $patient = Patients::find($this->data['patients_id']);
        //$cashbook = IncomeExpense::where() $this->record->id;
        $total = 0;
        foreach($this->data['fees'] as $key=>$item ){

         $tests = MedicalTests::where('id',$item['medical_tests_id'])->first();
         switch($patient->user_type){
                 case '0':
                   $fee = $tests['local_fee'];
                   break;
                 case '1':
                     $fee = $tests['indian_fee'];
                     break;
                 case '2':
                     $fee = $tests['int_fee'];
                     break;
                 default :
                     $fee = $tests['local_fee'];
             }
            $out[] =['medical_tests_id'=>$tests->id,'quantity'=>$this->data['fees'][$key]['quantity'],'fee'=>$fee];
            $total = $total +( $fee*$this->data['fees'][$key]['quantity']);
       }

    if($this->record->refund){
        $total -= $this->record->refund;
    }
       $this->data['fees'] = $out;
       $this->data['total'] = $total;
       $this->record['total'] = $total;
       $this->record['fees']=$out;
       $this->record->cashbook['amount'] = $total;
       $this->record->cashbook['refund'] =  $this->data['refund'];
       $this->record->cashbook['refund_note'] =  $this->data['refund_note'];
       $this->record->cashbook['payment_note'] =  $this->data['payment_note'];
       $this->record->cashbook->save();
      ;
    }
}
