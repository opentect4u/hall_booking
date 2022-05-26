<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MdRule,MdRoomType};
use DB;
class RulesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        // $datas=MdRule::get();
        $datas=DB::table('md_rules')
            ->leftJoin('md_room_type','md_room_type.id','=','md_rules.room_type_id')
            ->select('md_rules.*','md_room_type.type as room_type')
            ->get();
        return view('admin.rules',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        $room_types=MdRoomType::get();
        return view('admin.rules_add_edit',['room_types'=>$room_types]);
    }

    public function Add(Request $request)
    {
        // return $request;
        MdRule::create(array(
            'room_type_id'=>$request->room_type_id,
            'rules'=>$request->rules,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.rules');
    }

    public function ShowEdit($id)
    {
        $customer=MdRule::find($id);
        $room_types=MdRoomType::get();
        return view('admin.rules_add_edit',['room_types'=>$room_types,'customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdRule::find($id);
        $customer->room_type_id=$request->room_type_id;
        $customer->rules=$request->rules;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
