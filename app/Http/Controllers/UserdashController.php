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
   

    public function Userdash(Request $request)
    {
        if (Session::get('user_id') == '') {
            return redirect('/');
        }
        $datas = '';
        return view('userdashboard.dashboard');
        
    }
    

    
}
