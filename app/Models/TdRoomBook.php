<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdRoomBook extends Model
{
    use HasFactory;
    protected $table="td_room_book";
    protected $fillable = [
        'booking_id',
        'location_id',
        'user_id',
        'from_date',
        'to_date',
        'no_room',
        'no_adult',
        'no_child',
        'room_type_id',
        'booking_time',
        'laptop_projector',
        'sound_system',
        'catering_service',
        'booking_status',
        'payment_status',
        'created_by',
        'updated_by',
    ];
}
