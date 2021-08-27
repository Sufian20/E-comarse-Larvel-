<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\Rating;
use App\Sale;
use App\Shipping;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Generator\RandomLibAdapter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Dashboard()
    {
        if(User::where('utype', 1)){
            $admins = User::where('utype', 1);
        }

        $total_sales =  Sale::orderBy('id', 'asc')->sum('grand_total');

        $prodcut_categoris = Product::orderBy('id', 'asc')->get();

        $shipping_paid = Shipping::where('payment_status', 1)->count();
        
        $shipping_pandding = Shipping::where('payment_status', 2)->count();

        return view('backend.dashboard', compact('admins', 'total_sales', 'prodcut_categoris', 'shipping_paid', 'shipping_pandding'));
    }


    function CommentPost(Request $requsest){

        Comment::insert([
          'name' => $requsest->name,
          'email' => $requsest->email,
          'comment' => $requsest->comment,
          'blog_id' => $requsest->blog_id,
          'user_id' => Auth::id(),
          'created_at' => Carbon::now(),
        ]);
  
        return back();
      
    }

   
}
