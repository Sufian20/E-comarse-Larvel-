@extends('frontend.master')

@section('content')
<div class="product-area">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Product '{{ $search }}' Search</h2>
                    <img src="{{ asset('/')}}assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            @foreach($products as $item)
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        <span>Sale</span>
                        <img src="{{ asset('thumbnil/'.$item->product_thumbnil)}}" alt="{{$item->product_name}}">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $item->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{route('AddWishlist',$item->id)}}"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{route('SingelCart',$item->id)}}"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content" id="item">
                        <h3><a href="{{route('SingelProduct',$item->slug)}}">{{$item->product_name}}</a></h3>
                        <p class="pull-left">${{$item->product_price}}

                        </p>
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </li>
            @endforeach
           
        </ul>
    </div>
</div>
@endsection
