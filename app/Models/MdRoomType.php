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
        'created_by',
        'updated_by',
    ];
}
