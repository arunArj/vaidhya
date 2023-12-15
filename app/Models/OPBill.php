<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OPBill extends Model
{
    use HasFactory;
    protected $fillable = ['patients_id', 'ip_number',
    'room_no', 'bill_no', 'do_admission', 'do_discharge','fees','total'
    ];
    public function patients()
    {
        return $this->belongsTo(Patients::class, 'patients_id');
    }
    public function tests()
    {
        return $this->belongsToMany(MedicalTests::class);
    }
    protected $casts = [
        'fees' => 'array', // optional: specify if your JSON data has specific structure
    ];
    public function cashbook()
    {
        return $this->morphOne(IncomeExpense::class, 'cashbookable');
    }
}
