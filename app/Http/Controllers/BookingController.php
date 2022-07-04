<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,
    MdParam,MdState
};
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    public function Search(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $from_date=$request->checkInDate;
        $to_date=$request->checkOutDate;
        $roomsCount=$request->rooms;

        $interval =Carbon::parse($from_date)->diff(Carbon::parse($to_date))->days;
        // return $interval;

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
        // $room_type=MdRoomType::where('id',$room_type_id)->value('type');
        $room_types=MdRoomType::where('id',$room_type_id)->get();
        foreach ($room_types as $key => $value) {
            $room_type=$value->type;
            $max_person_number=$value->max_accomodation_number;
            $max_child_number=$value->max_child_number;
        }

        if(count($lock_rooms) >= count($total_rooms)){
            return "<h2>Room not available</h2>";
            // booking cancel
        }else{
            // return "else";
            // booking success
            
            if(count($lock_room_array) > 0){
                $datas=DB::table('md_room')
                    ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                    ->select('md_room.*','md_room_type.type as room_type')
                    ->where('md_room.room_type_id',$room_type_id)
                    ->where('md_room.location_id',$location_id)
                    ->whereNotIn('md_room.id',$lock_room_array)
                    // ->groupBy('md_room.room_type_id')
                    ->get();
            }else{
                $datas=DB::table('md_room')
                    ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                    ->select('md_room.*','md_room_type.type as room_type')
                    ->where('md_room.room_type_id',$room_type_id)
                    ->where('md_room.location_id',$location_id)
                    // ->whereNotIn('md_room.id',$lock_room_array)
                    // ->groupBy('md_room.room_type_id')
                    ->get();
            }
            // return $datas;
        }
        $room_rent=MdRoomRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->orderBy('effective_date','DESC')
            ->get();
        // return $room_rent;
            // return $request;
        return view('room_details',['room_type'=>$room_type,'datas'=>$datas,
            'max_person_number'=>$max_person_number,'lock_room_array'=>$lock_room_array,
            'room_rent'=>$room_rent,'interval'=>$interval,'max_child_number'=>$max_child_number,
            'searched'=>$request
        ]);
        
    }

    public function Guest(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $from_date=$request->checkInDate;
        $to_date=$request->checkOutDate;
        $roomsCount=$request->rooms;

        $interval =Carbon::parse($from_date)->diff(Carbon::parse($to_date))->days;
        $room_rent=MdRoomRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->orderBy('effective_date','DESC')
            ->get();
        return view('guest_details',['searched'=>$request,'interval'=>$interval,'room_rent'=>$room_rent]);
    }


    public function Payment(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $from_date=$request->checkInDate;
        $to_date=$request->checkOutDate;
        $roomsCount=$request->rooms;

        $interval =Carbon::parse($from_date)->diff(Carbon::parse($to_date))->days;
        $room_rent=MdRoomRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->orderBy('effective_date','DESC')
            ->get();
        $advance_payment_needed=MdParam::where('id',7)->value('value');
        $advance_payment=MdParam::where('id',2)->value('value');
        return view('payment',['searched'=>$request,'interval'=>$interval,'room_rent'=>$room_rent,
        'advance_payment_needed'=>$advance_payment_needed,'advance_payment'=>$advance_payment
        ]);
    }

    public function ConfirmPayment(Request $request)
    {
        // return $request;
        $rooms=$request->rooms;
        $adult_no=0;
        $child_no=0;
        for ($i=1; $i <=$rooms; $i++) { 
            $adult_name="adults_room".$i;
            $child1_room="child1_room".$i;
            $child2_room="child2_room".$i;
            $adult_no +=$request->$adult_name;
            $child_no +=$request->$child1_room;
            $child_no +=$request->$child2_room;
        }

       
        $booking_id='BKI'.date('YmdHis');
        // return $booking_id;
        $interval =Carbon::parse($request->checkInDate)->diff(Carbon::parse($request->checkOutDate))->days;
        // return $interval;
        $is_user=TdUser::where('email',$request->email)->get();
        if(count($is_user)){
            $user_id=$is_user[0]['id'];
        }else{
            $data=TdUser::create(array(
                'name'=>$request->adt_first_name0." ".$request->adt_middle_name0." ".$request->adt_last_name0,
                'email'=>$request->email,
                // 'email_verified_at',
                'password'=>Hash::make('Pass@123'),
                'mobile_no'=>$request->contact,
                'active'=>'A',
            ));

            $user_id=$data->id;
        }

        $lock_rooms=TdRoomLock::where('room_type_id',$request->room_type_id)
            ->whereDate('date','>=',date('Y-m-d',strtotime($request->checkInDate)))
            ->whereDate('date','<=',date('Y-m-d',strtotime($request->checkOutDate)))
            ->groupBy('room_id')
            ->get();
        $lock_room_array=[];
        foreach($lock_rooms as $lock_room){
            array_push($lock_room_array,$lock_room->room_id);
        }

        $ava_rooms=MdRoom::where('location_id',$request->location_id)
            ->where('room_type_id',$request->room_type_id)
            ->whereNotIn('id',$lock_room_array)
            ->get();
        // return $ava_rooms;
        if (count($ava_rooms) > $request->rooms) {
            // return "if";
            TdRoomBook::create(array(
                'booking_id'=> $booking_id,
                'location_id'=> $request->location_id,
                'user_id'=> $user_id,
                'from_date'=> date('Y-m-d',strtotime($request->checkInDate)),
                'to_date'=> date('Y-m-d',strtotime($request->checkOutDate)),
                'no_room'=> $request->rooms,
                'no_adult'=> $adult_no,
                'no_child'=> $child_no,
                'room_type_id'=> $request->room_type_id,
                'booking_time'=> date('Y-m-d H:i:s'),
                'booking_status'=> "Confirm",
                'payment_status'=> "Paid",
                'created_by'=> auth()->user()->id,
            ));

            for ($j=0; $j < $request->rooms; $j++) { 
                // how many dates are book room
                $room_id=$ava_rooms[$j]['id'];
                for ($i=0; $i < $interval; $i++) { 
                    $date=date('Y-m-d', strtotime($request->checkInDate. ' + '.$i.' day'));
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
            
            for ($k=1; $k <= $request->rooms; $k++) { 
                $adult="adults_room".$k;
                $child1_room="child1_room".$k;
                $child2_room="child2_room".$k;

                for($l=1; $l<=$request->$adult ; $l++){
                    $room1_adult1_first_name="room".$k."_adult".$l."_first_name";
                    $room1_adult1_last_name="room".$k."_adult".$l."_last_name";
                    TdRoomBookDetails::create(array(
                        'customer_type_flag'=>'I',
                        'booking_id'=>$booking_id,
                        'first_name'=>$request->$room1_adult1_first_name,
                        // 'middle_name'=>$request->$adt_middle_name,
                        'last_name'=>$request->$room1_adult1_last_name,
                        'address'=>$request->address.",".$request->state.",".$request->post_code,
                        'child_flag'=>'N',
                    ));
                }
                
                $room1_child1_first_name="room".$k."_child1_first_name";
                $room1_child1_last_name="room".$k."_child1_last_name";
                $room1_child2_first_name="room".$k."_child2_first_name";
                $room1_child2_last_name="room".$k."_child2_last_name";
                if($request->$child1_room >0){
                    TdRoomBookDetails::create(array(
                        'customer_type_flag'=>'I',
                        'booking_id'=>$booking_id,
                        'first_name'=>$request->$room1_child1_first_name,
                        // 'middle_name'=>$request->$adt_middle_name,
                        'last_name'=>$request->$room1_child1_last_name,
                        'address'=>$request->address.",".$request->state.",".$request->post_code,
                        'child_flag'=>'Y',
                    ));
                }
                if($request->$child2_room >0){
                    TdRoomBookDetails::create(array(
                        'customer_type_flag'=>'I',
                        'booking_id'=>$booking_id,
                        'first_name'=>$request->$room1_child2_first_name,
                        // 'middle_name'=>$request->$adt_middle_name,
                        'last_name'=>$request->$room1_child2_last_name,
                        'address'=>$request->address.",".$request->state.",".$request->post_code,
                        'child_flag'=>'Y',
                    ));
                }
            }
            $success='S';
            $failed_id='';
        }else{
            // return "else";
            $success='F';
            $booking_id='';
            $failed_id='Fail_'.rand(0000,9999);
        }
        return redirect()->route('paymentSuccess',['booking_id'=>$booking_id,'failed_id'=>$failed_id,'success'=>$success]);
    }

    public function PaymentSuccess(Request $request)
    {
        // return $request;
        return view('confirm_payment',['searched'=>$request]);
    }
}
