<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdCautionMoney extends Model
{
    use HasFactory;
    protected $table="md_caution_money";
    protected $fillable = [
        'effective_date',
        'room_type_id',
        'percentage',
        'created_by',
        'updated_by',
    ];
}
