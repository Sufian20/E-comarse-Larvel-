<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class wishListController extends Controller
{
    //=============== ADD WISHLIST ARE HERE =============//

    function WishList(){

        $user_ip = $_SERVER['REMOTE_ADDR'];

        $wishList = Wishlist::with('product')->where('user_ip', $user_ip)->get();

        return view('frontend.wishList', compact('wishList'));
    }

    function AddWishlist($slug){

        $user_ip = $_SERVER['REMOTE_ADDR'];

        if(Wishlist::where('product_id', $slug)->where('user_ip', $user_ip)->exists()){
           return back();
        }

        else{
            Wishlist::insert([
                'product_id' => $slug,
                'user_ip' => $user_ip,
                'created_at' => Carbon::now(),
            ]);
        }

        return back();
    }


    //======= DELTE WISH LIEST ARE HERE ====///

    function DeleteWishlist($id){

        Wishlist::findOrfail($id)->delete();

        return back();
    }

}
