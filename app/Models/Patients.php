<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dob',
        'sex',
        'user_type',
        'phone',
        'mrd_no',
        'address',
        'advance',
        'refund'
    ];

    // public function billing()
    // {
    //     return $this->hasMany(Bills::class);
    // }
    public function bookAppointment(){

        return $this->hasMany(BookAppointments::class);
    }
    public function advances(){

        return $this->hasMany(Advances::class);
    }
    public function opbill(){

        return $this->hasMany(OPBill::class);
    }
    public function getAgeAttribute()
    {
        if ($this->dob) {
            return Carbon::parse($this->dob)->age;
        }

        return null; // Or handle the case where date_of_birth is not set
    }
}
