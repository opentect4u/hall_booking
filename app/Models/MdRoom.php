<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdRoom extends Model
{
    use HasFactory;
    protected $table="md_room";
    protected $fillable = [
        'location_id',
        'room_no',
        'room_type_id',
        'room_name',
        'no_person',
        'floor',
        'created_by',
        'updated_by',
    ];
}
