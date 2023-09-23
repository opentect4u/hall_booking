<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tdconsolidatebills extends Model
{
    use HasFactory;
    protected $table="td_consolidated_bills";
    protected $fillable = [
        'tr_dt',
        'booking_id',
        'memo_no',
        'add_line1',
        'add_line2',
        'add_line3',
        'add_line4',
        'bulk_trans_id',
        'created_by',
        'updated_by',
    ];
}
