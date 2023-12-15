<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advances extends Model
{
    use HasFactory;
    protected $fillable = ['patients_id'];
    public function patient(){
        return $this->belongsTo(Patients::class,'patients_id');
    }
    public function cashbook()
    {
        return $this->morphOne(IncomeExpense::class, 'cashbookable');
    }
}
