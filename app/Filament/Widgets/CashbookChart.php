<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\IncomeExpense;
class CashbookChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $incomeData = Trend::query(IncomeExpense::where('type', '0'))
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->sum('amount');
        $expenseData = Trend::query(IncomeExpense::where('type', '1'))
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->sum('amount');

    return [
        'datasets' => [
            [
                'label' => 'Income',
                'data' => $incomeData->map(fn (TrendValue $value) => $value->aggregate),
                'backgroundColor' =>[
                    '#adf542'
                ]
            ],
            [
                'label' => 'Expense',
                'data' =>  $expenseData->map(fn (TrendValue $value) => $value->aggregate),
                'backgroundColor' =>[
                    '#f5bf42'

                ]
            ],
        ],
        'labels' =>  $expenseData->map(fn (TrendValue $value) => $value->date),
    ];

    }
}
