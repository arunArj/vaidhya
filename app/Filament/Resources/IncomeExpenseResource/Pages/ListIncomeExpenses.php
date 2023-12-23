<?php

namespace App\Filament\Resources\IncomeExpenseResource\Pages;

use App\Filament\Resources\IncomeExpenseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncomeExpenses extends ListRecords
{
    protected static string $resource = IncomeExpenseResource::class;
    protected static string $view = 'filament.cashbook.list_cashbook';
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Recoord'),
        ];
    }
    protected function getTitle(): string
    {
        return __('Cashbook');
    }

}
