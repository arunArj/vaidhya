<?php

namespace App\Filament\Resources\OPBillResource\Pages;

use App\Filament\Resources\OPBillResource;
use App\Models\IncomeExpense;
use App\Models\MedicalTests;
use App\Models\OPBill;
use App\Models\Patients;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOPBill extends CreateRecord
{
    protected static string $resource = OPBillResource::class;
    protected function getTitle(): string
    {
        return __('IP Bills');
    }
    // protected function beforeCreate(): void
    // {
    //    dd($this->data['cashbook']['amount'] );
    // }
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
       $this->data['total'] =  $sum ;

   return $this->data;

    }
    protected function afterCreate()
    {
        $id = $this->record->id;
        $total=0;

        foreach($this->record->fees as $key=>$item){
            $total = $total +( $item['fee']*$item['quantity']);
        }
        if($this->data['refund']){
            $total = $total - $this->data['refund'];
        }
//dd($total,$total,$this->data['refund']);
        IncomeExpense::create([
            'type' => 0,
            'purpose' => 'ipbill-'.$this->record->bill_no,
            'amount' => $total,
            'payment_note' => $this->record->payment_note,
            'refund' => $this->data['refund'],
            'refund_note' => $this->record->refund_note,
            'cashbookable_id' => $this->record->id,
            'cashbookable_type' => 'App\Models\OPBill',
            'category_id' => '1',
        ]);
    }
}
