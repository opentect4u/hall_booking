<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdHallbook,TdHallLock,TdHallbookDetails,TdUser,MdHallRent,MdParam,
    MdRoomRent,MdState
};
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class HallBookingController extends Controller
{
    public function Search(Request $request)
    {
        // return $request;
        $hall_location_id=$request->hall_location_id;
        $hall_room_type_id=$request->hall_room_type_id;
        $hallbookingdate=$request->hallbookingdate;
        $hall_no_id=$request->hall_no;
        $days=$request->days;
        // $to_date=$request->to_date;
        // return $hallbookingdate;
        $format_hallbookingdate=[];
        for ($i=0; $i < count($hallbookingdate); $i++) { 
           $date=date('Y-m-d',strtotime($hallbookingdate[$i]));
           array_push($format_hallbookingdate,$date);
        }
        // return $format_hallbookingdate;

        // $interval =count($hallbookingdate);

        $lock_rooms=TdHallLock::where('room_type_id',$request->hall_room_type_id)
            ->where('room_id',$hall_no_id)
            ->whereIn('date',$format_hallbookingdate)
            // ->whereDate('date','>=',date('Y-m-d',strtotime($request->from_date)))
            // ->whereDate('date','<=',date('Y-m-d',strtotime($request->to_date)))
            ->groupBy('room_id')
            ->get();
        // return $lock_rooms;

        $lock_room_array=[];
        foreach($lock_rooms as $lock_room){
            array_push($lock_room_array,$lock_room->room_id);
        }

        $total_rooms=MdRoom::where('room_type_id',$request->hall_room_type_id)
            ->where('id',$hall_no_id)
            ->get();
        // return $total_rooms;
        $room_types=MdRoomType::where('id',$hall_room_type_id)->get();
        // return $room_types;

        foreach($room_types as $key => $value) {
            $room_type=$value->type;
            $max_person_number=$value->max_accomodation_number;
            $max_child_number=$value->max_child_number;
        }

        // if(count($lock_rooms) >= count($total_rooms)){
        //     return "<h2>Hall not available</h2>";
        //     // booking cancel
        // }else{
            // return "else";
            // booking success
            
            if(count($lock_room_array) > 0){
                $datas=DB::table('md_room')
                    ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                    ->select('md_room.*','md_room_type.type as room_type')
                    ->where('md_room.room_type_id',$hall_room_type_id)
                    ->where('md_room.location_id',$hall_location_id)
                    ->where('md_room.id',$hall_no_id)
                    
                    // ->where('md_room.location_id',$location_id)
                    ->whereNotIn('md_room.id',$lock_room_array)
                    // ->groupBy('md_room.room_type_id')
                    ->get();
            }else{
                $datas=DB::table('md_room')
                    ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                    ->select('md_room.*','md_room_type.type as room_type')
                    ->where('md_room.room_type_id',$hall_room_type_id)
                    ->where('md_room.location_id',$hall_location_id)
                    ->where('md_room.id',$hall_no_id)
                    // ->whereNotIn('md_room.id',$lock_room_array)
                    // ->groupBy('md_room.room_type_id')
                    ->get();
            }
            // return $datas;
        // }
        $room_rent=MdHallRent::where('location_id',$hall_location_id)
            ->where('room_type_id',$hall_room_type_id)
            ->where('room_id',$hall_no_id)
            ->orderBy('effective_date','DESC')
            ->get();
        // return $room_rent;
        return view('hall_details',['room_type'=>$room_type,'datas'=>$datas,
            'max_person_number'=>$max_person_number,'lock_room_array'=>$lock_room_array,
            'room_rent'=>$room_rent,'interval'=>$days,'max_child_number'=>$max_child_number,
            'searched'=>$request
        ]);
    }

    public function HallNoDetailsAjax(Request $request)
    {
        $hall_location_id=$request->hall_location_id;
        $hall_room_type_id=$request->hall_room_type_id;
        $total_rooms=MdRoom::where('room_type_id',$hall_room_type_id)
            ->where('location_id',$hall_location_id)
            ->get();
        // return $total_rooms;
        return view('hall_nos_ajax',['total_rooms'=>$total_rooms]);
    }

    public function Guest(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $days=$request->days;
        $hall_no_id=$request->hall_no_id;

        $room_rent=MdHallRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->where('room_id',$hall_no_id)
            ->orderBy('effective_date','DESC')
            ->get();
        // return $room_rent;
        return view('hall_guest_details',['searched'=>$request,'interval'=>$days,'room_rent'=>$room_rent]);
    }

    public function Payment(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $hall_no_id=$request->hall_no_id;
        // $to_date=$request->checkOutDate;
        $days=$request->days;

        $room_rent=MdHallRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->where('room_id',$hall_no_id)
            ->orderBy('effective_date','DESC')
            ->get();
        $advance_payment_needed=MdParam::where('id',7)->value('value');
        $advance_payment=MdParam::where('id',2)->value('value');
        return view('hall_payment',['searched'=>$request,'interval'=>$days,'room_rent'=>$room_rent,
        'advance_payment_needed'=>$advance_payment_needed,'advance_payment'=>$advance_payment
        ]);
    }

    public function ConfirmPayment(Request $request)
    {
        // return $request;
        $hall_no_id=$request->hall_no_id;
        $hallbookingdate=json_decode($request->hallbookingdate);
        // return $hallbookingdate;
        $format_hallbookingdate=[];
        for ($i=0; $i < count($hallbookingdate); $i++) { 
           $date=date('Y-m-d',strtotime($hallbookingdate[$i]));
           array_push($format_hallbookingdate,$date);
        }

        $booking_id='BKI'.date('YmdHis');
        // return $booking_id;
        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
        // return $interval;
        $getdata=TdUser::where('email',$request->email)->get();
        if (count($getdata) > 0) {
            $user_id=$getdata[0]['id'];
        }else {
            $data=TdUser::create(array(
                'name'=>$request->room_adult_first_name." ".$request->room_adult_last_name,
                'email'=>$request->email,
                // 'email_verified_at',
                'password'=>Hash::make('Pass@123'),
                'mobile_no'=>$request->contact_no,
                'active'=>'A',
            ));

            $user_id=$data->id;
        }

        $lock_rooms=TdHallLock::where('room_type_id',$request->room_type_id)
            ->where('room_id',$hall_no_id)
            ->whereIn('date',$format_hallbookingdate)
            // ->groupBy('room_id')
            ->get();
        // return $lock_rooms;

        $lock_room_array=[];
        foreach($lock_rooms as $lock_room){
            array_push($lock_room_array,$lock_room->room_id);
        }

        // $ava_rooms=MdRoom::where('room_type_id',$request->room_type_id)
        //     ->where('id',$hall_no_id)
        //     ->get();

        // return $ava_rooms;
        if (count($lock_rooms) ==0) {
            // return "if";
            TdHallbook::create(array(
                'booking_id'=> $booking_id,
                'location_id'=> $request->location_id,
                'user_id'=> $user_id,
                // 'from_date'=> date('Y-m-d',strtotime($request->from_date)),
                // 'to_date'=> date('Y-m-d',strtotime($request->to_date)),
                'all_dates'=>json_encode($hallbookingdate),
                'no_room'=> 1,
                // 'no_adult'=> 1,
                // 'no_child'=> 0,
                'room_type_id'=> $request->room_type_id,
                'booking_time'=> date('Y-m-d H:i:s'),
                'laptop_projector'=>$request->laptop_prajector,
                'sound_system'=>$request->sound_system,
                'catering_service'=>$request->catering_service,
                'booking_status'=> "Confirm",
                'amount'=>$request->amount,
                'total_cgst_amount'=>$request->total_cgst_amount,
                'total_sgst_amount'=>$request->total_sgst_amount,
                'total_amount'=>$request->total_amount,
                'final_amount'=>$request->total_amount,
                // 'payment_status'=> "Paid",
                // 'created_by'=> auth()->user()->id,
            ));

        
            // how many dates are book room
            $room_id=$request->hall_no_id;
            for ($i=0; $i < $request->days; $i++) { 
                $date=date('Y-m-d', strtotime($hallbookingdate[$i]));
                // $date=date('Y-m-d', strtotime($request->from_date. ' + '.$i.' day'));
                // echo "  --  ";
                TdHallLock::create(array(
                    'date'=>$date,
                    'booking_id'=>$booking_id,
                    'room_id'=>$room_id,
                    'room_type_id'=>$request->room_type_id,
                    'status'=>'L',
                ));
            }
            
       
            TdHallbookDetails::create(array(
                'customer_type_flag'=>'O',
                'booking_id'=>$booking_id,
                'first_name'=>$request->room_adult_first_name,
                // 'middle_name'=>$request->room_adult_last_name,
                'last_name'=>$request->room_adult_last_name,
                'address'=>$request->address.",".$request->state.",".$request->post_code,
                'child_flag'=>'N',
                'organisation_gst_no'=>$request->GSTIN,
                'pan'=>$request->PAN,
                'tan'=>$request->TAN,
                'registration_no'=>$request->RegistrationNo,
            ));
        
        
            // return "booking Success";
            $success='S';
            $failed_id='';
        }else{
            // return "else";
            $success='F';
            $booking_id='';
            $failed_id='Fail_'.rand(0000,9999);
        }
        return redirect()->route('PaymentSuccessforhall',['booking_id'=>$booking_id,'failed_id'=>$failed_id,'success'=>$success]);
    }

    public function PaymentSuccess(Request $request)
    {
        // return $request;
        $booking_id=$request->booking_id;
        // $hall_book=TdHallbook::where('booking_id',$booking_id)->get();
        $hall_book=DB::table('td_hall_book')
            ->leftJoin('md_location','md_location.id','=','td_hall_book.location_id')
            ->leftJoin('td_users','td_users.id','=','td_hall_book.user_id')
            ->leftJoin('md_room_type','md_room_type.id','=','td_hall_book.room_type_id')
            ->select('td_hall_book.*','md_location.location as location_name','td_users.email as email','td_users.mobile_no as mobile_no','md_room_type.type as type')
            ->where('td_hall_book.booking_id',$booking_id)
            ->get();

        $hall_book_details=TdHallbookDetails::where('booking_id',$booking_id)->get();
        // return $hall_book;
        return view('hall_confirm_payment',['searched'=>$request,'hall_book'=>$hall_book,
        'hall_book_details'=>$hall_book_details
        ]);
    }

}