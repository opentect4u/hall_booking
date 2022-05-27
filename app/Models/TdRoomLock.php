<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdRoomLock extends Model
{
    use HasFactory;
    protected $table="td_room_lock";
    protected $fillable = [
        'date',
        'booking_id',
        'room_id',
        'room_type_id',
        'status',
        'created_by',
        'updated_by',
    ];
}
