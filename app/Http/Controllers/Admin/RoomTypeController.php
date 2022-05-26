<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MdRoomType;

class RoomTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=MdRoomType::get();
        return view('admin.room_type',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        return view('admin.room_type_add_edit');
    }

    public function Add(Request $request)
    {
        // return $request;
        MdRoomType::create(array(
            'type'=>$request->type,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.roomType');
    }

    public function ShowEdit($id)
    {
        $customer=MdRoomType::find($id);
        return view('admin.room_type_add_edit',['customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdRoomType::find($id);
        $customer->type=$request->type;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
