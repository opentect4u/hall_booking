<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdRoomRent};
use DB;

class RoomRentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show(Request $request)
    {
        // $datas=MdRoom::get();
        // $room_type=$request->room_type;
        // if ($room_type!='') {
        //     $datas=DB::table('md_room')
        //         ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
        //         ->leftJoin('md_location','md_location.id','=','md_room.location_id')
        //         ->select('md_room.*','md_room_type.type as room_type','md_location.location as location')
        //         ->where('md_room.room_type_id',$room_type)
        //         ->get();
        // }else{
            $datas=DB::table('md_room_rent')
                ->leftJoin('md_room_type','md_room_type.id','=','md_room_rent.room_type_id')
                ->leftJoin('md_location','md_location.id','=','md_room_rent.location_id')
                ->select('md_room_rent.*','md_room_type.type as room_type','md_location.location as location')
                ->get();
        // }
        // return $datas;
        // $room_types=MdRoomType::get();
        return view('admin.room_rent',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        // return $room_types;
        return view('admin.room_rent_add_edit',['room_types'=>$room_types,'locations'=>$locations]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdRoomRent::create(array(
            'effective_date'=>date('Y-m-d',strtotime($request->effective_date)),
            'room_type_id'=>$request->room_type_id,
            'location_id'=>$request->location_id,
            'book_flag'=>$request->book_flag,
            'normal_rate'=>$request->normal_rate,
            'discount_percentage'=>$request->discount_percentage,
            'cgst_rate'=>$request->cgst_rate,
            'sgst_rate'=>$request->sgst_rate,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.roomRent');
    }

    public function ShowEdit($id)
    {
        $customer=MdRoomRent::find($id);
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        return view('admin.room_rent_add_edit',['room_types'=>$room_types,'locations'=>$locations,'customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdRoomRent::find($id);
        $customer->effective_date=date('Y-m-d',strtotime($request->effective_date));
        $customer->room_type_id=$request->room_type_id;
        $customer->location_id=$request->location_id;
        $customer->book_flag=$request->book_flag;
        $customer->normal_rate=$request->normal_rate;
        $customer->discount_percentage=$request->discount_percentage;
        $customer->cgst_rate=$request->cgst_rate;
        $customer->sgst_rate=$request->sgst_rate;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
