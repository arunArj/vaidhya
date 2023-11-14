<?php

namespace App\Filament\Resources\LabInvoiceResource\Pages;

use App\Filament\Resources\LabInvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLabInvoice extends EditRecord
{
    protected static string $resource = LabInvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
