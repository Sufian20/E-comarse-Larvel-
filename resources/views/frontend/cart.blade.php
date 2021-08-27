@extends('frontend.master')

@section('title')
    Card Page | Study Note
@endsection

@section('cart') active @endsection

@section('content')

 <!-- .breadcumb-area start -->
 <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Shopping Cart</span></li>
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
            @if (session('message'))
                <div class="alert alert-primary">
                    <span>{{ session('message') }}</span>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('CartUpdate') }}" method="post">
                      @csrf
                        <table class="table-responsive cart-wrap" style="display: table">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carts as $cart)
                                <tr>
                                     <input type="hidden" name="cart_id[]" value="{{$cart->id}}">
                                    <td class="images"><img src="{{asset('thumbnil/' .$cart->product->product_thumbnil)}}" alt="{{$cart->product->product_name}}"></td>
                                        <td class="product"><a target="_blank" href="{{route('SingelProduct', $cart->product->slug)}}">{{$cart->product->product_name}}</a></td>
                                        <td class="ptice">${{ $cart->product->product_price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" name="quantity[]" value="{{$cart->product_quantity}}" />
                                        </td>
                                        <td class="total">${{$cart->product->product_price * $cart->product_quantity}}</td>
                                        <td class="remove"><a href=" {{route('SingelCartDelete', $cart->id)}} "><i class="fa fa-times"></i></a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50">No Cart Data Available</td>
                                    </tr>
                                @endforelse ($carts as $cart)
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{route('shop')}}">Continue Shopping</a></li>
                                    </ul>
                      </form>
                        <style>
                            span.coupon-click{
                                width: 150px;
                                height: 45px;
                                position: absolute;
                                right: 0;
                                top: 0;
                                background: #ef4836;
                                color: #fff;
                                text-transform: uppercase;
                                border: none;
                                padding: 10px;
                                text-align: center;
                                cursor: pointer;
                            }
                            span.coupon-click:hover{
                                background: #333333;
                            }
                        </style>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    @if (session('expired'))
                                        <div class="alert alert-danger">
                                          {{  session('expired') }}
                                        </div>
                                    @endif
                                    <div class="cupon-wrap">
                                        <input type="text" id="coupon_code" value="{{ $coupon ?? ""}}" placeholder="Coupon Code">
                                        <span class="coupon-click">Apply Coupon</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>${{$SubTotal}}</li>
                                    <li><span class="pull-left">Discountt({{ $discount }}%) </span>${{ $after_discount }}</li>
                                        <li><span class="pull-left"> Total </span> ${{ $SubTotal - $after_discount }}</li>
                                    </ul>
                                    <a href="{{ route('Checkout') }}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
    

@endsection

@section('footer_js')
    <script>
        $(document).ready(function () {
            $('.coupon-click').click(function (){
               let coupon = $('#coupon_code').val();

               window.location.href = "{{url('cart')}}/"+  coupon;
            })
        })
    </script>
@endsection