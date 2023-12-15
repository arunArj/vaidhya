<?php

namespace App\Filament\Resources\AdvancesResource\Pages;

use App\Filament\Resources\AdvancesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdvances extends ListRecords
{
    protected static string $resource = AdvancesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
