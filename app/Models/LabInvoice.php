<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'patients_id',
        'invoice_id',

    ];
    public function patient(){
        return $this->belongsTo(Patients::class,'patients_id');
    }
    public function tests()
    {
        return $this->belongsToMany(MedicalTests::class);
    }

}
