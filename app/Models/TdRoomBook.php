<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TdRoomMenu;
use App\Models\{TdRoomBookDetails,MdRoomRent};

class TdRoomBook extends Model
{
    use HasFactory;
    protected $table="td_room_book";
    protected $fillable = [
        'booking_id',
        'location_id',
        'user_id',
        'from_date',
        'to_date',
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

    public function RoomMenu()
    {
        // return $this->hasOne(MdCategory::class,'_id','category_id'); 
        return $this->hasMany(TdRoomMenu::class,'booking_id','booking_id'); 
    }

    public function RoomBookDetails()
    {
        // return $this->hasOne(MdCategory::class,'_id','category_id'); 
        return $this->hasMany(TdRoomBookDetails::class,'booking_id','booking_id'); 
    }

    public function RoomRentDetails1()
    {
        // return $this->hasOne(MdCategory::class,'_id','category_id'); 
        // return $this->hasMany(MdRoomRent::class,['location_id','room_type_id'],['location_id','room_type_id']); 
        return $this->hasMany(MdRoomRent::class,'location_id','location_id'); 
    }
    public function RoomRentDetails2()
    {
        // return $this->hasOne(MdCategory::class,'_id','category_id'); 
        return $this->hasMany(MdRoomRent::class,'room_type_id','room_type_id'); 
    }

    public function RoomRentDetails()
    {
        // return $query->with(['RoomRentDetails1', 'RoomRentDetails2']);
        // return collect([$this->RoomRentDetails1, $this->RoomRentDetails2]);
        // return $this->belongsTo(MdRoomRent::class,'location_id','room_type_id');
        return $this->hasMany(MdRoomRent::class,'room_type_id','room_type_id','location_id','location_id');
        // return $this->belongsToMany(MdRoomRent::class,,'room_type_id','room_type_id');
        // return $this->hasMany(MdRoomRent::class,'room_type_id,location_id','room_type_id,location_id');
        // return $this->belongsTo(MdRoomRent::class,'room_type_id,location_id','room_type_id,location_id');
        // ->where('location_id', 'location_id'); 
        // return $this->belongsToMany('App\Models\MdRoomRent')->withPivot('location_id', 'room_type_id');
        // return $this->hasOne(MdCategory::class,'_id','category_id'); 
        // return $this->hasMany(MdRoomRent::class,['location_id','room_type_id'],['location_id','room_type_id']); 
        // return $this->belongsTo(MdRoomRent::class,['location_id','room_type_id'],['location_id','room_type_id']); 
        // return $this->belongsToMany(MdRoomRent::class,['location_id','room_type_id'],['location_id','room_type_id']); 
        // return $this->belongsToMany('MdRoomRent')->withPivot('location_id', 'room_type_id');
    }
}
