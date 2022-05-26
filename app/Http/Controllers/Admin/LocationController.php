<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MdLocation;

class LocationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=MdLocation::get();
        return view('admin.location',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        return view('admin.location_add_edit');
    }

    public function Add(Request $request)
    {
        // return $request;
        MdLocation::create(array(
            'location'=>$request->name,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.location');
    }

    public function ShowEdit($id)
    {
        $customer=MdLocation::find($id);
        return view('admin.location_add_edit',['customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdLocation::find($id);
        $customer->location=$request->name;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
