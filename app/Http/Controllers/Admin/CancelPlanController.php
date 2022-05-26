<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdCancelPlan};
use DB;

class CancelPlanController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=MdCancelPlan::get();
        // $datas=DB::table('md_room')
        //     ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
        //     ->leftJoin('md_location','md_location.id','=','md_room.location_id')
        //     ->select('md_room.*','md_room_type.type as room_type','md_location.location as location')
        //     ->get();
        // return $datas;
        return view('admin.cancel_plan',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        // return $room_types;
        return view('admin.cancel_plan_add_edit',['room_types'=>$room_types,'locations'=>$locations]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdCancelPlan::create(array(
            'from_day'=>$request->from_day,
            'to_day'=>$request->to_day,
            'percentage'=>$request->percentage,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.cancelPlan');
    }

    public function ShowEdit($id)
    {
        $customer=MdCancelPlan::find($id);
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        return view('admin.cancel_plan_add_edit',['room_types'=>$room_types,'locations'=>$locations,'customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdCancelPlan::find($id);
        $customer->from_day=$request->from_day;
        $customer->to_day=$request->to_day;
        $customer->percentage=$request->percentage;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
