<?php

namespace App\Filament\Resources\PerformaBillsResource\Pages;

use App\Filament\Resources\PerformaBillsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerformaBills extends ListRecords
{
    protected static string $resource = PerformaBillsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
