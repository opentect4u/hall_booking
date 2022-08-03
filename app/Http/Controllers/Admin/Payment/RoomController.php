<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,
    MdParam,MdState,MdMenu,TdRoomMenu,TdRoomPayment
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
        
        // $datas=TdRoomBook::with('RoomMenu')
        //     ->with('RoomBookDetails')
        //     ->with('RoomRentDetails')
        //     ->with('PaymentDetails')
        //     ->where('booking_id',$booking_id)
        //     ->get();
        $datas=TdRoomBook::where('booking_id',$booking_id)
            ->get();
        // return $datas;

        $room_menu=TdRoomMenu::where('booking_id',$booking_id)
        ->get();
        $room_book_details=TdRoomBookDetails::where('booking_id',$booking_id)
        ->get();
        // $room_rent_details=MdRoomRent::where('booking_id',$booking_id)
        // ->get();
        $payment_details=TdRoomPayment::where('booking_id',$booking_id)
        ->get();
        // return $datas[0]['room_menu'];
        // foreach ($datas as $key => $value) {
        //     return $value->room_menu;
        // }
        // return $room_menu;
        return view('admin.payment.payment_details',['booking_id'=>$booking_id,
            'datas'=>$datas,'room_menu'=>$room_menu,'room_book_details'=>$room_book_details,
            'payment_details'=>$payment_details
        ]);
    }

    public function PayNow(Request $request)
    {
        // return $request;
        $id=$request->id;
        TdRoomPayment::create(array(
            'booking_id' =>$request->booking_id,
            'amount' =>$request->pay_amt,
            'payment_date' => date('Y-m-d H:i:s'),
            'payment_made_by' =>'Cash',
        ));
        $data=TdRoomBook::find($id);
        $data->full_paid='Y';
        $data->final_bill_flag='Y';
        $data->save();
        // return $data;
        return redirect()->route('admin.viewBill',['booking_id'=>$request->booking_id]);
    }


    public function ViewBill(Request $request, $booking_id)
    {
        // $datas=TdRoomBook::with('RoomMenu')
        // ->with('RoomBookDetails')
        // ->with('RoomRentDetails')
        // ->where('booking_id',$booking_id)
        // ->get();
        // return $datas;

        $datas=TdRoomBook::where('booking_id',$booking_id)
            ->get();
        $room_menu=TdRoomMenu::where('booking_id',$booking_id)->get();
        $room_book_details=TdRoomBookDetails::where('booking_id',$booking_id)->get();
        // $room_rent_details=MdRoomRent::where('booking_id',$booking_id)->get();
        $payment_details=TdRoomPayment::where('booking_id',$booking_id)->get();
        // return $room_menu;
        return view('admin.payment.final_bill',['booking_id'=>$booking_id,
            'datas'=>$datas,'room_menu'=>$room_menu,'room_book_details'=>$room_book_details,
            'payment_details'=>$payment_details
        ]);
    }
}
