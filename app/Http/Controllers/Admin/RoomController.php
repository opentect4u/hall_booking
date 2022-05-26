<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation};
use DB;

class RoomController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        // $datas=MdRoom::get();
        $datas=DB::table('md_room')
            ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
            ->leftJoin('md_location','md_location.id','=','md_room.location_id')
            ->select('md_room.*','md_room_type.type as room_type','md_location.location as location')
            ->get();
        // return $datas;
        return view('admin.rooms',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        // return $room_types;
        return view('admin.rooms_add_edit',['room_types'=>$room_types,'locations'=>$locations]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdRoom::create(array(
            'location_id'=>$request->location_id,
            'room_no'=>$request->room_no,
            'room_type_id'=>$request->room_type_id,
            'room_name'=>$request->room_name,
            'no_person'=>$request->no_person,
            'floor'=>$request->floor,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.rooms');
    }

    public function ShowEdit($id)
    {
        $customer=MdRoom::find($id);
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        return view('admin.rooms_add_edit',['room_types'=>$room_types,'locations'=>$locations,'customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdRoom::find($id);
        $customer->location_id=$request->location_id;
        $customer->room_no=$request->room_no;
        $customer->room_type_id=$request->room_type_id;
        $customer->room_name=$request->room_name;
        $customer->no_person=$request->no_person;
        $customer->floor=$request->floor;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
