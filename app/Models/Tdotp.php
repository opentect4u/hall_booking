<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tdotp extends Model
{
    use HasFactory;
    protected $table="td_otp";
    protected $fillable = [
        'mobileno_email',
        'otp',
        'status',
        'created_at',
        'updated_at'
    ];
}
