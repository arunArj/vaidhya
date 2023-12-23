<?php

namespace App\Filament\Resources\AdvancesResource\Pages;

use App\Filament\Resources\AdvancesResource;
use App\Models\IncomeExpense;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdvances extends CreateRecord
{
    protected static string $resource = AdvancesResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    // protected function afterCreate()
    // {
    //     $id = $this->record->id;
    //     $total=0;

    //     IncomeExpense::create([
    //         'type' => 0,
    //         'purpose' => 'ipbill-'.$this->record->bill_no,
    //         'amount' => $this->record->amount,
    //         'payment_note' => $this->record->payment_note,
    //         'refund' => $this->record->refund,
    //         'refund_note' => $this->record->refund_note,
    //         'cashbookable_id' => $this->record->id,
    //         'cashbookable_type' => 'App\Models\Advances',
    //         'category_id' => '1',
    //     ]);
    // }
}
