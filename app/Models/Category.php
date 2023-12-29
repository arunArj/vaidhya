<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'parent',
        'type'
    ];
    public function incomeExpense(){
        return $this->hasMany(IncomeExpense::class);
    }
    public function category(){
        return $this->belongsTo(Category::class,'parent');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent');
    }
    // public function getTotalSum($startDate = null, $endDate = null)
    // {
    //     $employeeQuery = $this->incomeExpense();

    //     if ($startDate && $endDate) {
    //         $employeeQuery->whereBetween('created_at', [$startDate, $endDate]);
    //     }

    //     $totalSalary = $employeeQuery->sum('amount');
    //     $subCategories = [];

    //     foreach ($this->children as $child) {
    //         $subCategories[] = [
    //             'id' => $child->id,
    //             'title' => $child->title,
    //             'subCategorySum' => $child->getTotalSum($startDate, $endDate),
    //         ];
    //         $totalSalary += $child->getTotalSum($startDate, $endDate);
    //     }

    //     return [
    //         'id' => $this->id,
    //         'title' => $this->title,
    //         'mainCategorySum' => $totalSalary,
    //         'subCategory' => $subCategories,
    //     ];
    // }
    // public function getTotalSum($startDate = null, $endDate = null)
    // {
    //     $employeeQuery = $this->incomeExpense();

    //     if ($startDate && $endDate) {
    //         $employeeQuery->whereBetween('created_at', [$startDate, $endDate]);
    //     }

    //     $totalSalary = $employeeQuery->sum('amount');
    //     $subCategories = [];

    //     foreach ($this->children as $child) {
    //         $subCategoryTotalSalary = $child->getTotalSum($startDate, $endDate);
    //         $subCategories[] = [
    //             'id' => $child->id,
    //             'title' => $child->title,
    //             'subCategorySum' => $subCategoryTotalSalary['mainCategorySum'],
    //         ];
    //         $totalSalary += $subCategoryTotalSalary['mainCategorySum'];
    //     }

    //     return [
    //         'id' => $this->id,
    //         'title' => $this->title,
    //         'mainCategorySum' => $totalSalary,
    //         'subCategory' => $subCategories,
    //     ];
    // }
    public function getTotalSum($startDate = null, $endDate = null)
    {
        $employeeQuery = $this->incomeExpense();

        if ($startDate && $endDate) {
            $employeeQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $totalSalary = $employeeQuery->sum('amount');
        $subCategories = [];

        foreach ($this->children as $child) {
            $subCategoryTotalSalary = $child->getTotalSum($startDate, $endDate);
            $subCategories[] = [
                'id' => $child->id,
                'title' => $child->title,
                'subCategorySum' => $subCategoryTotalSalary['mainCategorySum'],
                'subCategory' => $subCategoryTotalSalary['subCategory'],
            ];
            $totalSalary += $subCategoryTotalSalary['mainCategorySum'];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'mainCategorySum' => $totalSalary,
            'subCategory' => $subCategories,
        ];
    }
}
