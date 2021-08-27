<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Product;
use App\Category;
use App\Comment;
use App\Rating;
use App\SubCategory;
use Illuminate\Support\Facades\App;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



use function GuzzleHttp\Promise\all;

class FrontendController extends Controller
{




  function index()
  {

    $products = Product::orderBy('id', 'desc')->get();

    if (Product::where('product_section_status', 1)) {
      $sliders = Product::orderBy('id', 'desc')->get();
    }

    if (Product::where('product_section_status', 2)) {
      $bSeller = Product::orderBy('id', 'desc')->limit(4)->get();
    }

    return view('frontend.main', [
      'products' => $products,
      'sliders' => $sliders,
      'bSeller' => $bSeller,
    ]);
  }

  function SingelProduct($slug)
  {


    $product =   Product::where('slug', $slug)->first();
    $ratings = Rating::where('product_id', $product->id)->get();
    if (!$ratings->count() == 0) {
      $sum = $ratings->sum('rating') / $ratings->count();
    } else {
      $sum = $ratings->sum('rating');
    }
    $products  = Product::orderBy('id', 'asc')->first();
    $related =  Product::where('categroy_id', $product->categroy_id)->get();
    $reviews = Rating::orderBy('id', 'desc')->get();




    return view('frontend.singel_product', [
      'product' => $product,
      'ratings' => $ratings,
      'products' => $products,
      'sum' => $sum,
      'related' => $related,
      'reviews' => $reviews,

    ]);
  }




  function shop()
  {

    return view('frontend.shop', [
      'categories' => Category::orderBy('category_name', 'asc')->get(),
      'products' => Product::with('category')->orderBy('product_name', 'asc')->get(),
    ]);
  }

  function SearchProduct(Request $request)
  {


    $sproduct = Product::whereBetween('product_price', [$request->start, $request->end])->get();

    return response()->json($sproduct);
    $categories = Category::orderBy('category_name', 'asc')->get();
    $products = Product::with('category')->orderBy('product_name', 'asc')->get();

    return view('frontend.shop', compact('sproduct', 'categories', 'products'));
  }


  function blog()
  {

    return view('frontend.blog_page', [
      'blogs'  =>  Category::orderBy('category_name', 'asc')->get(),
      'blog' => Blog::with('category')->orderBy('title', 'asc')->get(),
    ]);
  }

  function BlogDetails($slug)
  {
    $blog = Blog::with('user')->where('slug', $slug)->first();

    $recent_post = Blog::orderBy('id', 'desc')->limit(5)->get();

    $categoris = Category::orderBy('category_name', 'asc')->get();

    $admin = Blog::where('slug', $slug)
      ->join('users', 'blogs.user_id', 'users.id',)
      ->select('users.name', 'blogs.*')
      ->first();


    $comments = Comment::where('blog_id', $blog->id)->get();
    return view('frontend.blog_details', [
      'blog' => $blog,
      'recent_post' => $recent_post,
      'categoris' => $categoris,
      'comments' => $comments,
      'admin' => $admin,

    ]);
  }


  function PostProductRating(Request $request)
  {

    $request->validate([

      'rating' => ['required'],
      'name' => ['required'],
      'email' => ['required'],
      'reviews' => ['required'],

    ]);


    $user_id  = Auth::id();

    $exit = Rating::where('user_id', $user_id)->where('product_id', $request->product_id)->exists();

    if ($exit) {

      return back()->with('exists', 'You Allready Reviewed this Product.');
    } else {

      Rating::insert([

        'user_id' => $user_id,
        'product_id' => $request->product_id,
        'rating' => $request->rating,
        'name' => $request->name,
        'reviews' => $request->reviews,
        'email' => $request->email,
        'created_at' => Carbon::now(),

      ]);

      return back();
    }
      
  }

  public function search(Request $request){
    $search = $request->search;
    $products = Product::where('product_name', 'LIKE', "%{$search}%")->latest()->get();
    return view('frontend.search', compact('products','search'));
  }
}
