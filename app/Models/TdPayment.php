<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdPayment extends Model
{
    use HasFactory;
    protected $table="td_payment";
    protected $fillable = [
        'trans_date',
        'amount','pg_charge',
        'booking_id',
        'transaction_id',
        'email',
        'contact','tracking_id','payment_gateway',
        'bank_ref_no','failure_message','payment_mode','card_name','status_code','status_message',
        'status','payment_at','settlement_date','approve_at','created_by','created_ip'
    ];
}
