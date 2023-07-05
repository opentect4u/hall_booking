<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{TdHallbook,MdRoomRent,TdHallMenu};

class TdHallPayment extends Model
{
    use HasFactory;
    protected $table="td_hall_payment";
    protected $fillable = [
        'booking_id',
        'amount',
        'payment_date',
        'payment_made_by',
        'cheque_no',
        'cheque_dt',
        'payment_id',
        'cancel_status',
        'cancel_charge',
        'refund_amt',
        'refund_dt',               
        'refund_cheque_no',
        'refund_cheque_dt',
        'refund_mode',
        'refund_payment_id',
        'created_by',
        'updated_by',
    ];

    public function HallBookingDetails()
    {
        return $this->hasOne(TdHallbook::class,'booking_id','booking_id'); 
        // return $this->hasMany(TdHallbook::class,'booking_id','booking_id'); 
    }
}
