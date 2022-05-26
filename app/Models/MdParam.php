<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdParam extends Model
{
    use HasFactory;
    protected $table="md_params";
    protected $fillable = [
        'description',
        'value',
        'created_by',
        'updated_by',
    ];
}
