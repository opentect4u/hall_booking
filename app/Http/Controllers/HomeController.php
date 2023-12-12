<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,Tdotp,
    MdParam,MdState
};
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function Show(Request $request)
    {
        $locations=MdLocation::where('id',1)->get();
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

    public function Userlogin(Request $request)
    {
        $datas = '';
        return view('userdashboard.login');
        
    }
    public function generateotp(Request $request){
        
        $mobileno_email = $request->mobileno_email;
        $mobileregex = "/^[6-9][0-9]{9}$/" ;  
        if(preg_match($mobileregex, $mobileno_email)){
            $user_info=TdUser::where('mobile_no',$mobileno_email)->get();
        }else{
            $user_info=TdUser::where('email',$mobileno_email)->get();
        }
        
        $count = $user_info->count();
        //    GENERATING OTP
        $generator = "1358902647";
        $result = ''; 
        for ($i = 1; $i <= 5; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
        if($count > 0){
            Tdotp::create(array(
                            'mobileno_email'=>$mobileno_email,
                            'otp'=>$result,
                            'status'=>1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => NULL
                        ));
        }
        return redirect()->route('otp',['mobileno_email'=>$mobileno_email]);
    }
    public function otp(Request $request)
    {
        $mobileno_email = $request->mobileno_email;
        return view('userdashboard.otp',['mobileno_email'=>$mobileno_email]);
        
    }
    public function validateotp(Request $request)
    {
        $mobileno_email=$request->mobileno_email;
        $otp=$request->otp;
        $datas=Tdotp::where('mobileno_email',$mobileno_email)->where('otp',$otp)->where('status',1)->get();
        if(count($datas) > 0) {

            Session::put('mobileno_email', $mobileno_email);
            $mobileregex = "/^[6-9][0-9]{9}$/" ;
            if(preg_match($mobileregex, $mobileno_email)){
                $is_user=TdUser::where('mobile_no',$mobileno_email)->get();
                $user_id=$is_user[0]['id'];
            }else{
                $is_user=TdUser::where('email',$mobileno_email)->get();
                $user_id=$is_user[0]['id'];
            }
            Session::put('user_id', $user_id);
            $updateDetails = array('status'=>0);
            DB::table('td_otp')->where('mobileno_email',$mobileno_email)->where('otp', $otp)->update($updateDetails);
        }
        return redirect()->route('Userdash');
    }
    public function userlogout(){

        Session::flush();

        return redirect('/');
    }

}
