<?php

namespace App\Filament\Resources\OPBillResource\Widgets;

use App\Models\IncomeExpense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\Widget;

class CashBook extends BaseWidget
{
    protected static string $view = 'filament.resources.o-p-bill-resource.widgets.cash-book';
    public ?IncomeExpense $record = null;
    public function __construct()
    {
       // $this->record=
    }
}
