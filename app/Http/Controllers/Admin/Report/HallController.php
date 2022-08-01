<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdHallbook,TdHallLock,TdHallbookDetails,TdUser,MdHallRent,MdParam,
    MdRoomRent,MdState,TdHallPayment
};
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class HallController extends Controller
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
            $datas=TdHallPayment::whereDate('payment_date','>=',date('Y-m-d',strtotime($from_date)))
            ->whereDate('payment_date','<=',date('Y-m-d',strtotime($to_date)))
            // ->with('HallBookingDetails')
            // ->where('paid_amount','>',0)
            // ->orWhere('final_bill_amount','>',0)
            ->orderBy('booking_id','DESC')
            ->get();
        }else{
            $datas=[];
        }
        // foreach ($datas as $key => $value) {
        //     return $value;
        //     return $value['hall_booking_details'];
        //     // return $datas[0]['booking_details'];
        // }
        // return $datas;
        return view('admin.report.hall_report_manage',['datas'=>$datas,'from_date'=>$from_date,'to_date'=>$to_date]);
    }
}
