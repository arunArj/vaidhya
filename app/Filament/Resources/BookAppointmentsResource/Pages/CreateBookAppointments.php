<?php

namespace App\Filament\Resources\BookAppointmentsResource\Pages;

use App\Filament\Resources\BookAppointmentsResource;
use App\Filament\Resources\BookAppointmentsResource\Widgets\AppointmentWidget;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookAppointments extends CreateRecord
{
    protected static string $resource = BookAppointmentsResource::class;


}
