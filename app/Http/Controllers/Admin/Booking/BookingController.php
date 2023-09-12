<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,
    MdParam,MdState,TdRoomPayment,TdRoomMenu,MdMenu
};
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Manage(Request $request)
    {
        $datas=TdRoomBook::orderBy('booking_id','DESC')->get();
        return view('admin.booking.booking_manage',['datas'=>$datas]);
    }

    public function BookingDetails($booking_id)
    {
        // return $booking_id;
        // $booking_id=$request->booking_id;
        if($booking_id!=''){
            // room_type_id
            $datas=DB::table('td_room_book')
                ->leftJoin('md_location','md_location.id','=','td_room_book.location_id')
                ->leftJoin('md_room_type','md_room_type.id','=','td_room_book.room_type_id')
                ->select('td_room_book.*','md_location.location as location_name','md_room_type.type as room_type')
                ->where('td_room_book.booking_id',$booking_id)
                ->get();
            $guest_details=TdRoomBookDetails::where('booking_id',$booking_id)->get();
        }else{
            $guest_details=[];
            $datas=[];
        }
        // return $datas;
        // return $datas[0]->booking_id;
        return view('admin.booking.booking_details',['booking_id'=>$booking_id,
            'guest_details'=>$guest_details,'datas'=>$datas
        ]);
    }



    public function Show(Request $request)
    {
        $locations=MdLocation::get();
        $room_types=MdRoomType::get();
        $book_date=MdParam::where('id',9)->value('value');
        // return $book_date;
        $Date=date('Y-m-d');
        $advance_book_date=date('Y-m-d', strtotime($Date. ' + '.$book_date.' months'));

        $checking_time=MdParam::where('id',4)->value('value');
        $checkout_time=MdParam::where('id',5)->value('value');

        // return $checking_time;
        return view('admin.booking.booking',['locations'=>$locations,'room_types'=>$room_types,'advance_book_date'=>$advance_book_date,
            'checking_time'=>$checking_time,'checkout_time'=>$checkout_time
        ]);
    }

    public function RoomTypeAjax(Request $request)
    {
        $location_id=$request->location_id;
        $code=$request->code;
        
        $room_types=MdRoomType::where('location_id',$location_id)->where('code','=',$code)->get();
        return view('admin.booking.room_type_ajax',['room_types'=>$room_types]);
    }

    public function Search(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $from_date=$request->from_date;
        $to_date=$request->to_date;

        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
        // return $interval;

        $lock_rooms=TdRoomLock::where('room_type_id',$request->room_type_id)
             ->where('status','L')
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
            
            // if(count($lock_room_array) > 0){
            //     $datas=DB::table('md_room')
            //         ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
            //         ->select('md_room.*','md_room_type.type as room_type')
            //         ->where('md_room.room_type_id',$room_type_id)
            //         ->where('md_room.location_id',$location_id)
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
        $room_rent=MdRoomRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->orderBy('effective_date','DESC')
            ->get();
        // return $room_rent;
        return view('admin.booking.room_details',['room_type'=>$room_type,'datas'=>$datas,
            'max_person_number'=>$max_person_number,'lock_room_array'=>$lock_room_array,
            'room_rent'=>$room_rent,'interval'=>$interval,'max_child_number'=>$max_child_number
        ]);


        // if ($location_id !='' && $room_type_id !='' && $from_date !='' && $to_date !='') {
        //     if (strtotime($from_date) < strtotime($to_date)) {
        //         // return $request;
        //         // return strtotime($from_date);
        //         $format_from_date=date('Y-m-d',strtotime($from_date));
        //         $format_to_date=date('Y-m-d',strtotime($to_date));
        //         $room_type=MdRoomType::where('id',$room_type_id)->value('type');

        //         $lock_rooms=TdRoomLock::whereDate('date','<=',$format_from_date)
        //             ->whereDate('date','<=',$format_to_date)
        //             ->where('status','L')->get();
        //         // return $lock_rooms;
        //         if (count($lock_rooms) > 0) {
        //             // return redirect()->back()->with('room_not_ava','room_not_ava');
        //             $datas=[];
        //             return view('admin.booking.room_details',['request'=>$request,'room_type'=>$room_type,'datas'=>$datas]);
        //         }else{
        //             // MdRoom::
        //             $datas=DB::table('md_room')
        //                 ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
        //                 ->select('md_room.*','md_room_type.type as room_type')
        //                 ->where('md_room.room_type_id',$room_type_id)
        //                 ->where('md_room.location_id',$location_id)
        //                 ->groupBy('md_room.room_type_id')
        //                 ->get();
        //             // return $datas;
        //             return view('admin.booking.room_details',['request'=>$request,'room_type'=>$room_type,'datas'=>$datas]);
        //         }
        //     }else{
        //         return redirect()->back()->with('dateerror','dateerror');
        //     }
        // }else {
        //     return redirect()->back()->with('error','error');
        // }
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
        $total_room_no=$request->total_room_no;

        // adult_no_1
        // child_no_1
        // $adult_no=0;
        // $child_no=0;
        // // for ($i=1; $i <=$total_room_no; $i++) { 
        // //     $adult_no +=
        // // }
        $adult_no=$request->adult_no;
        $child_no=$request->child_no;
        // return $child_no;
        // $room_type=MdRoomType::where('id',$room_type_id)->value('type');
        $states=MdState::get();
        return view('admin.booking.passenger_details',['adult_no'=>$adult_no,'child_no'=>$child_no,'states'=>$states]);
        // return view('admin.booking.payment',['request'=>$request,'room_type'=>$room_type]);
        
    }

    public function PriceDetails(Request $request)
    {
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $totalnoroom=$request->totalnoroom;
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        $catering_service=$request->catering_service;
        // return $catering_service;
        $room_rent=MdRoomRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->orderBy('effective_date','DESC')
            ->get();
        // return $room_rent;
        $advance_payment_needed=MdParam::where('id',7)->value('value');
        $advance_payment=MdParam::where('id',2)->value('value');
        $catering_service_amount=MdParam::where('id',8)->value('value');
        // return $advance_payment;
        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
        return view('admin.booking.price_details',['room_rent'=>$room_rent,'totalnoroom'=>$totalnoroom,
            'from_date'=>$from_date,'to_date'=>$to_date,'interval'=>$interval,'advance_payment_needed'=>$advance_payment_needed,
            'advance_payment'=>$advance_payment,'catering_service'=>$catering_service,
            'catering_service_amount'=>$catering_service_amount
        ]);
    }

    public function PreviewDetails(Request $request)
    {
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $locations=MdLocation::where('id',$location_id)->value('location');
        $room_types=MdRoomType::where('id',$room_type_id)->value('type');
        $a=[];
        $a['location']=$locations;
        $a['room_type']=$room_types;
        echo json_encode($a);
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
                'address'=>$request->address.",".$request->state.",".$request->post_code,
                'child_flag'=>'N',
            ));
            return "booking Success";
        }
    }

    public function BookingConfirm(Request $request)
    {
        // return $request;

        $total_room_no=$request->total_room_no;
        $adult_no=0;
        $child_no=0;
        for ($i=1; $i <=$total_room_no; $i++) { 
            $adult_name="adult_no_".$i;
            $child_name="child_no_".$i;
            $adult_no +=$request->$adult_name;
            $child_no +=$request->$child_name;
        }

       
        $booking_id='BKI'.date('YmdHis');
        // return $booking_id;
        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
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

        if ($request->total_amount == $request->payment) {
            $full_paid='Y';
        }else{
            $full_paid='N';
        }
        // return $full_paid;
        if($request->discount_price > 0) {

            TdRoomBook::create(array(
                'booking_id'=> $booking_id,
                'location_id'=> $request->location_id,
                'user_id'=> $user_id,
                'from_date'=> date('Y-m-d',strtotime($request->from_date)),
                'to_date'=> date('Y-m-d',strtotime($request->to_date)),
                'no_room'=> $request->total_room_no,
                'no_adult'=> $adult_no,
                'no_child'=> $child_no,
                'room_type_id'=> $request->room_type_id,
                'booking_time'=> date('Y-m-d H:i:s'),
                'catering_service'=> $request->catering_service,
                'booking_status'=> "Confirm",
                'amount'=> $request->normal_rate,
                'total_cgst_amount'=> $request->cgst_rate_per,
                'total_sgst_amount'=> $request->cgst_rate_per,
                'final_amount'=> $request->taxable,
                'discount_amount'=> $request->discount_price,
                'total_amount'=> $request->total_amount,
                'paid_amount'=> $request->payment,
                'full_paid'=> $full_paid,
                'remark'=> $request->remark,
                // 'payment_status'=> "Paid",
                'created_by'=> auth()->user()->id,
            ));

        }else{


            TdRoomBook::create(array(
                'booking_id'=> $booking_id,
                'location_id'=> $request->location_id,
                'user_id'=> $user_id,
                'from_date'=> date('Y-m-d',strtotime($request->from_date)),
                'to_date'=> date('Y-m-d',strtotime($request->to_date)),
                'no_room'=> $request->total_room_no,
                'no_adult'=> $adult_no,
                'no_child'=> $child_no,
                'room_type_id'=> $request->room_type_id,
                'booking_time'=> date('Y-m-d H:i:s'),
                'catering_service'=> $request->catering_service,
                'booking_status'=> "Confirm",
                'amount'=> $request->normal_rate,
                'total_cgst_amount'=> $request->cgst_rate_per,
                'total_sgst_amount'=> $request->sgst_rate_per,
                'final_amount'=> $request->normal_rate,
                'discount_amount'=> $request->discount_price,
                'total_amount'=> $request->total_amount,
                'paid_amount'=> $request->payment,
                'full_paid'=> $full_paid,
                'remark'=> $request->remark,
                // 'payment_status'=> "Paid",
                'created_by'=> auth()->user()->id,
            ));
        }
        

       
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

        for ($k=0; $k < $adult_no; $k++) { 
            $adt_first_name="adt_first_name".$k;
            $adt_middle_name="adt_middle_name".$k;
            $adt_last_name="adt_last_name".$k;
            TdRoomBookDetails::create(array(
                'customer_type_flag'=>'I',
                'booking_id'=>$booking_id,
                'first_name'=>$request->$adt_first_name,
                'middle_name'=>$request->$adt_middle_name,
                'last_name'=>$request->$adt_last_name,
                'address'=>$request->address.",".$request->state.",".$request->post_code,
                'child_flag'=>'N',
            ));
        }
        for ($l=0; $l < $child_no; $l++) { 
            $adt_first_name="adt_first_name".$l;
            $adt_middle_name="adt_middle_name".$l;
            $adt_last_name="adt_last_name".$l;
            TdRoomBookDetails::create(array(
                'customer_type_flag'=>'I',
                'booking_id'=>$booking_id,
                'first_name'=>$request->$adt_first_name,
                'middle_name'=>$request->$adt_middle_name,
                'last_name'=>$request->$adt_last_name,
                'address'=>$request->address.",".$request->state.",".$request->post_code,
                'child_flag'=>'Y',
            ));
        }

        if ($request->payment!='') {
            TdRoomPayment::create(array(
                'booking_id'=> $booking_id,
                'amount'=> $request->payment,
                'payment_date'=> date('Y-m-d H:i:s'),
                'payment_made_by'=> 'Payment',
            ));
        }
        
        // return "booking Success";
        return redirect()->route('admin.booking')->with('bookingSuccess','bookingSuccess');
    }

    ///    Code Start for Bulk Booking 
    public function bulkbook(Request $request)
    {
        $locations=MdLocation::get();
        $room_types=MdRoomType::get();
        $book_date=MdParam::where('id',9)->value('value');
        $Date=date('Y-m-d');
        $advance_book_date=date('Y-m-d', strtotime($Date. ' + '.$book_date.' months'));
        $checking_time=MdParam::where('id',4)->value('value');
        $checkout_time=MdParam::where('id',5)->value('value');
        $states=MdState::get();    
        // return $checking_time;
        return view('admin.booking.bulkbooking',['locations'=>$locations,'room_types'=>$room_types,'advance_book_date'=>$advance_book_date,
            'checking_time'=>$checking_time,'checkout_time'=>$checkout_time,'states'=>$states
        ]);
    }

    public function bulkSearchaccomodation(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $from_date=$request->from_date;
        $to_date=$request->to_date;

        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
        // return $interval;

        $lock_rooms=TdRoomLock::where('room_type_id',$request->room_type_id)
             ->where('status','L')
            ->whereDate('date','>=',date('Y-m-d',strtotime($request->from_date)))
            ->whereDate('date','<=',date('Y-m-d',strtotime($request->to_date)))
            ->groupBy('room_id')
            ->get();
         
    
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
                $datas=DB::table('md_room')
                    ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
                    ->select('md_room.*','md_room_type.type as room_type')
                    ->where('md_room.room_type_id',$room_type_id)
                    ->where('md_room.location_id',$location_id)
                    ->get();
        }
        $room_rent=MdRoomRent::where('location_id',$location_id)
            ->where('room_type_id',$room_type_id)
            ->orderBy('effective_date','DESC')
            ->get();

        
      
        return view('admin.booking.room_no_details',['room_type'=>$room_type,'datas'=>$datas,
           'lock_room_array'=>$lock_room_array ]);
       
    }

    public function getroomtypebylocation(Request $request)
    {
        // return $request;
        $location_id=$request->location_id;
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
        $room_types=MdRoomType::where('location_id',$location_id)->get();
        echo json_encode($room_types);
       // return json
       
    }

    public function bulkBookingConfirm(Request $request)
    {
       
        $total_room_no=count($request->room_no);
        $adult_no=0;
        $child_no=0;
       
        $booking_id='BKI'.date('YmdHis');
        // return $booking_id;
        $interval =Carbon::parse($request->from_date)->diff(Carbon::parse($request->to_date))->days;
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
            $full_paid='N';

            TdRoomBook::create(array(
                'booking_id'=> $booking_id,
                'location_id'=> $request->location_id,
                'user_id'=> $user_id,
                'from_date'=> date('Y-m-d',strtotime($request->from_date)),
                'to_date'=> date('Y-m-d',strtotime($request->to_date)),
                'no_room'=> $total_room_no,
                'no_adult'=> $request->adult_no,
                'no_child'=> $request->child_no,
                'room_type_id'=> 0,
                'booking_time'=> date('Y-m-d H:i:s'),
                'catering_service'=> $request->catering_service,
                'booking_status'=> "Confirm",
                'amount'=> 0,
                'total_cgst_amount'=> 0,
                'total_sgst_amount'=> 0,
                'final_amount'=> 0,
                'discount_amount'=> 0,
                'total_amount'=> 0,
                'paid_amount'=> 0,
                'full_paid'=> $full_paid,
                'remark'=> '',
                'book_type' => 'B',
                // 'payment_status'=> "Paid",
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
                    'room_id'=>explode(",",$room_id)[0],
                    'room_type_id'=>explode(",",$room_id)[1],
                    'status'=>'L',
                ));
            }
        }

    //    for ($k=0; $k < $adult_no; $k++) { 
        //    $adt_first_name="adt_first_name".$k;
        //    $adt_middle_name="adt_middle_name".$k;
        //    $adt_last_name="adt_last_name".$k;
            TdRoomBookDetails::create(array(
                'customer_type_flag'=>$request->customer_type_flag,
                'booking_id'=>$booking_id,
                'first_name'=>$request->adt_first_name ? $request->adt_first_name : 'N.A.',
                'middle_name'=>$request->adt_middle_name ?$request->adt_middle_name:'N.A.' ,
                'last_name'=>$request->adt_last_name ? $request->adt_last_name:'',
                'address'=>$request->address.",".$request->state.",".$request->post_code,
                'organisation_name'=>$request->organisation_name ,
                'organisation_gst_no'=>$request->organisation_gst_no,
                'pan'=>$request->pan,
                'tan'=>$request->tan,
                'registration_no'=>$request->registration_no,
                'pin' => $request->post_code,
                'state' => $request->state,
                'child_flag'=>'N'
            ));
    //    }

        // if ($request->payment!='') {
        //     TdRoomPayment::create(array(
        //         'booking_id'=> $booking_id,
        //         'amount'=> $request->payment,
        //         'payment_date'=> date('Y-m-d H:i:s'),
        //         'payment_made_by'=> 'Payment',
        //     ));
        // }
        
        // return "booking Success";
        return redirect()->route('admin.bulkbook')->with('bookingSuccess','bookingSuccess');
    }

    public function bulkManage(Request $request)
    {
         $datas=DB::table('td_room_book')
        ->leftJoin('td_room_book_details','td_room_book_details.booking_id','=','td_room_book.booking_id')
         ->select('td_room_book.*','td_room_book_details.first_name','td_room_book_details.middle_name','td_room_book_details.last_name',
        'td_room_book_details.organisation_name','td_room_book_details.customer_type_flag')
         ->where('td_room_book.book_type','B')->orderBy('booking_id','DESC')
         ->get();
       // $datas=TdRoomBook::where('book_type','B')->orderBy('booking_id','DESC')->get();
        return view('admin.booking.booking_bulkmanage',['datas'=>$datas]);
    }
    public function bulkpaymentDetails(Request $request, $booking_id)
    {   
         $datas = DB::select("SELECT d.room_name,d.room_no,d.room_type_id FROM td_room_lock b
                             join md_room d ON d.room_type_id = b.room_type_id
                                where b.booking_id = '$booking_id'
                                and d.id = b.room_id
                                group by d.room_no,d.room_name");
        $acco_rent = DB::select("SELECT a.* FROM md_room_rent a where a.effective_date=(select max(b.effective_date) from md_room_rent b where a.room_type_id=b.room_type_id)");                        
         
        $room_menu=TdRoomMenu::where('booking_id',$booking_id)->get();
        $room_book_details=TdRoomBookDetails::where('booking_id',$booking_id)->get();
        $payment_details=TdRoomPayment::where('booking_id',$booking_id)->get();
        $room_book=TdRoomBook::where('booking_id',$booking_id)->first();
  
        return view('admin.booking.bulk_payment_details',['booking_id'=>$booking_id,'room_book' => $room_book,
            'datas'=>$datas,'room_menu'=>$room_menu,'room_book_details'=>$room_book_details,
            'payment_details'=>$payment_details,'acco_rent' =>$acco_rent
        ]);
    }

    public function bulkpaymentsubmit(Request $request){

        $id=$request->id;
        TdRoomPayment::create(array(
            'booking_id' =>$request->booking_id,
            'amount' =>$request->total_amount,
            'payment_date' => $request->payment_date,
            'payment_made_by' =>$request->payment_made_by,
            'cheque_no' =>$request->cheque_no,
            'cheque_dt' =>$request->cheque_dt,
            'payment_id' =>$request->payment_id
        ));
        $data=TdRoomBook::find($id);
        $data->amount=$request->amount;
        $data->total_cgst_amount=$request->cgst_rate;
        $data->total_sgst_amount=$request->cgst_rate;
        $data->final_amount=$request->net_amount;
        $data->discount_amount=$request->discount_price;
        $data->total_amount=$request->total_amount;
        $data->paid_amount=$request->total_amount;

        $data->full_paid='Y';
        $data->final_bill_flag='Y';
        $data->save();

        return redirect()->route('admin.bulkManage')->with('bookingSuccess','bookingSuccess');
    }

    public function additem(Request $request,$booking_id)
    {
        // return $request;
        $menus=MdMenu::get();
        $addedmenu=TdRoomMenu::where('booking_id',$booking_id)->get();
        return view('admin.payment.bulk_menu',['booking_id'=>$booking_id,'menus'=>$menus,'addedmenu'=>$addedmenu]);
    }
    public function delete_item(Request $request,$id)
    {
        // return $request;
        $ids = explode('_',$id);
        $addedmenu=TdRoomMenu::where('id',$ids[0])->delete();
       return redirect()->route('admin.additem',['booking_id'=>$ids[1]]);
    }

    public function bulkStoreMenu(Request $request)
    {
        // return $request;
        for ($i=0; $i < count($request->item_name); $i++) { 
            TdRoomMenu::create(array(
                'booking_id'=>$request->booking_id,
                'menu_id'=>$request->item_name[$i],
                'no_of_head'=>$request->no_of_head[$i],
                'rate'=>$request->amount[$i],
                'amount'=> ( $request->no_of_head[$i] * $request->amount[$i]),
            ));
        }
        return redirect()->back()->with('success','success');
    }

    public function bulkViewBill(Request $request, $booking_id)
    {

        //$datas=TdRoomBook::where('booking_id',$booking_id)->get();
        $room_menu=TdRoomMenu::where('booking_id',$booking_id)->get();
        $room_book_details=TdRoomBookDetails::where('booking_id',$booking_id)->get();
        // $room_rent_details=MdRoomRent::where('booking_id',$booking_id)->get();
        $payment_details=TdRoomPayment::where('booking_id',$booking_id)->get();
        $datas = DB::select("SELECT d.room_name,d.room_no,sum(c.normal_rate) normal_rate,c.cgst_rate FROM td_room_lock b
        join md_room d ON d.room_type_id = b.room_type_id
       join md_room_rent c on c.room_type_id = b.room_type_id
           where b.booking_id = '$booking_id'
           and d.id = b.room_id
           group by d.room_no,d.room_name,c.cgst_rate");
        // return $room_menu;
        $room_book=TdRoomBook::where('booking_id',$booking_id)->first();
        return view('admin.booking.bulkfinal_bill',['booking_id'=>$booking_id,
            'datas'=>$datas,'room_menu'=>$room_menu,'room_book_details'=>$room_book_details,'room_book'=>$room_book,
            'payment_details'=>$payment_details
        ]);
    }

    public function bulkbookingcanceldtls(Request $request, $booking_id)
    {
        
        $datas = DB::select("SELECT d.room_name,d.room_no,sum(c.normal_rate) normal_rate,c.cgst_rate FROM td_room_lock b
                             join md_room d ON d.room_type_id = b.room_type_id
                            join md_room_rent c on c.room_type_id = b.room_type_id
                                where b.booking_id = '$booking_id'
                                and d.id = b.room_id
                                group by d.room_no,d.room_name,c.cgst_rate");
         
        $room_menu=TdRoomMenu::where('booking_id',$booking_id)->get();
        $room_book_details=TdRoomBookDetails::where('booking_id',$booking_id)->get();
        $payment_details=TdRoomPayment::where('booking_id',$booking_id)->get();
        $room_book=TdRoomBook::where('booking_id',$booking_id)->first();
        
        
  
        return view('admin.booking.bulk_pay_can_details',['booking_id'=>$booking_id,'room_book' => $room_book,
            'datas'=>$datas,'room_menu'=>$room_menu,'room_book_details'=>$room_book_details,
            'payment_details'=>$payment_details
        ]);
    }

    public function bulkroombookingcancel(Request $request)
    {
        // return $request->refund_mode;
        $booking_id = $request->booking_id;
        $updatedp = TdRoomPayment::where('booking_id', $booking_id)->update(
                       ['cancel_status' => 'Y',
                       'refund_mode' => $request->refund_mode,
                       'refund_amt' => $request->refund_amt,
                       'refund_dt' => $request->refund_dt,
                       'refund_cheque_no' => $request->refund_cheque_no,
                       'refund_cheque_dt' => $request->refund_cheque_dt,
                       'refund_payment_id' => $request->refund_payment_id]
                    );
        $updated = TdRoomBook::where('booking_id', $booking_id)->update(['booking_status' => 'C']);
        $updated = TdRoomLock::where('booking_id', $booking_id)->update(['status' => 'U']);
        return redirect()->route('admin.bulkManage',['booking_id'=>$request->booking_id]);
    }


}