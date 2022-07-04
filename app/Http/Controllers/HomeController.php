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

class HomeController extends Controller
{
    public function Show(Request $request)
    {
        $locations=MdLocation::get();
        $room_types=MdRoomType::get();
        $book_date=MdParam::where('id',1)->value('value');
        // return $locations;
        $Date=date('Y-m-d');
        $advance_book_date=date('Y-m-d', strtotime($Date. ' + '.$book_date.' months'));

        $checking_time=MdParam::where('id',4)->value('value');
        $checkout_time=MdParam::where('id',5)->value('value');
        return view('index',['locations'=>$locations,'room_types'=>$room_types,'advance_book_date'=>$advance_book_date,
            'checking_time'=>$checking_time,'checkout_time'=>$checkout_time
        ]);
    }

    public function RoomTypeAjax(Request $request)
    {
        $location_id=$request->location_id;
        $code=$request->code;
        
        $room_types=MdRoomType::where('location_id',$location_id)->where('code','=',$code)->get();
        return view('room_type_ajax',['room_types'=>$room_types]);
    }

    public function MaxGuestDetailsAjax(Request $request)
    {
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $code=$request->code;

        $room_types=MdRoomType::where('id',$room_type_id)->get();
        foreach ($room_types as $key => $value) {
            $room_type=$value->type;
            $max_person_number=$value->max_accomodation_number;
            $max_child_number=$value->max_child_number;
        }

        $datas=[];
        $datas['room_type']=$room_type;
        $datas['max_person_number']=$max_person_number;
        $datas['max_child_number']=$max_child_number;
        echo json_encode($datas);
    }

    public function HallbookingDates(Request $request)
    {
        $days=$request->days;
        $book_date=MdParam::where('id',1)->value('value');
        // return $book_date;
        $Date=date('Y-m-d');
        $advance_book_date=date('Y-m-d', strtotime($Date. ' + '.$book_date.' months'));
        return view('hall_booking_dates_ajax',['days'=>$days,'advance_book_date'=>$advance_book_date]);
    }

    public function GuestDetailsFieldsAjax(Request $request)
    {
        $rooms=$request->rooms;
        return view('rooms_guest_details_ajax',['rooms'=>$rooms]);
    }

}
