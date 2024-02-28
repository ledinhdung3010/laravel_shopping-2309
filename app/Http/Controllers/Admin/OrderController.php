<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(){
        $order=Order::where('status','1')->orderBy('id','desc')->paginate(3);
        return view('admin.order.order_management',['orders'=>$order]);
    }
    public function  view(Request $request){
        $extrs_code=$request->id;
        $product=Product::select('products.*','order_details.color_name as color_name','order_details.size_name as size_name','order_details.quantity as qtyprice')
        ->join('order_details','order_details.product_id','=','products.id')
        ->where('order_details.order_id',function ($query) use ($extrs_code) {
            $query->select('id')->from('orders')->where('extrs_code', $extrs_code);
        })->get();
        return view('admin.order.view_order',['products'=>$product]);
        
    }
    public function accept(Request $request)
    {
        $extrs_code=$request->extrs_code;
        $id=$request->id;
        $order=Order::where('extrs_code',$extrs_code)->update(['status'=>2]);
        $quantity=Order_detail::where('order_id',$id)->get();
        foreach($quantity as $item){
           $update=Product::where('id',$item->product_id)->decrement('quantity',$item->quantity);
        }
        return redirect()->route('admin.order');
    }
    public function no_accept(Request $request){
        $extrs_code=$request->extrs_code;
        $content=$request->content;
        $order=Order::where('extrs_code',$extrs_code)->update(['status'=>3,'nots'=>$content]);
        return redirect()->route('admin.order');

    }
}
