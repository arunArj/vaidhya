<?php

namespace App\Filament\Resources\DoctorsResource\Pages;

use App\Filament\Resources\DoctorsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDoctors extends CreateRecord
{
    protected static string $resource = DoctorsResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
