<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdRoomCharge extends Model
{
    use HasFactory;
    protected $table="md_room_charge";
    protected $fillable = [
        'room_type_id',
        'effective_date',
        'hour_flag',
        'per_bed_flag',
        'amount',
        'discount_percentage',
        'holiday_amount',
        'cgst_rate',
        'sgst_rate',
        'created_by',
        'updated_by',
    ];
}
