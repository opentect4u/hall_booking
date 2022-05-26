<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan,MdCautionMoney};
use DB;

class CautionMoneyController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        // $datas=MdCautionMoney::get();
        $datas=DB::table('md_caution_money')
            ->leftJoin('md_room_type','md_room_type.id','=','md_caution_money.room_type_id')
            ->select('md_caution_money.*','md_room_type.type as room_type')
            ->get();
        // return $datas;
        return view('admin.caution_money',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        // return $room_types;
        return view('admin.caution_money_add_edit',['room_types'=>$room_types,'locations'=>$locations]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdCautionMoney::create(array(
            'effective_date'=>date('Y-m-d',strtotime($request->effective_date)),
            'room_type_id'=>$request->room_type_id,
            'percentage'=>$request->percentage,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.cautionMoney');
    }

    public function ShowEdit($id)
    {
        $customer=MdCautionMoney::find($id);
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        return view('admin.caution_money_add_edit',['room_types'=>$room_types,'locations'=>$locations,'customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdCautionMoney::find($id);
        $customer->effective_date=date('Y-m-d',strtotime($request->effective_date));
        $customer->room_type_id=$request->room_type_id;
        $customer->percentage=$request->percentage;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}