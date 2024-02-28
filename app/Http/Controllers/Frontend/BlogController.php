<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Order;


class BlogController extends FrontendController
{
    public function index(){
        $category=Category::All();
        $tag=Tag::all();
        $results = Order::select('products.id', 'products.name', 'products.categories_id', 'products.image', 'products.price','products.slug')
    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
    ->join('products', 'products.id', '=', 'order_details.product_id')
    ->where('orders.status', 2)
    ->groupBy('product_id','products.id', 'products.name', 'products.categories_id', 'products.image', 'products.price','products.slug')
    ->havingRaw('SUM(order_details.quantity) > 10')
    ->get();
        return view('frontend.blog.index',['categories'=>$category,'tags'=>$tag,'products'=>$results]);
    }
}
