<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OPBill extends Model
{
    use HasFactory;
    protected $fillable = ['patients_id', 'ip_number', 'gst_no', 'room_no', 'bill_no', 'do_admission', 'do_discharge'];
    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patients_id');
    }
    public function tests()
    {
        return $this->belongsToMany(MedicalTests::class);
    }
}
