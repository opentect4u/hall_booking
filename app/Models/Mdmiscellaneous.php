<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mdmiscellaneous extends Model
{
    use HasFactory;
    protected $table="td_miscellaneous_item";
    protected $fillable = [
        'booking_id',
        'item_name',
        'num_of_days',
        'rate',
        'amount',
        'created_by',
        'updated_by',
    ];
}
