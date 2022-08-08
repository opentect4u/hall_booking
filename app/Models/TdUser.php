<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TdUser extends Authenticatable
{
    use HasFactory;
    protected $table="td_users";
    protected $guard="frontuser";
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
