<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAppointments extends Model
{
    use HasFactory;
    protected $fillable = ['patients_id','doctors_id','fee','invoice_no'];
    public function patients(){
        return $this->belongsTo(Patients::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctors::class,'doctors_id');
    }
}
