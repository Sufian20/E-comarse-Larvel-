<?php

namespace App\Http\Controllers;

use App\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    //==================== VIEW SHIPPING ARE HERE ============

    public function ViewShpping(){

        $shippings = Shipping::with('user')->orderBy('id', 'asc')->paginate(10);
        return view('backend.shipping.view_shipping', compact('shippings'));
    }

    public function DeleteShpping($id){
        Shipping::findOrFail($id)->delete();

        return back()->with('success', 'Shipping Orders Deteted Successfully');
    }
}
