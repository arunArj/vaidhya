<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAppointments extends Model
{
    use HasFactory;
    protected $fillable = ['patients_id','fee','visit_date','opbill_no'];
    public function patients(){
        return $this->belongsTo(Patients::class,'patients_id');
    }
    // public function doctor(){
    //     return $this->belongsTo(Doctors::class,'doctors_id');
    // }
}
