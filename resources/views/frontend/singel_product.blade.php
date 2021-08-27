@extends('frontend.master')

@section('title')
 {{ $product->product_name }} | E Study Note
@endsection

@section('content')

<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shop Page</h2>
                    <ul>
                        <li><a href="{{'/'}}">Home</a></li>
                        <li><span>Shop</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- single-product-area start-->
<div class="single-product-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-single-img">
                    <div class="product-active owl-carousel">
                        <div class="item">
                            <img src="{{ asset('thumbnil/'.$product->product_thumbnil)}}" alt="">
                        </div>
                        @foreach (App\ProductImage::where('product_id', $product->id)->get() as $gallery)
                        <div class="item">
                            <img src="{{asset('product/gallery' . '/' .$gallery->product_image)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                    <div class="product-thumbnil-active  owl-carousel">
                        <div class="item">
                            <img src="{{ asset('thumbnil/'.$product->product_thumbnil)}}" alt="">
                        </div>
                        @foreach (App\ProductImage::where('product_id', $product->id)->get() as $gallery)
                        <div class="item">
                            <img src="{{asset('product/gallery' . '/' .$gallery->product_image)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="product-single-content">
                    <h3>{{$product->product_name}}</h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">${{$product->product_price}}</span>
                        <ul class="rating pull-right">
                        @for($i = 0; $i < 5; $i++)
                            <div class="star-rating pull-left">
                                <i class=" @if($i < $sum)fa fa-star @else fa fa-star-o @endif "></i>
                            </div>
                        @endfor
                        {{-- @for ($i = 0; $i < 5; $i++) 
                            
                            <li class="pull-left"><i class="fa @if($i < $sum)fa-star @elseif($i < $sum ) fa-star-half-o @else fa-star-o @endif"></i></li>
                        @endfor --}}
                        {{--
                             <li class="pull-left">
                            @foreach(range(1,5) as $i)
                                    @if($sum > 0)
                                        @if($sum > 0.5)
                                            <i class="fa fa-star-half-o"></i>
                                        @else
                                            <i class="fa fa-star"></i>
                                        @endif
                                    @endif
                                    @php $sum++ @endphp
                            @endforeach
                            </li>
                        --}}
                        
                             <li>({{$ratings->count()}} Customar Review)</li>
                        </ul>
                    </div>
                    <style>
                        .star-rating{
                           
                                color:orange;
                          
                        }
                        .sc-btn {
                            height: 35px;
                            line-height: 35px;
                            text-align: center;
                            width: 120px;
                            background: #ef4836;
                            color: #fff;
                            display: block;
                            margin-left: 30px;
                            border: none;
                        }

                        .sc-btn:hover {
                            background: #333333;
                        }

                    </style>

                    <p>{{$product->product_summary}}</p>
                    <form action="{{ route('SingelProductCart') }}" method="post">
                        @csrf
                        <ul class="input-style">
                        
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <li class="quantity cart-plus-minus">
                                <input type="text" name="quantity" value="1" />
                            </li>
                            <li><input class="sc-btn" type="submit" value="Add to Cart"></li>
                        </ul>
                    </form>
                    <ul class="cetagory">
                        <li>Categories:</li>
                        <li><a href="#">{{$product->category->category_name}}</a></li>
                    </ul>
                    <ul class="socil-icon">
                        <li>Share :</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-12">
                <div class="single-product-menu">
                    <ul class="nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                        <li><a data-toggle="tab" href="#tag">Faq</a></li>
                        <li><a data-toggle="tab" href="#review">Review</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <div class="description-wrap">
                            <p>{!! nl2br($product->product_description) !!}</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="tag">
                        <div class="faq-wrap" id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">General Inquiries ?</button> </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery ?</button></h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingfour">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">Additional Information ?</button></h5>
                                </div>
                                <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingfive">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button></h5>
                                </div>
                                <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="review">
                        <div class="review-wrap">
                            <ul>
                                @foreach($reviews as $item)
                                    <li class="review-items">
                                    <div class="review-img">
                                        <img src="assets/images/comment/1.png" alt="">
                                    </div>
                                    <div class="review-content">
                                        <h3><a href="#">{{$item->name}}</a></h3>
                                        
                                        <span>{{$item->created_at->format('d M Y')}} at {{ $item->created_at->format('h i A')}}</span>
                                        </p>{{$item->reviews}}</p>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                               
                            </ul>
                        </div>
                        @if(Auth::user())


                        @if(session('exists'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Sorry!</strong> {{session('exists')}}.
                        </div>
                        @endif
                        <div class="add-review">
                            <h4>Add A Review</h4>
                            <div class="ratting-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>task</th>
                                            <th>1 Star</th>
                                            <th>2 Star</th>
                                            <th>3 Star</th>
                                            <th>4 Star</th>
                                            <th>5 Star</th>
                                        </tr>
                                    </thead>
                                    <form role="form" action="{{route('PostProductRating')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id">
                                        <tbody>
                                            <tr>
                                                <td>How Many Stars?</td>
                                                <td>
                                                    <input type="radio" value="1" name="rating" />
                                                </td>
                                                <td>
                                                    <input type="radio" value="2" name="rating" />
                                                </td>
                                                <td>
                                                    <input type="radio" value="3" name="rating" />
                                                </td>
                                                <td>
                                                    <input type="radio" value="4" name="rating" />
                                                </td>
                                                <td>
                                                    <input type="radio" value="5" name="rating" />
                                                </td>
                                            </tr>
                                        </tbody>

                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <input type="hidden" name="product_id" value="{{$products->id}}">
                                    <h4>Name:</h4>
                                    <input type="text" name="name" required="required" placeholder="Your name here..." />
                                </div>
                                <div class="col-md-6 col-12">
                                    <h4>Email:</h4>
                                    <input type="email" name="email" required="required" placeholder="Your Email here..." />
                                </div>
                                <div class="col-12">
                                    <h4>Your Review:</h4>
                                    <textarea name="reviews" required="required" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn-style" type="submit">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        @else
                        <br>
                        <h4>Please <a href="{{ route('login') }}" style="color:#f7941d;">Login</a> to Review</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- single-product-area end-->

    
<!-- featured-product-area start -->
<div class="featured-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-left">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($related as  $item)
                <div class="col-lg-3 col-sm-6 col-12">
                <div class="featured-product-wrap">
                    <div class="featured-product-img">
                        <img src="{{ asset('thumbnil/'.$product->product_thumbnil)}}" alt="{{$item->product_name }}">
                    </div>
                    <div class="featured-product-content">
                        <div class="row">
                            <div class="col-7">
                                <h3><a href="{{route('shop')}}">{{$item->product_name }}</a></h3>
                                <p>${{$item->product_price}}</p>
                            </div>
                            <div class="col-5 text-right">
                                <ul>
                                    <li><a href="{{route('SingelCart', $item->id )}}"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="{{route('AddWishlist', $item->id )}}"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
<!-- featured-product-area end -->
<!-- start social-newsletter-section -->

<!-- end social-newsletter-section -->

@endsection
