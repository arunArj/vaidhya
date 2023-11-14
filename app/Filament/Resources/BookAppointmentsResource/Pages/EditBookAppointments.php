<?php

namespace App\Filament\Resources\BookAppointmentsResource\Pages;

use App\Filament\Resources\BookAppointmentsResource;
use App\Filament\Resources\BookAppointmentsResource\Widgets\AppointmentWidget;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookAppointments extends EditRecord
{
    protected static string $resource = BookAppointmentsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            AppointmentWidget::class,
        ];
    }
}
