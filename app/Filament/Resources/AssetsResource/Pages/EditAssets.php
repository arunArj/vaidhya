<?php

namespace App\Filament\Resources\AssetsResource\Pages;

use App\Filament\Resources\AssetsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssets extends EditRecord
{
    protected static string $resource = AssetsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
