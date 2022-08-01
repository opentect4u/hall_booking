<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdHallMenu extends Model
{
    use HasFactory;
    protected $table="td_hall_menu";
    protected $fillable = [
        'booking_id',
        'menu_id',
        'no_of_head',
        'rate',
        'amount',
        'created_by',
        'updated_by',
    ];
}
