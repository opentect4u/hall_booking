<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,
    MdParam,MdState,MdMenu,TdRoomMenu
};
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=TdRoomBook::orderBy('booking_id','DESC')->get();
        // return $datas;
        return view('admin.payment.payment_manage',['datas'=>$datas]);
    }

    public function AddMenu(Request $request,$booking_id)
    {
        // return $request;
        $menus=MdMenu::get();
        return view('admin.payment.add_menu',['booking_id'=>$booking_id,'menus'=>$menus]);
    }

    public function StoreMenu(Request $request)
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

    public function PriceAjax(Request $request)
    {
        $id=$request->id;
        $price=MdMenu::where('id',$id)->value('price');
        $datas=[];
        $datas['price']=$price;

        echo json_encode($datas);
    }

    public function Details(Request $request, $booking_id)
    {
        // return $booking_id;
        
        $datas=TdRoomBook::with('RoomMenu')
            ->with('RoomBookDetails')
            ->with('RoomRentDetails')
            ->where('booking_id',$booking_id)
            ->get();
        // return $datas;
        return view('admin.payment.payment_details',['booking_id'=>$booking_id,'datas'=>$datas]);
    }


    public function ViewBill(Request $request, $booking_id)
    {
        $datas=TdRoomBook::with('RoomMenu')
        ->with('RoomBookDetails')
        ->with('RoomRentDetails')
        ->where('booking_id',$booking_id)
        ->get();
        return view('admin.payment.final_bill',['booking_id'=>$booking_id,'datas'=>$datas]);
    }
}
