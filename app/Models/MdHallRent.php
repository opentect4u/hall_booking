<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdHallRent extends Model
{
    use HasFactory;
    protected $table="md_hall_rent";
    protected $fillable = [
        'effective_date',
        'location_id',
        'room_type_id',
        'room_id',
        'normal_rate',
        'holiday_rate',
        'book_flag',
        'discount_percentage',
        'cgst_rate',
        'sgst_rate',
        'created_by',
        'updated_by',
    ];
}
