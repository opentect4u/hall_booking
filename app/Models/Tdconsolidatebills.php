<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tdconsolidatebills extends Model
{
    use HasFactory;
    protected $table="td_consolidated_bills";
    protected $fillable = [
        'booking_id',
        'memo_no',
        'bulk_trans_id',
        'created_by',
        'updated_by',
    ];
}
