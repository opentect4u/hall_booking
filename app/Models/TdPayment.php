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
        'amount',
        'booking_id',
        'transaction_id',
        'email',
        'contact','tracking_id','status','payment_at','settlement_date','approve_at','created_by','created_ip'
    ];
}
