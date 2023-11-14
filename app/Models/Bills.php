<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $fillable = [
        'patients_id',
        'doctors_id',
        'bill_no',
        'fee',
    ];
    public function patients(){
        return $this->belongsTo(Patients::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctors::class);
    }

}
