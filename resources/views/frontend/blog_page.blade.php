@extends('frontend.master')

@section('title')
    Blog Page | E Stady Note
@endsection

@section('blog') active @endsection

@section('content')

     <!-- blog-area start -->
    <div class="blog-area">
        <div class="container">
            <div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Latest News</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
            <div class="row">
                @foreach($blog as $pro)
                    <div class="col-lg-4  col-md-6 col-12">
                    <div class="blog-wrap">
                        <div class="blog-image">
                            <img src="{{asset('blogs/'.$pro->feature_image)}}" alt="{{$pro->product_name}}" alt="">
                            <ul>
                                <li>{{ $pro->created_at->format('d')}}</li>
                                <li>{{ $pro->created_at->format('MM')}}</li>
                            </ul>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <ul>
                                    <li><a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name}}</a></li>
                                    <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i> {{ $pro->created_at->format('d/m/Y')}}</a></li>
                                </ul>
                            </div>
                            <h3><a href="{{route('BlogDetails', $pro->slug )}}">{{ $pro->title }}</a></h3>
                            <p>{{Illuminate\Support\Str::limit($pro->description,200) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="col-12">
                    <div class="pagination-wrapper text-center mb-30">
                        <ul class="page-numbers">
                            <li><a class="prev page-numbers" href="#"><i class="fa fa-arrow-left"></i></a></li>
                            <li><span class="page-numbers current">1</span></li>
                            <li><a class="page-numbers" href="#">2</a></li>
                            <li><a class="page-numbers" href="#">3</a></li>
                            <li><a class="next page-numbers" href="#"><i class="fa fa-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-area end -->

@endsection