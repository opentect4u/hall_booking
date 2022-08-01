<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{TdHallbookDetails,MdRoomRent,TdHallMenu};

class TdHallbook extends Model
{
    use HasFactory;
    protected $table="td_hall_book";
    protected $fillable = [
        'booking_id',
        'location_id',
        'user_id',
        'from_date',
        'to_date',
        'all_dates',
        'no_room',
        'no_adult',
        'no_child',
        'room_type_id',
        'booking_time',
        'laptop_projector',
        'sound_system',
        'catering_service',
        'booking_status',
        'amount',
        'total_cgst_amount',
        'total_sgst_amount',
        'final_amount',
        'discount_amount',
        'total_amount',
        'paid_amount',
        'full_paid',
        'final_bill_flag',
        'payment_status',
        'remark',
        'created_by',
        'updated_by',
    ];

    public function HallMenu()
    {
        // return $this->hasOne(MdCategory::class,'_id','category_id'); 
        return $this->hasMany(TdHallMenu::class,'booking_id','booking_id'); 
    }

    public function HallBookDetails()
    {
        // return $this->hasOne(MdCategory::class,'_id','category_id'); 
        return $this->hasMany(TdHallbookDetails::class,'booking_id','booking_id'); 
    }

}
