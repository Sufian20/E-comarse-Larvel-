@extends('frontend.master');

@section('title')
  Wishlist | E Study Note
@endsection

@section('wishList') active @endsection

@section('content')
      <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Wishlist</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Wishlist</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="http://themepresss.com/tf/html/tohoney/cart">
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="stock">Stock Stutus </th>
                                    <th class="addcart">Add to Cart</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishList as $key => $item)
                                    <tr>
                                    <td class="images"><img src="{{asset('thumbnil/' .$item->product->product_thumbnil)}}" alt="{{$item->product->product_name}}"></td>
                                    <td class="product"><a href="single-product.html">{{$item->product->product_name}}</a></td>
                                    <td class="ptice">${{$item->product->product_price}}</td>
                                  
                                           
                                           
                         
                                             <td class="stock">In Stock</td>
                            
                                    <td class="addcart"><a href="{{route('SingelCart', $item->product->id)}}">Add to Cart</a></td>
                                    <td class="remove"><a href=" {{route('DeleteWishlist', $item->id)}} "><i class="fa fa-times"></i></a></td>
                                    
                                     </tr>
                                    
                             
                             @endforeach
                                
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->

@endsection