<?php

namespace App\Filament\Resources\PerformaBillsResource\Pages;

use App\Filament\Resources\PerformaBillsResource;
use App\Models\IncomeExpense;
use App\Models\MedicalTests;
use App\Models\Patients;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePerformaBills extends CreateRecord
{
    protected static string $resource = PerformaBillsResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function beforeCreate()
    {

       $patient = Patients::find($this->data['patients_id']);
       $sum=0;
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
            $sum = $sum+($fee*$item['quantity']);
       // $this->data['fees'][$key]['fee'] = $fee;
        $out[] =['medical_tests_id'=>$tests->id,'quantity'=>$this->data['fees'][$key]['quantity'],'fee'=>$fee];
       }
       $this->data['fees'] = $out;
       $this->data['cashbook']['amount'] =  $sum - $this->data['cashbook']['refund'] ;
       $this->data['total'] =  $sum;
       $this->data['cashbook']['purpose'] = 'performa-'.$this->data['bill_no'];

   return $this->data;

    }
    protected function afterCreate()
    {
        $this->record->cashbook->purpose = 'performa-bill-'.$this->record->bill_no;
        $this->record->cashbook->amount = $this->record->total;
        if($this->record->cashbook->refund){
            $this->record->cashbook->amount =  $this->record->total - $this->record->cashbook->refund;
        }

        $this->record->cashbook->save();

    }
}
