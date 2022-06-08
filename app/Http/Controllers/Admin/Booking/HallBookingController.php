<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdHallRent,MdParam
};
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class HallBookingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show(Request $request)
    {
        $locations=MdLocation::get();
        $room_types=MdRoomType::where('code','H')->get();

        $checking_time=MdParam::where('id',4)->value('value');
        $checkout_time=MdParam::where('id',5)->value('value');

        return view('admin.booking.hall_booking',['locations'=>$locations,'room_types'=>$room_types,
            'checking_time'=>$checking_time,'checkout_time'=>$checkout_time
        ]);
    }

    public function Search(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $from_date=$request->from_date;
        $to_date=$request->to_date;


        $lock_rooms=TdRoomLock::where('room_type_id',$request->room_type_id)
            ->whereDate('date','>=',date('Y-m-d',strtotime($request->from_date)))
            ->whereDate('date','<=',date('Y-m-d',strtotime($request->to_date)))
            ->groupBy('room_id')
            ->get();
        // return $lock_rooms;
        $total_rooms=MdRoom::where('room_type_id',$request->room_type_id)
        ->get();
        // return $total_rooms;
        $room_type=MdRoomType::where('id',$room_type_id)->value('type');

        if(count($lock_rooms) >= count($total_rooms)){
            return "<h2>Hall not available</h2>";
            // booking cancel
        }else{
            // return "else";
            // booking success
            $lock_room_array=[];
            foreach($lock_rooms as $lock_room){
                array_push($lock_room_array,$lock_room->room_id);
            }
            if(count($lock_room_array) > 0){
                $datas=DB::table('md_room')
                    ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                    ->select('md_room.*','md_room_type.type as room_type')
                    ->where('md_room.room_type_id',$room_type_id)
                    // ->where('md_room.location_id',$location_id)
                    ->whereNotIn('md_room.id',$lock_room_array)
                    // ->groupBy('md_room.room_type_id')
                    ->get();
            }else{
                $datas=DB::table('md_room')
                    ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                    ->select('md_room.*','md_room_type.type as room_type')
                    ->where('md_room.room_type_id',$room_type_id)
                    // ->where('md_room.location_id',$location_id)
                    // ->whereNotIn('md_room.id',$lock_room_array)
                    // ->groupBy('md_room.room_type_id')
                    ->get();
            }
            // return $datas;
        }
        return view('admin.booking.hall_details',['room_type'=>$room_type,'datas'=>$datas]);

    }

    public function PriceDetails(Request $request)
    {
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $totalnoroom=$request->totalnoroom;
        // return $totalnoroom;
        $room_rent=MdHallRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->orderBy('effective_date','DESC')
            ->get();
        // return $room_rent;
        return view('admin.booking.hall_price_details',['room_rent'=>$room_rent,'totalnoroom'=>$totalnoroom]);
    }

    public function BookingConfirm(Request $request)
    {
        // return $request;
        
        $booking_id='BKI'.date('YmdHis');
        // return $booking_id;
        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
        // return $interval;
        $getdata=TdUser::where('email',$request->email)->get();
        if (count($getdata) > 0) {
            $user_id=$getdata[0]['id'];
        }else {
            $data=TdUser::create(array(
                'name'=>$request->adt_first_name." ".$request->adt_middle_name." ".$request->adt_last_name,
                'email'=>$request->email,
                // 'email_verified_at',
                'password'=>Hash::make('Pass@123'),
                'mobile_no'=>$request->contact,
                'active'=>'A',
            ));

            $user_id=$data->id;
        }

        TdRoomBook::create(array(
            'booking_id'=> $booking_id,
            // 'location_id'=> $request->location_id,
            'user_id'=> $user_id,
            'from_date'=> date('Y-m-d',strtotime($request->from_date)),
            'to_date'=> date('Y-m-d',strtotime($request->to_date)),
            'no_room'=> $request->total_room_no,
            'no_adult'=> 1,
            'no_child'=> 0,
            'room_type_id'=> $request->room_type_id,
            'booking_time'=> date('Y-m-d H:i:s'),
            'booking_status'=> "Confirm",
            'payment_status'=> "Paid",
            'created_by'=> auth()->user()->id,
        ));

       
        for ($j=0; $j < count($request->room_no); $j++) { 
            // how many dates are book room
            $room_id=$request->room_no[$j];
            for ($i=0; $i < $interval; $i++) { 
                $date=date('Y-m-d', strtotime($request->from_date. ' + '.$i.' day'));
                // echo "  --  ";
                TdRoomLock::create(array(
                    'date'=>$date,
                    'booking_id'=>$booking_id,
                    'room_id'=>$room_id,
                    'room_type_id'=>$request->room_type_id,
                    'status'=>'L',
                ));
            }
        }

       
            TdRoomBookDetails::create(array(
                'customer_type_flag'=>'I',
                'booking_id'=>$booking_id,
                'first_name'=>$request->adt_first_name,
                'middle_name'=>$request->adt_middle_name,
                'last_name'=>$request->adt_last_name,
                'address'=>$request->address.",".$request->city.",".$request->post_code.",".$request->country,
                'child_flag'=>'N',
            ));
        
        
        // return "booking Success";
        return redirect()->route('admin.hallBooking')->with('bookingSuccess','bookingSuccess');
    }
}
