<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $fillable = [
       'name',
       'age',
       'phone',
       'emp_code',
    ];

    public function billing(){
        return $this->hasMany(Bills::class);
    }
}
