<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdRoomType extends Model
{
    use HasFactory;
    protected $table="md_room_type";
    protected $fillable = [
        'type',
        'location_id',
        'max_accomodation_number',
        'max_child_number',
        'code',
        'created_by',
        'updated_by',
    ];
}
