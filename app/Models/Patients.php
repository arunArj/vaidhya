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
    public function getTotalIPBillAmount()
    {
        return $this->opbill()
            ->with('cashbook')
            ->get()
            ->pluck('cashbook.amount')
            ->sum();
    }
    public function getGenderAttribute()
    {
        if ($this->sex==null) {
            return null;
        }
        switch($this->sex){
            case '0' :
                return 'Male';
                break;
            case '1' :
                return 'Female';
                break;
            case '2' :
                return 'Other';
                break;

        }
        return null; // Or handle the case where date_of_birth is not set
    }
    public function getRecidencyAttribute()
    {
        if ($this->user_type==null) {
            return null;
        }
        switch($this->sex){
            case '0' :
                return 'Local';
                break;
            case '1' :
                return 'Indian';
                break;
            case '2' :
                return 'International';
                break;

        }
        return null; // Or handle the case where date_of_birth is not set
    }
}
