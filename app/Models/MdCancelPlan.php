<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdCancelPlan extends Model
{
    use HasFactory;
    protected $table="md_cancel_plan";
    protected $fillable = [
        'from_day',
        'to_day',
        'percentage',
        'created_by',
        'updated_by',
    ];
}
