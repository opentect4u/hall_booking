<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,MdCautionMoney,MdRoomCharge};
use DB;

class RoomChargeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        // $datas=MdRoom::get();
        $datas=DB::table('md_room_charge')
            ->leftJoin('md_room_type','md_room_type.id','=','md_room_charge.room_type_id')
            ->select('md_room_charge.*','md_room_type.type as room_type')
            ->get();
        // return $datas;
        return view('admin.room_charge',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        // return $room_types;
        return view('admin.room_charge_add_edit',['room_types'=>$room_types,'locations'=>$locations]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdRoomCharge::create(array(
            'room_type_id'=>$request->room_type_id,
            'effective_date'=>date('Y-m-d',strtotime($request->effective_date)),
            'hour_flag'=>$request->hour_flag,
            'per_bed_flag'=>$request->per_bed_flag,
            'amount'=>$request->amount,
            'discount_percentage'=>$request->discount_percentage,
            'holiday_amount'=>$request->holiday_amount,
            'cgst_rate'=>$request->cgst_rate,
            'sgst_rate'=>$request->sgst_rate,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.roomCharge');
    }

    public function ShowEdit($id)
    {
        $customer=MdRoomCharge::find($id);
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        return view('admin.room_charge_add_edit',['room_types'=>$room_types,'locations'=>$locations,'customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdRoomCharge::find($id);
        $customer->room_type_id=$request->room_type_id;
        $customer->effective_date=date('Y-m-d',strtotime($request->effective_date));
        $customer->hour_flag=$request->hour_flag;
        $customer->per_bed_flag=$request->per_bed_flag;
        $customer->amount=$request->amount;
        $customer->discount_percentage=$request->discount_percentage;
        $customer->holiday_amount=$request->holiday_amount;
        $customer->cgst_rate=$request->cgst_rate;
        $customer->sgst_rate=$request->sgst_rate;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
