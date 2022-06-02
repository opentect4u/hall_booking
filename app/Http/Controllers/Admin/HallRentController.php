<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType,MdRoom,MdLocation,MdHallRent};
use DB;

class HallRentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show(Request $request)
    {
            $datas=DB::table('md_hall_rent')
                ->leftJoin('md_room_type','md_room_type.id','=','md_hall_rent.room_type_id')
                ->leftJoin('md_location','md_location.id','=','md_hall_rent.location_id')
                ->select('md_hall_rent.*','md_room_type.type as room_type','md_location.location as location')
                ->get();
        
        // return $datas;
        $room_types=MdRoomType::get();
        return view('admin.hall_rent',['datas'=>$datas,'room_types'=>$room_types]);
    }

    public function ShowAdd()
    {
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        // return $room_types;
        return view('admin.hall_rent_add_edit',['room_types'=>$room_types,'locations'=>$locations]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdHallRent::create(array(
            'effective_date'=>date('Y-m-d',strtotime($request->effective_date)),
            'location_id'=>$request->location_id,
            'room_type_id'=>$request->room_type_id,
            'book_flag'=>$request->book_flag,
            'hall_no'=>$request->hall_no,
            'normal_rate'=>$request->normal_rate,
            'holiday_rate'=>$request->holiday_rate,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.hallRent');
    }

    public function ShowEdit($id)
    {
        $customer=MdHallRent::find($id);
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        return view('admin.hall_rent_add_edit',['room_types'=>$room_types,'locations'=>$locations,'customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdHallRent::find($id);
        $customer->effective_date=date('Y-m-d',strtotime($request->effective_date));
        $customer->location_id=$request->location_id;
        $customer->room_type_id=$request->room_type_id;
        $customer->book_flag=$request->book_flag;
        $customer->hall_no=$request->hall_no;
        $customer->normal_rate=$request->normal_rate;
        $customer->holiday_rate=$request->holiday_rate;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
