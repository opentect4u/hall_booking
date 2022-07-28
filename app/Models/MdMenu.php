<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdMenu extends Model
{
    use HasFactory;
    protected $table="md_menu";
    protected $fillable = [
        'item_name',
        'price',
        'cgst',
        'sgst',
        'created_by',
        'updated_by',
    ];
}
