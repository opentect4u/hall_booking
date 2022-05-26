<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdLocation extends Model
{
    use HasFactory;
    protected $table="md_location";
    protected $fillable = [
        'location',
        'created_by',
        'updated_by',
    ];
}
