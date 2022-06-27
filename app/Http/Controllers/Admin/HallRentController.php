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
                ->leftJoin('md_room','md_room.id','=','md_hall_rent.room_id')
                ->select('md_hall_rent.*','md_room_type.type as room_type','md_location.location as location',
                'md_room.room_no as hall_no')
                ->get();
        
        // return $datas;
        $room_types=MdRoomType::get();
        return view('admin.hall_rent',['datas'=>$datas,'room_types'=>$room_types]);
    }

    public function ShowAdd()
    {
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        $rooms=DB::table('md_room')
            ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
            ->select('md_room.*','md_room_type.type as room_type')
            ->where('md_room_type.code','H')
            ->get();
        // return $rooms;
        return view('admin.hall_rent_add_edit',['room_types'=>$room_types,'locations'=>$locations,
            'rooms'=>$rooms
        ]);
    }

    public function HallNoAjax(Request $request)
    {
        $location_id=$request->location_id;
        $room_type_id=$request->room_type_id;
        $select_room_id=$request->select_room_id;
        $rooms=DB::table('md_room')
            ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
            ->select('md_room.*','md_room_type.type as room_type')
            ->where('md_room.location_id',$location_id)
            ->where('md_room.room_type_id',$room_type_id)
            ->where('md_room_type.code','H')
            ->get();

        return view('admin.hall_no_ajax',['rooms'=>$rooms,'select_room_id'=>$select_room_id]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdHallRent::create(array(
            'effective_date'=>date('Y-m-d',strtotime($request->effective_date)),
            'location_id'=>$request->location_id,
            'room_type_id'=>$request->room_type_id,
            'book_flag'=>$request->book_flag,
            'room_id'=>$request->room_id,
            'normal_rate'=>$request->normal_rate,
            'holiday_rate'=>$request->holiday_rate,
            'caution_money'=>$request->caution_money,
            'cgst_rate'=>$request->cgst_rate,
            'sgst_rate'=>$request->sgst_rate,
            'check_in_time'=>$request->check_in_time,
            'period'=>$request->period,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.hallRent');
    }

    public function ShowEdit($id)
    {
        $customer=MdHallRent::find($id);
        $room_types=MdRoomType::get();
        $locations=MdLocation::get();
        $rooms=DB::table('md_room')
            ->leftJoin('md_room_type','md_room_type.id','=','md_room.room_type_id')
            ->select('md_room.*','md_room_type.type as room_type')
            ->where('md_room_type.code','H')
            ->get();
        return view('admin.hall_rent_add_edit',['room_types'=>$room_types,'locations'=>$locations,
            'customer'=>$customer,'rooms'=>$rooms
        ]);
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
        $customer->room_id=$request->room_id;
        $customer->normal_rate=$request->normal_rate;
        $customer->holiday_rate=$request->holiday_rate;
        $customer->caution_money=$request->caution_money;
        $customer->cgst_rate=$request->cgst_rate;
        $customer->sgst_rate=$request->sgst_rate;
        $customer->check_in_time=$request->check_in_time;
        $customer->period=$request->period;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
