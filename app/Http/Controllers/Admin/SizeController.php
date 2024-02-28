<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizePostRequest;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(Request $request){
        $keyword=$request->s;
        $size=Size::where('name_letter','LIKE',"%{$keyword}%")->orderBy('id','desc')->get();
        return view('admin.size.index',[
            'sizes'=>$size,
            'keyword'=>$keyword
        ]);
    }
    public function add(){
        return view('admin.size.add');
    }
    public function create(SizePostRequest $request){
        $data=[
            'name_letter'=>$request->name_letter,
            'name_number'=>$request->name_number,
            'status'=>$request->status,
            'description'=>$request->description,
            'slug'=>strtolower($request->name_letter)
        ];
        $size=Size::insert($data);
        if($size){
            return redirect()->route('admin.size')->with('insert_success', 'insert success');
        }
    }
    public function edit(Request $request){
        $id=$request->id;
        $size=Size::find($id);
        return view('admin.size.edit',['sizes'=>$size]);
    }
    public function update(SizePostRequest $request){
        $id=$request->id;
        $data=[
            'name_letter'=>$request->name_letter,
            'name_number'=>$request->name_number,
            'status'=>$request->status,
            'description'=>$request->description,
            'slug'=>strtolower($request->name_letter)
        ];
        $size=Size::where('id',$id)->update($data);
        if($size){
            return redirect()->route('admin.size')->with('update_success', 'update thanh cong');
        }
    }
    public function delete(Request $request){
        $id=$request->id;
        $size=Size::find($id);
        if($size){
            $size->delete();
            return redirect()->route('admin.size')->with('delete_success', 'delete success');
        }
    }
}
