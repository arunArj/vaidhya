<?php

namespace App\Filament\Widgets;

use App\Models\BookAppointments;
use App\Models\IncomeExpense;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $expense = IncomeExpense::where('type','1')->sum('amount');
        $income = IncomeExpense::where('type','0')->sum('amount');
        $visit = BookAppointments::whereDate('created_at', Carbon::today())->count();
        return [
            Card::make('Expenses', $expense),
            Card::make('Income', $income),
            Card::make('patients Visit today', $visit),
        ];
    }
}
