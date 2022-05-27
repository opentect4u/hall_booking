<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdRoomBookDetails extends Model
{
    use HasFactory;
    protected $table="td_room_book_details";
    protected $fillable = [
        'customer_type_flag',
        'booking_id',
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'child_flag',
        'age',
        'organisation_name',
        'organisation_gst_no',
        'created_by',
        'updated_by',
    ];
}
