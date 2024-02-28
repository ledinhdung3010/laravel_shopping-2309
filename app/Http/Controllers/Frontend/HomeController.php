<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Frontend\FrontendController;
class HomeController extends FrontendController
{
    public function index(Request $request){
        // $cart=Cart::content()->where('options.user',session()->get('user'));
        // $total=Cart::total();
        // $countCart=$cart->count();
        $keyword=$request->query('s');
        $category=Category::all();
        $tag=Tag::where('type',config('common.type.tag_product'))->get();
        $color=Color::all();
        $products=Product::select('products.*','categories.name as category_name','categories.slug as category_slug')
        ->join('categories','products.categories_id','=','categories.id')
        ->where(function($query) use ($keyword){
            $query->where('products.name','like',"%{$keyword}%");
            $query->orwhere('products.description','like',"%{$keyword}%");
        });
       
        $formPrice=$request->from_price;
        $toPrice=$request->to_price;
       
        if(!empty($formPrice)&&isset($toPrice)){
            $formPrice=(int)$formPrice;
            $toPrice=(int)$toPrice;
            if($formPrice!=$toPrice){
                $products->whereBetween('price',[$formPrice,$toPrice]);
                
                
            }else{
                $products->where('price','>',$formPrice);
                
            }
            
        }
        $colorSlug=$request->color;
        
        if(isset($colorSlug)){
            $infColor=Color::where('slug',$colorSlug)->first();
            if($infColor!=null){
                $colorID=$infColor->id;
                $productColor=ProductColor::where('color_id',$colorID)->get();
                $arrProductId=[];
                if($productColor!=null){
                    $arrProductId=array_column($productColor->toArray(),'product_id');
                    $products->whereIn('products.id',$arrProductId);
                }
                
            }
        }
        $tagSlug=$request->tag;
        
        if(isset($tagSlug)){
            $infTag=Tag::where('slug',$tagSlug)->first();
            if($infTag!=null){
                $tagID=$infTag->id;
                $productTag=ProductTag::where('tag_id',$tagID)->get();
                $arrProductId=[];
                if($productTag!=null){
                    $arrProductId=array_column($productTag->toArray(),'product_id');
                    $products->whereIn('products.id',$arrProductId);
                }
                
            }
        }
        
        $dataProduct=$products->paginate(config('common.panigator.item_perpage'));
        return view('frontend.home.index',
        [
            'categories'=>$category,
            'products'=>$dataProduct,
            'keyword'=>$keyword,
            'tags'=>$tag,
            'colors'=>$color
        ]
    );
    }
}
