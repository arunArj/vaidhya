<?php

namespace App\Filament\Resources\LabInvoiceResource\Pages;

use App\Filament\Resources\LabInvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLabInvoices extends ListRecords
{
    protected static string $resource = LabInvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
