<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorPostRequest;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index(Request $request){
        $keyword=$request->s;
        $color=Color::where('name', 'LIKE', "%{$keyword}%")->orderBy('id','desc')->get();
        return view('admin.color.index',['colors'=>$color,'keyword'=>$keyword] );
    }
    public function add(){
        return view('admin.color.add');
    }
    public function create(ColorPostRequest $request){
        $data=[
            'name'=>$request->name,
            'status'=>$request->status,
            'code'=>$request->color,
            'description'=>$request->description,
            'slug'=>strtolower($request->name)
        ];
        Color::insert($data);
        return redirect()->route('admin.color')->with('insert_success', 'insert success');

    }
    public function delete(Request $request){
        $colorId=$request->id;
        $color=Color::find($colorId);
        if(!empty($color)){
            $color->delete();
            return redirect()->route('admin.color')->with('delete_success', 'delete success');
        }
    }
    public function edit(Request $request){
        $id=$request->id;
        $color=Color::find($id);
        return view('admin.color.edit',[
            'color'=>$color
        ]);
    }
    public function update(ColorPostRequest $request){
        $id=$request->id;
        $data=[
            'name'=>$request->name,
            'code'=>$request->color,
            'status'=>$request->status,
            'description'=>$request->description,
            'slug'=>strtolower($request->name)
        ];
        $color=Color::where('id',$id)->update($data);
        if($color){
            return redirect()->route('admin.color')->with('update_success', 'update thanh cong');
        }
    }
}
