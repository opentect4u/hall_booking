<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MdMenu;
use App\Models\MdMenuCategory;
use DB;

class MenuController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        // $datas=MdMenu::get();
        $datas=DB::table('md_menu')
            ->leftJoin('md_menu_category','md_menu_category.id','=','md_menu.menu_category_id')
            ->select('md_menu.*','md_menu_category.name as category_name')
            ->get();
        return view('admin.canteen_menu',['datas'=>$datas]);
    }

    public function ShowAdd(Request $request)
    {
        $menu_category=MdMenuCategory::get();
        return view('admin.canteen_menu_add_edit',['menu_category'=>$menu_category]);
    }
    public function Add(Request $request)
    {
        // return $request;
        MdMenu::create(array(
            'menu_category_id'=>$request->menu_category_id,
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
