<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRoomType, MdLocation };
use DB;

class RoomTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=DB::table('md_room_type')
            ->leftJoin('md_location','md_location.id','=','md_room_type.location_id')
            ->select('md_room_type.*','md_location.location as location_name')
            ->get();
        // $datas=MdRoomType::get();
        return view('admin.room_type',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        $locations=MdLocation::get();
        return view('admin.room_type_add_edit',['locations'=>$locations]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdRoomType::create(array(
            'type'=>$request->type,
            'location_id'=>$request->location_id,
            'max_accomodation_number'=>$request->max_accomodation_number,
            'max_child_number'=>$request->max_child_number,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.roomType');
    }

    public function ShowEdit($id)
    {
        $customer=MdRoomType::find($id);
        $locations=MdLocation::get();
        return view('admin.room_type_add_edit',['customer'=>$customer,'locations'=>$locations]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdRoomType::find($id);
        $customer->type=$request->type;
        $customer->location_id=$request->location_id;
        $customer->max_accomodation_number=$request->max_accomodation_number;
        $customer->max_child_number=$request->max_child_number;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
