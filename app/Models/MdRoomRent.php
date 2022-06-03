<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdRoomRent extends Model
{
    use HasFactory;
    protected $table="md_room_rent";
    protected $fillable = [
        'effective_date',
        'location_id',
        'room_type_id',
        'normal_rate',
        'book_flag',
        'discount_percentage',
        'cgst_rate',
        'sgst_rate',
        'created_by',
        'updated_by',
    ];
}
