<?php

namespace App\Filament\Resources\FeesResource\Pages;

use App\Filament\Resources\FeesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFees extends EditRecord
{
    protected static string $resource = FeesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
