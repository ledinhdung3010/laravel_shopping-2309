<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\StorePostCustomerPayment;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\Order_detail;
class OderController extends FrontendController
{
    
    public function checkout(){
        if(Cart::count()==0){
            return redirect()->route('frontend.home');
        }
        return view('frontend.order.checkout');
    }
    public function payment(StorePostCustomerPayment $request)
    {
        if(Cart::count()!=0){
            $extrs_code=Str::random(80).time();
            $dataInfo=[
                'extrs_code'=>$extrs_code,
                'full_name'=>$request->full_name,
                'phone'=>$request->phone,
                'status'=>'1',
                'email'=>$request->email,
                'order_date'=>date('Y-m-d H:i:s'),
                'address'=>$request->address,
                'created_at'=>date('Y-m-d H:i:s')
            ];
            $insertOrder=Order::insertGetId($dataInfo);
            $dataProduct=[];
            foreach(Cart::content() as $item ){
                $dataProduct[]=[
                    'order_id'=>$insertOrder,
                    'product_id'=>$item->id,
                    'color_name'=>$item->options->color,
                    'size_name'=>$item->options->size,
                    'quantity'=>$item->qty,
                    'unitprice'=>$item->price,
                    'payment_type'=>1,
                    'status'=>1,
                    'nots'=>$request->nots,
                    'created_at'=>date('Y-m-d H:i:s')
                ];
            }
            $insert=Order_detail::insert($dataProduct);
            if($insert){
                Cart::destroy();
                // sang trang xem lai don hang vua dat
               
                return redirect()->route('frontend.order_detail',['extrs_code'=>$extrs_code]);
            }
        }
        return redirect()->back()->with('error_payment','payment invalid');
       

    }
    public function showorder(Request $request){
        $extrs_code=$request->extrs_code;
        $product=Product::select('products.*','order_details.color_name as color_name','order_details.size_name as size_name','order_details.quantity as qtyprice')
        ->join('order_details','order_details.product_id','=','products.id')
        ->where('order_details.order_id',function ($query) use ($extrs_code) {
            $query->select('id')->from('orders')->where('extrs_code', $extrs_code);
        })->get();
        $orders=Order::where('extrs_code',$extrs_code)->first();
        return view('frontend.order.order_detail',['products'=>$product,'orders'=>$orders]);
    }
    
}
