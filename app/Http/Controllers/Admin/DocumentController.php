<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MdDocument;

class DocumentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Show()
    {
        $datas=MdDocument::get();
        return view('admin.document',['datas'=>$datas]);
    }

    public function ShowAdd()
    {
        return view('admin.document_add_edit');
    }

    public function Add(Request $request)
    {
        // return $request;
        MdDocument::create(array(
            'document'=>$request->document,
            'created_by'=>auth()->user()->id,
        ));
        return redirect()->route('admin.document');
    }

    public function ShowEdit($id)
    {
        $customer=MdDocument::find($id);
        return view('admin.document_add_edit',['customer'=>$customer]);
    }

    public function Edit(Request $request)
    {
        // return $request;
        $id=$request->id;
        $customer=MdDocument::find($id);
        $customer->document=$request->document;
        $customer->updated_by=auth()->user()->id;
        $customer->save();
        return redirect()->back()->with('update','update');
    }
}
