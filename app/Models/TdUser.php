<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdUser extends Model
{
    use HasFactory;
    protected $table="td_users";
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'mobile_no',
        'active',
        // 'created_by',
        // 'updated_by',
    ];
}
