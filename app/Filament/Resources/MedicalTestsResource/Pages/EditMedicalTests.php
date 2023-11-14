<?php

namespace App\Filament\Resources\MedicalTestsResource\Pages;

use App\Filament\Resources\MedicalTestsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalTests extends EditRecord
{
    protected static string $resource = MedicalTestsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
