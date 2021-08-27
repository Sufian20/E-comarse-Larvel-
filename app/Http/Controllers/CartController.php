<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Cart;
use App\Coupon;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
   function Cart($coupon = ''){

    if($coupon == ''){

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = Cart::with('product')->where('user_ip', $user_ip)->get();
        $SubTotal = 0;
        $discount =0;
    
        foreach($carts as $value){
        $SubTotal  +=  $value->product->product_price * $value->product_quantity;
        }
        
        $after_discount = $SubTotal *  $discount / 100;
        session(['after_discount' => $after_discount]);
        


        return view('frontend.cart',[
          'carts' => $carts,
          'SubTotal' => $SubTotal,
          'discount' => $discount,
          'after_discount' => $after_discount
        ]);

    }

    else{
      
      if(Coupon::where('coupon_code',$coupon)->exists()){

        if(Carbon::now()->format('Y-m-d') <= Coupon::where('coupon_code', $coupon)->first()->coupon_validity){

          $user_ip = $_SERVER['REMOTE_ADDR'];
          $carts = Cart::with('product')->where('user_ip', $user_ip)->get();
          $SubTotal = 0;
          

          foreach($carts as $value){
            $SubTotal  +=  $value->product->product_price * $value->product_quantity;
            }

            $discount = Coupon::where('coupon_code', $coupon)->first()->coupon_discount;
            $after_discount = $SubTotal *  $discount / 100;

            session(['after_discount' => $after_discount]);
            session(['coupon_code' => $coupon]);

          return view('frontend.cart',[
            'carts' => $carts,
            'SubTotal' => $SubTotal,
            'discount' => $discount,
            'after_discount' => $after_discount,
            'coupon' =>  $coupon
          ]);

        }
        else{
          return back()->with('expired', 'Your Coupon is Expoerd!');
        }
        
      }
      else{
        return back()->with('expired', 'Your Coupon is Invalid!');
      }
      

    }

    
   }

   function SingelCart($slug){

      $user_ip = $_SERVER['REMOTE_ADDR'];

      if(Cart::where('product_id',$slug)->where('user_ip', $user_ip)->exists()){
          Cart::where('product_id',$slug)->where('user_ip', $user_ip)->increment('product_quantity');
      }

      else{
        Cart::insert([
            'product_id' => $slug,
            'user_ip' => $user_ip,
           'created_at' => Carbon::now(),
       ]);
      }



    return back();
   }

   function SingelCartDelete($id){

       $user_ip = $_SERVER['REMOTE_ADDR'];
       Cart::where('user_ip', $user_ip)->where('id', $id)->delete();

      return back()->with('message', 'Cart Product Deleted Succsesfully');
   }

   function CartUpdate(REQUEST $request){

     foreach($request->cart_id as $key => $item){
        Cart::findOrfail($item)->update([

          'product_quantity' => $request->quantity[$key],
          'updated_at' =>Carbon::now()
        ]);
     }

    return back()->with('message', 'Cart Product Updated Succsesfully');
   }

   function SingelProductCart(Request $request){

    $user_ip = $_SERVER['REMOTE_ADDR'];

    if(Cart::where('product_id',$request->product_id)->where('user_ip', $user_ip)->exists()){
        Cart::where('product_id',$request->product_id)->where('user_ip', $user_ip)->increment('product_quantity',$request->quantity);
    }

    else{
      Cart::insert([
          'product_id' => $request->product_id,
          'user_ip' => $user_ip,
          'product_quantity' => $request->quantity,
         'created_at' => Carbon::now(),
     ]);
    }

    return back();
   }
}
