<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $keyword=$request->s;
        $category=Category::where('name','like',"%{$keyword}%")->get();
        return view('admin.category.index',['category'=>$category,'keyword'=>$keyword]);
    }
    public function delete(Request $request){
        $id=$request->id;
        $category=Category::find($id);
        if($category){
            $category->delete();
            return redirect()->route('admin.category')->with('delete_success', 'delete success');
        }
    }
    public function add(){
        return view('admin.category.add');
    }
    public function edit(Request $request){
        $id=$request->id;
        dd($id);
    }
}
