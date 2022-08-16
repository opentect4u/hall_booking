<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdMenuCategory extends Model
{
    use HasFactory;
    protected $table="md_menu_category";
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
