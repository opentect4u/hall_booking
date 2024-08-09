<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use DB;
use Session;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,
    MdParam,MdState,TdRoomPayment,MdMenu,TdRoomMenu,TdPayment
};
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserdashController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.user.session');
    }

    public function Userdash(Request $request)
    {
        if (Session::get('user_ft') == '') {
            return redirect()->route('Userlogin');
        }
       return view('userdashboard.dashboard');
    }
    public function bookinghistory(Request $request)
    {
        if (Session::get('user_ft') == '') {
            return redirect()->route('Userlogin');
        }
        $user_id = Session::get('user_ft');
        $datas=DB::table('td_room_book')
        ->leftJoin('td_room_book_details','td_room_book_details.booking_id','=','td_room_book.booking_id')
        ->leftJoin('td_payment','td_payment.booking_id','=','td_room_book.booking_id')
         ->select('td_room_book.*','td_room_book_details.first_name','td_room_book_details.middle_name','td_room_book_details.last_name',
        'td_room_book_details.organisation_name','td_room_book_details.customer_type_flag')
         ->where('td_room_book.user_id',$user_id)
         ->where('td_payment.status','Success')
        ->groupBy('booking_id')
         ->orderBy('booking_id','DESC')
         ->get();
       
       return view('userdashboard.bookinghis',['datas'=>$datas,'STA'=>'A']);
      
        
    }
    public function cancelhistory(Request $request)
    {
        if (Session::get('user_ft') == '') {
            return redirect()->route('Userlogin');
        }
        $user_id = Session::get('user_ft');
        $datas=DB::table('td_room_book')
        ->leftJoin('td_room_book_details','td_room_book_details.booking_id','=','td_room_book.booking_id')
        ->leftJoin('td_payment','td_payment.booking_id','=','td_room_book.booking_id')
         ->select('td_room_book.*','td_room_book_details.first_name','td_room_book_details.middle_name','td_room_book_details.last_name',
        'td_room_book_details.organisation_name','td_room_book_details.customer_type_flag')
         ->where('td_room_book.user_id',$user_id)
         ->where('td_payment.status','Success')
         ->where('td_room_book.booking_status','C')
        ->groupBy('booking_id')
         ->orderBy('booking_id','DESC')
         ->get();
       
       return view('userdashboard.bookinghis',['datas'=>$datas,'STA'=>'C']);
      
        
    }
    public function receipt(Request $request)
    {
        // return $request;
        $booking_id=$request->booking_id;
        // $hall_book=TdHallbook::where('booking_id',$booking_id)->get();
        $hall_book=DB::table('td_room_book')
            ->leftJoin('md_location','md_location.id','=','td_room_book.location_id')
            ->leftJoin('td_users','td_users.id','=','td_room_book.user_id')
            ->leftJoin('md_room_type','md_room_type.id','=','td_room_book.room_type_id')
            ->select('td_room_book.*','md_location.location as location_name','td_users.email as email','td_users.mobile_no as mobile_no','md_room_type.type as type')
            ->where('td_room_book.booking_id',$booking_id)
            ->get();
            $hall_book_details=TdRoomBookDetails::where('booking_id',$booking_id)->get();
            $payment_details=TdPayment::where('booking_id',$booking_id)->get();
        
        return view('userdashboard.receipt',['searched'=>$request,'hall_book'=>$hall_book,'payment_details'=>$payment_details,
        'hall_book_details'=>$hall_book_details
        ]);
    }
    public function paymenthis(Request $request)
    {
        if (Session::get('user_ft') == '') {
            return redirect()->route('Userlogin');
        }
        $user_id = Session::get('user_ft');
        $datas=DB::table('td_room_book')
        ->leftJoin('td_room_book_details','td_room_book_details.booking_id','=','td_room_book.booking_id')
        ->leftJoin('td_payment','td_payment.booking_id','=','td_room_book.booking_id')
         ->select('td_room_book.*','td_room_book_details.first_name','td_room_book_details.middle_name','td_room_book_details.last_name',
        'td_room_book_details.organisation_name','td_room_book_details.customer_type_flag','td_payment.amount')
         ->where('td_room_book.user_id',$user_id)
         ->where('td_payment.status','Success')
        ->groupBy('booking_id')
         ->orderBy('booking_id','DESC')
         ->get();
       
       return view('userdashboard.paymenthis',['datas'=>$datas]);
    }
    public function profileupdate(Request $request)
    {
        $user_id = Session::get('user_ft');
        if ($request->isMethod('post')) {
            $user = TdUser::find($user_id);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();
            session()->flash('success', 'Your Profile Updated successful!');
            return redirect()->route('profileupdate');
        }else{
            
            $datas = TdUser::where('id', $user_id)->first();
            return view('userdashboard.profileupdate',['datas'=>$datas]);
        }
    }

    

    
    

    
}
