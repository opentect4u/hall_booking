<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdRoomPayment extends Model
{
    use HasFactory;
    protected $table="td_room_payment";
    protected $fillable = [
        'booking_id',
        'amount',
        'payment_date',
        'payment_made_by',
        'created_by',
        'updated_by',
    ];
}
