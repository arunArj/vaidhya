<?php

namespace App\Filament\Pages;

use App\Models\Category;
use Filament\Pages\Page;

class ProfitLoss extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title = 'Profit & Loss';

    protected static ?string $navigationLabel = 'Profit & Loss';
    protected static string $view = 'filament.pages.profit-loss';
    public $result;
    public $from_date= null;
    public $to_date=null;
    // public function __construct(){
    //     $this->result = $this->getProfitandLoss();

    // }
    public function mount()
    {
        $this->result = $this->getProfitandLoss();
    }
    public function getProfitandLoss(){

        $mainCategories = Category::whereNull('parent')->get();
        $result = $mainCategories->map(function ($category) {
            return $category->getTotalSum($this->from_date,$this->to_date);
        });
        return  $result;
    }
    public function updatedFromDate($value)
    {
        $this->result = $this->getProfitandLoss();
    }

    public function updatedToDate($value)
    {
        $this->result = $this->getProfitandLoss();
    }
}
