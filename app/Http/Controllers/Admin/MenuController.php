<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MdMenu;

class MenuController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=MdMenu::get();
        return view('admin.canteen_menu',['datas'=>$datas]);
    }

    public function ShowAdd(Request $request)
    {
        return view('admin.canteen_menu_add_edit');
    }
    public function Add(Request $request)
    {
        // return $request;
        MdMenu::create(array(
            'item_name'=>$request->item_name,
            'price'=>$request->price,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.canteenMenu');
    }

    public function ShowEdit($id)
    {
        $customer=MdMenu::find($id);
        return view('admin.canteen_menu_add_edit',['customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdMenu::find($id);
        $customer->item_name=$request->item_name;
        $customer->price=$request->price;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
