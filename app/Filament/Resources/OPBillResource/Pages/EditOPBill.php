<?php

namespace App\Filament\Resources\OPBillResource\Pages;

use App\Filament\Resources\OPBillResource;
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
}
