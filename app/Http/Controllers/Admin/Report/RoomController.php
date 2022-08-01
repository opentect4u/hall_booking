<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,
    MdCautionMoney,TdRoomBook,TdRoomLock,TdRoomBookDetails,TdUser,MdRoomRent,
    MdParam,MdState
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
            $datas=TdRoomBook::whereDate('paid_amount','>=',date('Y-m-d',strtotime($from_date)))
                ->whereDate('paid_amount','<=',date('Y-m-d',strtotime($to_date)))
                ->where('paid_amount','>',0)
                // ->orWhere('final_bill_amount','>',0)
                ->orderBy('booking_id','DESC')
                ->get();
        }else{
            $datas=[];
        }
        return view('admin.report.report_manage',['datas'=>$datas,'from_date'=>$from_date,'to_date'=>$to_date]);
    }
}
