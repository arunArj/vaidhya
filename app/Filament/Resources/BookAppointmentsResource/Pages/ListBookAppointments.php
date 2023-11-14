<?php

namespace App\Filament\Resources\BookAppointmentsResource\Pages;

use App\Filament\Resources\BookAppointmentsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookAppointments extends ListRecords
{
    protected static string $resource = BookAppointmentsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
