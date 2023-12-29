<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CashBookOverview extends Widget
{
    public  $toDate=null;
    public  $fromDate=null;
    protected static string $view = 'filament.widgets.cash-book-overview';
    public static function canView(): bool
    {
        return false; // Example condition
    }
    public function dashboardData(){

    }
}
