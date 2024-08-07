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
         ->select('td_room_book.*','td_room_book_details.first_name','td_room_book_details.middle_name','td_room_book_details.last_name',
        'td_room_book_details.organisation_name','td_room_book_details.customer_type_flag')
         ->where('td_room_book.user_id',$user_id)
        ->groupBy('booking_id')
         ->orderBy('booking_id','DESC')
         ->get();
       
       return view('userdashboard.bookinghis',['datas'=>$datas]);
      
        
    }

    
    

    
}
