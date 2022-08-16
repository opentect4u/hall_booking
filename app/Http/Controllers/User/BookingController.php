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

    public function Cancel(Request $request)
    {
        // return $request;
        $booking_id=$request->booking_id;
        $booking_id='BKI20220812101745';
        $room_book=TdRoomBook::where('booking_id',$booking_id)->get();
        if (count($room_book)>0) {
            // return $room_book[0]['id'];

            $today=date('Y-m-d');
            $interval =Carbon::parse($today)->diff(Carbon::parse($room_book[0]['from_date']))->days;
            $interval =6;
            $percentage_cancel_charge=MdCancelPlan::where('from_day','<=',$interval)
                ->where('to_day','>=',$interval)
                ->value('percentage');

            $edit=TdRoomBook::find($room_book[0]['id']);
            $edit->booking_status='C';
            $edit->save();

            TdRoomLock::where('booking_id',$booking_id)->update([
                'status'=>'U',
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            
            // return $room_book;
            $msg="1";

        }else{
            $msg="0";
            $percentage_cancel_charge='';
        }


        $arrNewResult = array();
        $arrNewResult['booking_id'] = $booking_id;
        $arrNewResult['percentage_cancel_charge'] = $percentage_cancel_charge;
        $arrNewResult['msg'] = $msg;
        $status_json = json_encode($arrNewResult);
        echo $status_json;
    }
}
