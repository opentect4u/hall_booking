<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser
};
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show(Request $request)
    {
        $locations=MdLocation::get();
        $room_types=MdRoomType::get();
        return view('admin.booking.booking',['locations'=>$locations,'room_types'=>$room_types]);
    }

    public function Search(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        if ($location_id !='' && $room_type_id !='' && $from_date !='' && $to_date !='') {
            if (strtotime($from_date) < strtotime($to_date)) {
                // return $request;
                // return strtotime($from_date);
                $format_from_date=date('Y-m-d',strtotime($from_date));
                $format_to_date=date('Y-m-d',strtotime($to_date));
                $room_type=MdRoomType::where('id',$room_type_id)->value('type');

                $lock_rooms=TdRoomLock::whereDate('date','<=',$format_from_date)
                    ->whereDate('date','<=',$format_to_date)
                    ->where('status','L')->get();
                // return $lock_rooms;
                if (count($lock_rooms) > 0) {
                    // return redirect()->back()->with('room_not_ava','room_not_ava');
                    $datas=[];
                    return view('admin.booking.room_details',['request'=>$request,'room_type'=>$room_type,'datas'=>$datas]);
                }else{
                    // MdRoom::
                    $datas=DB::table('md_room')
                        ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                        ->select('md_room.*','md_room_type.type as room_type')
                        ->where('md_room.room_type_id',$room_type_id)
                        ->where('md_room.location_id',$location_id)
                        ->groupBy('md_room.room_type_id')
                        ->get();
                    // return $datas;
                    return view('admin.booking.room_details',['request'=>$request,'room_type'=>$room_type,'datas'=>$datas]);
                }
            }else{
                return redirect()->back()->with('dateerror','dateerror');
            }
        }else {
            return redirect()->back()->with('error','error');
        }
    }

    public function Book(Request $request)
    {
        // return $request;
        $room_type_id=$request->room_type_id;
        $room_type=MdRoomType::where('id',$room_type_id)->value('type');
        return view('admin.booking.passenger_details',['request'=>$request,'room_type'=>$room_type]);
    }

    public function PassengerDetails(Request $request)
    {
        // return $request;
        $room_type_id=$request->room_type_id;
        $room_type=MdRoomType::where('id',$room_type_id)->value('type');
        return view('admin.booking.payment',['request'=>$request,'room_type'=>$room_type]);
        
    }

    public function PayNow(Request $request)
    {
        // return $request;

        $lock_rooms=TdRoomLock::where('room_type_id',$request->room_type_id)
            ->whereDate('date','>=',date('Y-m-d',strtotime($request->from_date)))
            ->whereDate('date','<=',date('Y-m-d',strtotime($request->to_date)))
            ->groupBy('room_id')
            ->get();
        // return $lock_rooms;
        $total_rooms=MdRoom::where('location_id',$request->location_id)
        ->where('room_type_id',$request->room_type_id)
        ->get();
        // return $total_rooms;

        if(count($lock_rooms) >= count($total_rooms)){
            return "if";
            // booking cancel
        }else{
            // booking success
            $lock_room_array=[];
            foreach($lock_rooms as $lock_room){
                array_push($lock_room_array,$lock_room->room_id);
            }
        
            $booking_id='BKI'.date('YmdHis');
            // return $booking_id;
            $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
            // return $interval;

            $data=TdUser::create(array(
                'name'=>$request->adt_first_name." ".$request->adt_middle_name." ".$request->adt_last_name,
                'email'=>$request->email,
                // 'email_verified_at',
                'password'=>Hash::make('Pass@123'),
                'mobile_no'=>$request->contact,
                'active'=>'A',
            ));

            $user_id=$data->id;

            TdRoomBook::create(array(
                'booking_id'=> $booking_id,
                'location_id'=> $request->location_id,
                'user_id'=> $user_id,
                'from_date'=> date('Y-m-d',strtotime($request->from_date)),
                'to_date'=> date('Y-m-d',strtotime($request->to_date)),
                'no_room'=> $request->no_room,
                'no_adult'=> $request->no_adult,
                'no_child'=> $request->no_child,
                'room_type_id'=> $request->room_type_id,
                'booking_time'=> date('Y-m-d H:i:s'),
                'booking_status'=> "Confirm",
                'payment_status'=> "Paid",
                'created_by'=> auth()->user()->id,
            ));

            $rooms=MdRoom::where('location_id',$request->location_id)
                ->where('room_type_id',$request->room_type_id)
                ->whereNotIn('id',$lock_room_array)
                ->get();
            for ($j=0; $j < $request->no_room; $j++) { 
                // how many dates are book room
                $room_id=$rooms[$j]['id'];
                for ($i=0; $i < $interval; $i++) { 
                    $date=date('Y-m-d', strtotime($request->from_date. ' + '.$i.' day'));
                    // echo $j."-".$date;
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
            return "booking Success";
        }
    }
}