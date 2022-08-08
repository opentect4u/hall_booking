<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,
    MdParam,MdState,TdRoomPayment,MdMenu,TdRoomMenu
};
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    public function __construct() {
        $this->middleware('auth:frontuser');
    }

    public function BookingDetails(Request $request)
    {
        // return Auth::user()->id;
        $id=Auth::user()->id;
        $datas=TdRoomBook::where('user_id',$id)->get();
        // return $datas;
        return view('user.booking_manage',['datas'=>$datas]);
    }

    public function Show(Request $request,$booking_id)
    {
        // return $booking_id;
        $room_book=TdRoomBook::where('booking_id',$booking_id)->get();
        $room_book_details=TdRoomBookDetails::where('booking_id',$booking_id)->get();
        $room_lock=TdRoomLock::where('booking_id',$booking_id)->get();
        $room_menu=TdRoomMenu::where('booking_id',$booking_id)->get();
        $room_payment=TdRoomPayment::where('booking_id',$booking_id)->get();
        return view('user.booking_details',['room_book'=>$room_book]);
    }
}
