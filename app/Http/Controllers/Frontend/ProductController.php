<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Frontend\FrontendController;
class ProductController extends FrontendController
{
    public function detail(Request $request){
        // session()->flush();
      
        // $cart=Cart::content()->where('options.user',session()->get('user'));
        // $total=Cart::total();
        // // Cart::destroy();
        // $countCart=$cart->count();
    //   dd(Cart::content()->toArray());
        $id=$request->id;
        $slug=$request->slug;
        $infProduct=Product::select('products.*','categories.name as categories_name','categories.slug as categories_slug')
        ->join('categories','products.categories_id','=','categories.id')
        ->where('products.id',$id)->first();
        if(!empty($infProduct)){
            $colorProduct=Color::select('colors.*')
                            ->join('product_color','colors.id','=','product_color.color_id')
                            ->where('product_id',$id)
                            ->get();
            $sizeProduct=Size::select('sizes.*')
            ->join('product_size','sizes.id','=','product_size.size_id')
            ->where('product_id',$id)
            ->get();
            $reletedProduct=Product::where('categories_id',$infProduct->categories_id,)
                                        ->where('id','!=',$id)
                                        ->skip(config('common.panigator.releted_product.skip'))
                                        ->take(config('common.panigator.releted_product.take'))
                                        ->get();
          
            $list_img=json_decode($infProduct->list_image);
            return view('frontend.product.detail',[
                'infoProduct'=>$infProduct,
                'list_images'=>$list_img,
                'colorProduct'=>$colorProduct,
                'sizeProduct'=>$sizeProduct,
                'reletedProduct'=>$reletedProduct
            ]);
        }else{
            return view('frontend.product.error');
        }
    }
}
