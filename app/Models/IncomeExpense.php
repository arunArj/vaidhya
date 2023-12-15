<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'purpose',
        'amount',
        'payment_note',
        'refund',
        'refund_note',
        'cashbookable_id',
        'cashbookable_type',
        'category_id',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function cashbookable()
    {
        return $this->morphTo();
    }
}
