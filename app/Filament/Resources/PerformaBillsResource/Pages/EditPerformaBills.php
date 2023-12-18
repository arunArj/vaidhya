<?php

namespace App\Filament\Resources\PerformaBillsResource\Pages;

use App\Filament\Resources\PerformaBillsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPerformaBills extends EditRecord
{
    protected static string $resource = PerformaBillsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
