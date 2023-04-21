<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdRoomPayment extends Model
{
    use HasFactory;
    protected $table="td_room_payment";
    protected $fillable = [
        'booking_id',
        'amount',
        'payment_date',
        'payment_made_by',
        'cheque_no',
        'cheque_dt','pay_receive_dt','payment_id','cancel_status','refund_amt','refund_dt','refund_cheque_no',
        'refund_cheque_dt','refund_mode','refund_payment_id',
        'created_by',
        'updated_by',
    ];
}
