<?php

namespace App\Filament\Resources\PatientsResource\Pages;

use App\Filament\Resources\PatientsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPatients extends ViewRecord
{
    protected static string $view = 'filament.patients.patients_view';
    protected static string $resource = PatientsResource::class;


}
