<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdHallRent,MdParam,
    MdRoomRent,MdState
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
        $book_date=MdParam::where('id',1)->value('value');
        // return $book_date;
        $Date=date('Y-m-d');
        $advance_book_date=date('Y-m-d', strtotime($Date. ' + '.$book_date.' months'));

        $checking_time=MdParam::where('id',4)->value('value');
        $checkout_time=MdParam::where('id',5)->value('value');

        $states=MdState::get();
        return view('admin.booking.hall_booking',['locations'=>$locations,'room_types'=>$room_types,'advance_book_date'=>$advance_book_date,
            'checking_time'=>$checking_time,'checkout_time'=>$checkout_time,'states'=>$states
        ]);
    }

    public function Search(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $from_date=$request->from_date;
        $to_date=$request->to_date;

        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;

        $lock_rooms=TdRoomLock::where('room_type_id',$request->room_type_id)
            ->whereDate('date','>=',date('Y-m-d',strtotime($request->from_date)))
            ->whereDate('date','<=',date('Y-m-d',strtotime($request->to_date)))
            ->groupBy('room_id')
            ->get();
        // return $lock_rooms;
        $lock_room_array=[];
        foreach($lock_rooms as $lock_room){
            array_push($lock_room_array,$lock_room->room_id);
        }

        $total_rooms=MdRoom::where('room_type_id',$request->room_type_id)
        ->get();
        // return $total_rooms;
        $room_types=MdRoomType::where('id',$room_type_id)->get();
        // return $room_types;

        foreach($room_types as $key => $value) {
            $room_type=$value->type;
            $max_person_number=$value->max_accomodation_number;
            $max_child_number=$value->max_child_number;
        }

        if(count($lock_rooms) >= count($total_rooms)){
            return "<h2>Hall not available</h2>";
            // booking cancel
        }else{
            // return "else";
            // booking success
            
            // if(count($lock_room_array) > 0){
            //     $datas=DB::table('md_room')
            //         ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
            //         ->select('md_room.*','md_room_type.type as room_type')
            //         ->where('md_room.room_type_id',$room_type_id)
            //         ->where('md_room.location_id',$location_id)
                    
            //         // ->where('md_room.location_id',$location_id)
            //         ->whereNotIn('md_room.id',$lock_room_array)
            //         // ->groupBy('md_room.room_type_id')
            //         ->get();
            // }else{
                $datas=DB::table('md_room')
                    ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                    ->select('md_room.*','md_room_type.type as room_type')
                    ->where('md_room.room_type_id',$room_type_id)
                    ->where('md_room.location_id',$location_id)
                    // ->whereNotIn('md_room.id',$lock_room_array)
                    // ->groupBy('md_room.room_type_id')
                    ->get();
            // }
            // return $datas;
        }
        // $room_rent=MdHallRent::where('location_id',$location_id)
        //     ->where('room_type_id',$room_type_id)
        //     ->orderBy('effective_date','DESC')
        //     ->get();
        return view('admin.booking.hall_details',['room_type'=>$room_type,'datas'=>$datas,
            'max_person_number'=>$max_person_number,'lock_room_array'=>$lock_room_array,
            // 'room_rent'=>$room_rent,
            'interval'=>$interval,'max_child_number'=>$max_child_number
        ]);

    }

    public function PriceDetails(Request $request)
    {
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $all_rooms_array=$request->all_rooms_array;
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        $catering_service=$request->catering_service;
        $laptop_prajector=$request->laptop_prajector;
        $sound_system=$request->sound_system;
        // return count($all_rooms_array);
        $room_rent=[];
        for ($i=0; $i < count($all_rooms_array); $i++) { 
            $room=MdHallRent::where('room_id',$all_rooms_array[$i])
                ->where('room_type_id',$room_type_id)
                ->where('location_id',$location_id)
                ->orderBy('effective_date','DESC')
                ->get();
            array_push($room_rent,$room[0]);
        }
        $advance_payment=MdParam::where('id',2)->value('value');
        // $room_rent=MdHallRent::where('location_id',$location_id)
        //     ->where('room_type_id',$room_type_id)
        //     ->orderBy('effective_date','DESC')
        //     ->get();
        // return $room_rent;
        // $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
        $interval =Carbon::parse($request->from_date)->diffInHours(Carbon::parse($request->to_date));
        // $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->format('%dD %Hh');
        // return $catering_service;
        return view('admin.booking.hall_price_details',['room_rent'=>$room_rent,'totalnoroom'=>$all_rooms_array,
            'from_date'=>$from_date,'to_date'=>$to_date,'interval'=>$interval,'advance_payment'=>$advance_payment,
            'laptop_prajector'=>$laptop_prajector,'catering_service'=>$catering_service,'sound_system'=>$sound_system
        ]);
    }

    public function PreviewDetails(Request $request)
    {
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $rooms_no=$request->rooms_no;
        $locations=MdLocation::where('id',$location_id)->value('location');
        $room_types=MdRoomType::where('id',$room_type_id)->value('type');
        $total_rooms=MdRoom::whereIn('id',$rooms_no)->get();

        $rooms='';
        $i=1;
        foreach ($total_rooms as $key => $value) {
            # code...
            $room_no=$value->room_no;
            if ($i == count($total_rooms)) {
                $commma="";
            }else{
                $commma=", ";

            }
            $rooms .=$room_no.$commma;
            $i++;
        }
        $a=[];
        $a['location']=$locations;
        $a['room_type']=$room_types;
        $a['rooms']=$rooms;
        echo json_encode($a);
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
            'location_id'=> $request->location_id,
            'user_id'=> $user_id,
            'from_date'=> date('Y-m-d',strtotime($request->from_date)),
            'to_date'=> date('Y-m-d',strtotime($request->to_date)),
            'no_room'=> $request->total_room_no,
            'no_adult'=> 1,
            'no_child'=> 0,
            'room_type_id'=> $request->room_type_id,
            'booking_time'=> date('Y-m-d H:i:s'),
            'laptop_prajector'=>$request->laptop_prajector,
            'sound_system'=>$request->sound_system,
            'catering_service'=>$request->catering_service,
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
                'address'=>$request->address.",".$request->state.",".$request->post_code,
                'child_flag'=>'N',
            ));
        
        
        // return "booking Success";
        return redirect()->route('admin.hallBooking')->with('bookingSuccess','bookingSuccess');
    }
}
