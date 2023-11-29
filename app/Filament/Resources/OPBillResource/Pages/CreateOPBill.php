<?php

namespace App\Filament\Resources\OPBillResource\Pages;

use App\Filament\Resources\OPBillResource;
use App\Models\OPBill;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOPBill extends CreateRecord
{
    protected static string $resource = OPBillResource::class;
    protected function getTitle(): string
    {
        return __('IP Bills');
    }

}
