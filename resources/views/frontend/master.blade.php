<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Hello')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/')}}assets/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/bootstrap.min.css">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/owl.carousel.min.css">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/font-awesome.min.css">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/flaticon.css">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/jquery-ui.css">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/metisMenu.min.css">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/swiper.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/styles.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="{{ asset('/')}}assets/js/vendor/modernizr-2.8.3.min.js"></script>
    @yield('header_css')
</head>

<body>
    <!--Start Preloader-->
    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>
    <!-- search-form here -->
    <div class="search-area flex-style">
        <span class="closebar">Close</span>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="search-form">
                        <form action="{{ route('search')}}" method="GET">
                            @csrf
                            <input type="text" name="search" id="myInput" placeholder="Search Here...">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search-form here -->
    <!-- header-area start -->
    <header class="header-area">
        <div class="header-top bg-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="d-flex header-contact">
                            <li><i class="fa fa-phone"></i> +01 123 456 789</li>
                            <li><i class="fa fa-envelope"></i> youremail@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="d-flex account_login-area">
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">wishlist</a></li>
                                </ul>
                            </li>
                            @auth
                            @if(auth()->user()->utype == 1)
                            <li><a href="{{ route('Dashboard') }}"> Dashboard </a></li>
                            @else
                            <li><a href="#"> Profile </a></li>
                            @endif
                            @else
                            <li><a href="{{ route('login') }}"> Login/Register </a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                        <div class="logo">
                            <a href="{{route('frontpage')}}">
                                <img src="{{ asset('/')}}assets/images/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="mainmenu">
                            <ul class="d-flex">
                                <li class=" @yield('home-active') "><a href="{{route('frontpage')}}">Home</a></li>

                                <li class=" @yield('shop') ">
                                    <a href="{{route('shop')}}">Shop</a>

                                </li>
                                <li class=" @yield('cart') "><a href="{{route('Cart')}}">Cart</a></li>

                                <li class="@yield('wishList')"><a href="{{route('WishList')}}">Wishlist</a></li>
                                <li class="@yield('blog')">
                                    <a href="javascript:void(0);">Blog <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        <li><a href="{{ route('blog') }}">blog Page</a></li>
                                        <li><a href="blog-details.html">blog Details</a></li>
                                    </ul>
                                </li>
                                <li class="@yield('contact')"><a href="{{route('Contact')}}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                        <ul class="search-cart-wrapper d-flex">
                            <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                            <li>
                                @php
                                $user_ip = $_SERVER['REMOTE_ADDR'];
                                $carts = \App\Cart::where('user_ip', $user_ip)->get();
                                //$carts = \App\Cart::where('user_ip', $user_ip)->get();
                                $s_total = 0;
                                $wishList = \App\Wishlist::where('user_ip', $user_ip)->get();
                                @endphp
                                <a href="javascript:void(0);"><i class="flaticon-like"></i> <span>{{$wishList->count()}}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    @foreach($wishList as $key => $item)
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img style="height: 50px" src="{{ asset('thumbnil/'.$item->product->product_thumbnil)}}" alt="{{$item->product->product_name}}">
                                        </div>
                                        @php
                                        $s_total += $item->product->product_price * $item->product_quantity;
                                        @endphp
                                        <div class="cart-content">
                                            <a href="{{'cart'}}">{{$item->product->product_name}}</a>
                                            <span>QTY : {{$item->product_quantity}}</span>
                                            <p>${{$item->product->product_price * $item->product_quantity}}</p>
                                            <a href="{{route('DeleteWishlist', $item->id)}}"> <i class="fa fa-times"></i></a>
                                        </div>
                                    </li>
                                    @endforeach

                                    <li>Subtotol: <span class="pull-right">${{$s_total}}</span></li>
                                    <li>
                                        <a href="{{ route('Checkout') }}"><button>Check Out</button></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>{{$carts->count()}}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    @foreach ($carts as $item)
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img style="height: 50px" src="{{ asset('thumbnil/'.$item->product->product_thumbnil)}}" alt="{{$item->product->product_name}}">
                                        </div>
                                        @php
                                        $s_total = $item->product->product_price * $item->product_quantity;


                                        @endphp
                                        <div class="cart-content">
                                            <a href="{{'cart'}}">{{$item->product->product_name}}</a>
                                            <span>QTY : {{$item->product_quantity}}</span>
                                            <p>${{$item->product->product_price * $item->product_quantity}}</p>
                                            <a href="{{route('SingelCartDelete', $item->id)}} "> <i class="fa fa-times"></i> </a>
                                        </div>
                                    </li>
                                    @endforeach
                                    <li>Subtotol: <span class="pull-right">${{$s_total}}</span></li>
                                    <li>
                                        <a href="{{ route('Checkout') }}"><button>Check Out</button></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                        <div class="responsive-menu-tigger">
                            <a href="javascript:void(0);">
                                <span class="first"></span>
                                <span class="second"></span>
                                <span class="third"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
            <div class="responsive-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-block d-lg-none">
                            <ul class="metismenu">
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li><a href="{{route('shop')}}">Shop</a></li>
                                <li><a href="about.html">About</a></li>
                                <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
                                    <ul aria-expanded="false">
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->
    @yield('content')
    <!-- start social-newsletter-section -->
    <section class="social-newsletter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <div class="newsletter text-center">
                        <h3>Subscribe Newsletter</h3>
                        <div class="newsletter-form">

                            <form action="{{route('Newsletter')}}" method="post">
                                @csrf
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address...">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end social-newsletter-section -->
    <!-- .footer-area start -->
    <div class="footer-area">
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-item">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="footer-top-text text-center">
                                <ul>
                                    <li><a href="home.html">home</a></li>
                                    <li><a href="#">our story</a></li>
                                    <li><a href="#">feed shop</a></li>
                                    <li><a href="blog.html">how to eat blog</a></li>
                                    <li><a href="contact.html">contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="footer-icon">
                            <ul class="d-flex">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-12">
                        <div class="footer-content">
                            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure righteous indignation and dislike</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-8 col-sm-12">
                        <div class="footer-adress">
                            <ul>
                                <li><a href="#"><span>Email:</span> domain@gmail.com</a></li>
                                <li><a href="#"><span>Tel:</span> 0131234567</a></li>
                                <li><a href="#"><span>Adress:</span> 52 Web Bangale , Adress line2 , ip:3105</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="footer-reserved">
                            <ul>
                                <li>Copyright © 2019 Tohoney All rights reserved.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer-area end -->
    <!-- jquery latest version -->
    <script src="{{ asset('/')}}assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('/')}}assets/js/bootstrap.min.js"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="{{ asset('/')}}assets/js/owl.carousel.min.js"></script>
    <!-- scrollup.js -->
    <script src="{{ asset('/')}}assets/js/scrollup.js"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="{{ asset('/')}}assets/js/isotope.pkgd.min.js"></script>
    <!-- imagesloaded.pkgd.min.js -->
    <script src="{{ asset('/')}}assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- jquery.zoom.min.js -->
    <script src="{{ asset('/')}}assets/js/jquery.zoom.min.js"></script>
    <!-- countdown.js -->
    <script src="{{ asset('/')}}assets/js/countdown.js"></script>
    <!-- swiper.min.js -->
    <script src="{{ asset('/')}}assets/js/swiper.min.js"></script>
    <!-- metisMenu.min.js -->
    <script src="{{ asset('/')}}assets/js/metisMenu.min.js"></script>
    <!-- mailchimp.js -->
    <script src="{{ asset('/')}}assets/js/mailchimp.js"></script>
    <!-- jquery-ui.min.js -->
    <script src="{{ asset('/')}}assets/js/jquery-ui.min.js"></script>
    <!-- main js -->
    <script src="{{ asset('/')}}assets/js/scripts.js"></script>

    @yield('footer_js')

    <script>
        function myFunction() {
            // Declare variables
            var input, filter, item, h3, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            item = document.getElementById("item");
            h3 = table.getElementsByTagName("h3");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < h3.length; i++) {
                a = h3[i].getElementsByTagName("a")[0];
                if (a) {
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        h3[i].style.display = "";
                    } else {
                        h3[i].style.display = "none";
                    }
                }
            }
        }

    </script>


</body>


<!-- Mirrored from themepresss.com/tf/html/tohoney/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Mar 2020 03:33:34 GMT -->
</html>
