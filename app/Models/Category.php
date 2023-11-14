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
    ];
    public function incomeExpense(){
        return $this->hasMany(IncomeExpense::class);
    }
    public function category(){
        return $this->belongsTo(Category::class,'parent');
    }
}
