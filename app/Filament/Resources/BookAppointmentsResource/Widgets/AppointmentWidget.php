<?php

namespace App\Filament\Resources\BookAppointmentsResource\Widgets;


use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class AppointmentWidget extends Widget
{
    protected static string $view = 'filament.resources.book-appointments-resource.widgets.appointment-widget';
    public ?Model $record = null;
    public function generatePdf(){
        $pdf = App::make('dompdf.wrapper');
        $pdf = $pdf->loadView('pdf.invoice');
        //return $pdf->download('invoice2.pdf');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();


    }
}
