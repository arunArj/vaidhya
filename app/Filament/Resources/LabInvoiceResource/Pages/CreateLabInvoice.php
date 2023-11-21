<?php

namespace App\Filament\Resources\LabInvoiceResource\Pages;

use App\Filament\Resources\LabInvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLabInvoice extends CreateRecord
{
    protected static string $resource = LabInvoiceResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
