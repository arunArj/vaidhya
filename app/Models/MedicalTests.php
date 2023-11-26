<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalTests extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'fee'];
    public function labInvoice()
    {
        return $this->belongsToMany(User::class);
    }
    public function opBills()
    {
        return $this->belongsToMany(OPBill::class);
    }
}
