<?php

namespace App\Filament\Resources\OPBillResource\Pages;

use App\Filament\Resources\OPBillResource;
use App\Filament\Resources\OPBillResource\Widgets\CashBook;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOPBills extends ListRecords
{
    protected static string $resource = OPBillResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label("New IP Bill"),
        ];
    }
    protected function getTitle(): string
    {
        return __('IP Bill');
    }
    protected function getHeaderWidgets(): array
    {
        return [
           // CashBook::class
        ];
    }

}
