<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdHallbook,TdHallLock,TdHallbookDetails,TdUser,MdHallRent,MdParam,
    MdRoomRent,MdState,MdMenu,TdHallMenu
};
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class HallController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=TdHallbook::orderBy('booking_id','DESC')->get();
        return view('admin.payment.hall_payment_manage',['datas'=>$datas]);
    }

    public function AddMenu(Request $request,$booking_id)
    {
        // return $request;
        $menus=MdMenu::get();
        return view('admin.payment.add_menu_hall',['booking_id'=>$booking_id,'menus'=>$menus]);
    }

    public function StoreMenu(Request $request)
    {
        // return $request;
        for ($i=0; $i < count($request->item_name); $i++) { 
            TdHallMenu::create(array(
                'booking_id'=>$request->booking_id,
                'menu_id'=>$request->item_name[$i],
                'no_of_head'=>$request->no_of_head[$i],
                'rate'=>$request->amount[$i],
                'amount'=> ( $request->no_of_head[$i] * $request->amount[$i]),
            ));
        }
        return redirect()->back()->with('success','success');
    }

    public function Details(Request $request, $booking_id)
    {
        // return $booking_id;
        
        $datas=TdHallbook::with('HallMenu')
            ->with('HallBookDetails')
            // ->with('RoomRentDetails')
            ->where('booking_id',$booking_id)
            ->get();
        // return $datas;
        return view('admin.payment.payment_details_hall',['booking_id'=>$booking_id,'datas'=>$datas]);
    }

}
