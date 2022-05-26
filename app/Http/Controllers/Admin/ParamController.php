<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MdParam;

class ParamController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=MdParam::get();
        return view('admin.params',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        return view('admin.params_add_edit');
    }

    public function Add(Request $request)
    {
        // return $request;
        MdParam::create(array(
            'description'=>$request->description,
            'value'=>$request->value,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.params');
    }

    public function ShowEdit($id)
    {
        $customer=MdParam::find($id);
        return view('admin.params_add_edit',['customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdParam::find($id);
        $customer->description=$request->description;
        $customer->value=$request->value;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
