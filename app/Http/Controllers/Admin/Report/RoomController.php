<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,
    MdParam,MdState,TdRoomPayment
};
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show(Request $request)
    {
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        // return $from_date;
        if ($from_date!='' && $to_date!='') {
            // $datas=TdRoomBook::whereIn('paid_amount_date',[date('Y-m-d',strtotime($from_date)),date('Y-m-d',strtotime($to_date))])
            $datas=TdRoomPayment::whereDate('payment_date','>=',date('Y-m-d',strtotime($from_date)))
                ->whereDate('payment_date','<=',date('Y-m-d',strtotime($to_date)))
                // ->with('HallBookingDetails')
                // ->where('paid_amount','>',0)
                // ->orWhere('final_bill_amount','>',0)
                ->orderBy('booking_id','DESC')
                ->get();
        }else{
            $datas=[];
        }
        return view('admin.report.report_manage',['datas'=>$datas,'from_date'=>$from_date,'to_date'=>$to_date]);
    }
    public function bookinglist(Request $request)
    {
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        // return $from_date;
        if ($from_date!='' && $to_date!='') {
            $from_date = date('Y-m-d',strtotime($from_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $sql ="SELECT d.room_name,d.room_type_id, b.date ,b.booking_id,count(*) as numberofroom FROM td_room_lock b
            join md_room d ON d.room_type_id = b.room_type_id
               where b.date >= '$from_date' 
               AND b.date <= '$to_date'
               and d.id = b.room_id
               and b.status = 'L'
               group by d.room_type_id,d.room_name,b.date ,b.booking_id";
          
            $datas = DB::select($sql);

          
         
        }else{
            $datas=[];
        }
        return view('admin.report.booking_list',['datas'=>$datas,'from_date'=>$from_date,'to_date'=>$to_date]);
    }
    public function onlinepayment(Request $request)
    {
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        // return $from_date;
        if ($from_date!='' && $to_date!='') {
            $from_date = date('Y-m-d',strtotime($from_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $sql ="SELECT * FROM td_payment where trans_date >= '$from_date' AND trans_date <= '$to_date'
               and status like 'Success' ";
            $datas = DB::select($sql);
        }else{
            $datas=[];
        }
        return view('admin.report.online_payment_list',['datas'=>$datas,'from_date'=>$from_date,'to_date'=>$to_date]);
    }
}
