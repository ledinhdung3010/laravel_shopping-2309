<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    public function add(Request $request){
        $idPb=$request->id;
        $idPb=is_numeric($idPb)? $idPb :0;
        $product=Product::find($idPb);
        if($product!=null){
            $idColor=$request->idColor;
            $idSize=$request->idSize;
            $qty=$request->qty;
            $color=Color::find($idColor);
            $size=Size::find($idSize);
            $nameColor=$color->name ?? null;
            $nameSize=$size->name_letter ?? null;
            if($qty<=0||$qty>10){
                return response()->json([
                    'cod'=>401,
                    'mess'=>null,
                    'error'=>'Quantity > 0 and Quantity < 10'
                ]);
            }
            if($nameColor == null || $nameSize==null){
                return response()->json([
                    'cod'=>401,
                    'mess'=>null,
                    'error'=>'Choose Size and Color'
                ]);
            }
            $item1 = Cart::content()->where('id',$idPb)
                         ->where('options.color', $color)
                         ->where('options.size', $size)
                         ->first();
            if($item1){
                Cart::update($item1->rowId, ['qty' => $qty]);
                $lastCart=Cart::get($item1->rowId);
                return response()->json(
                    [
                        'cod'=>200,
                        'mess'=>'Add cart success',
                        'error'=>null,
                        'lastCart'=>$lastCart
                        
                    ]
                );
            }else{
                $item=Cart::add(
                    [
                        
                        'id' => $idPb,
                        'name' => $product->name,
                        'qty' => $qty,
                        'price' => $product->price,
                        'options' => [
                                    'size' => $nameSize,
                                    'color'=>$nameColor,
                                    'image'=>$product->image,
                                    'user'=>session()->get('user'),
                                    'slug'=>$product->slug
                                   
                        ]
                    ]
                );
                $item->tax=0;
                $cart=Cart::content()->where('options.user',session()->get('user'));
                $count=$cart->count();
                $total=Cart::total();
            return response()->json(
                [
                    'cod'=>200,
                    'mess'=>'Add cart success',
                    'error'=>null,
                    'count'=>$count,
                    'lastCart'=>$item,
                    'total'=>$total
                ]
            );
            }
               
                
            
        }
       
        return response()->json([
            'cod'=>500,
            'mess'=>null,
            'error'=>'Not found product'
        ]);
        
    }
    public function delete(Request $request){
        $id=$request->id;
        Cart::remove($id);
        $total=Cart::total();
        $cart=Cart::content()->where('options.user',session()->get('user'));
        $count=$cart->count();
        return response()->json([
            'total'=>$total,
            'count'=>$count
        ]);
    }
    public function detail(){
        $cart=Cart::content()->where('options.user',session()->get('user'));
        $total=Cart::total();
        $countCart=$cart->count();
        return view('frontend.cart.cartdetail',
            [
                'count'=>$countCart,
                'cart'=>$cart,
                'total'=>$total
            ]
        );
    }
    public function editdetail(Request $request){
        $id=$request->id;
        $num=$request->num;
        if($num!=0){
            Cart::update($id,
                [
                    'qty'=>$num
                ]
                );
            $cart=Cart::get($id);
            $total=Cart::total();
            $contentCart=Cart::content()->where('options.user',session()->get('user'));
            $count=$contentCart->count();
            return response()->json([
                'subtotal'=>$cart->subtotal,
                'price'=>$cart->price,
                'qty'=>$cart->qty,
                'data_id'=>$cart->id.''.$cart->options->size.''.$cart->options->color,
                'total'=>$total,
                'count'=>$count
    
            ]);
        }else{
            Cart::remove($id);
            $total=Cart::total();
            $cart=Cart::content()->where('options.user',session()->get('user'));
            $count=$cart->count();
            return response()->json([
                'total'=>$total,
                'count'=>$count
    
            ]);
        }
        
    }
}
