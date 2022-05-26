<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdRule extends Model
{
    use HasFactory;
    protected $table="md_rules";
    protected $fillable = [
        'room_type_id',
        'rules',
        'created_by',
        'updated_by',
    ];
}
