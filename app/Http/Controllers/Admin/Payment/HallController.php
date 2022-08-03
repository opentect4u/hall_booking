<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdHallbook,TdHallLock,TdHallbookDetails,TdUser,MdHallRent,MdParam,
    MdRoomRent,MdState,MdMenu,TdHallMenu,TdHallPayment
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
        
        // $datas=TdHallbook::with('HallMenu')
        //     ->with('HallBookDetails')
        //     // ->with('RoomRentDetails')
        //     ->where('booking_id',$booking_id)
        //     ->get();
        // return $datas;
        $datas=TdHallbook::where('booking_id',$booking_id)
        ->get();
        // return $datas;

        $room_menu=TdHallMenu::where('booking_id',$booking_id)
        ->get();
        $room_book_details=TdHallbookDetails::where('booking_id',$booking_id)
        ->get();
        // $room_rent_details=MdRoomRent::where('booking_id',$booking_id)
        // ->get();
        $payment_details=TdHallPayment::where('booking_id',$booking_id)
        ->get();
        return view('admin.payment.hall_payment_details',['booking_id'=>$booking_id,
            'datas'=>$datas,'room_menu'=>$room_menu,'room_book_details'=>$room_book_details,
            'payment_details'=>$payment_details
        ]);
    }

    public function PayNow(Request $request)
    {
        // return $request;
        $id=$request->id;
        TdHallPayment::create(array(
            'booking_id' =>$request->booking_id,
            'amount' =>$request->pay_amt,
            'payment_date' => date('Y-m-d H:i:s'),
            'payment_made_by' =>'Cash',
        ));
        $data=TdHallbook::find($id);
        $data->full_paid='Y';
        $data->final_bill_flag='Y';
        $data->save();
        // return $data;
        return redirect()->route('admin.viewBillHall',['booking_id'=>$request->booking_id]);
    }


    public function ViewBill(Request $request, $booking_id)
    {
        // $datas=TdRoomBook::with('RoomMenu')
        // ->with('RoomBookDetails')
        // ->with('RoomRentDetails')
        // ->where('booking_id',$booking_id)
        // ->get();
        // return $datas;

        $datas=TdHallbook::where('booking_id',$booking_id)
            ->get();
        $room_menu=TdHallMenu::where('booking_id',$booking_id)->get();
        $room_book_details=TdHallbookDetails::where('booking_id',$booking_id)->get();
        // $room_rent_details=MdRoomRent::where('booking_id',$booking_id)->get();
        $payment_details=TdHallPayment::where('booking_id',$booking_id)->get();
        // return $payment_details;
        return view('admin.payment.hall_final_bill',['booking_id'=>$booking_id,
            'datas'=>$datas,'room_menu'=>$room_menu,'room_book_details'=>$room_book_details,
            'payment_details'=>$payment_details
        ]);
    }

}
