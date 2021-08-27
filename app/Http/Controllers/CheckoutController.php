<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Country;
use App\State;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function getState($id){

        $states = State::where('country_id', $id)->orderBy('name', 'asc')->get();
        return response()->json($states);
    }

    function getCity($id){

        $cities = City::where('state_id', $id)->orderBy('name', 'asc')->get();
        return response()->json($cities);
    }

    function Checkout(Request $request){

        $countries = Country::orderBy('name', 'asc')->get();

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = Cart::with('product')->where('user_ip', $user_ip)->get();
        
        $SubTotal = 0;
        

        foreach($carts as $value){
          $SubTotal  +=  $value->product->product_price * $value->product_quantity;
          }

          $after_discount = $request->session()->get('after_discount');
          $total = $SubTotal - $after_discount;
          
          session(['total' => $total]);
        return view('frontend.checkout',[
            'carts' => $carts,
            'SubTotal' => $SubTotal,
            'after_discount' => $after_discount,
            'total' => $total,
            'countries' => $countries
        ]);
    }
}
