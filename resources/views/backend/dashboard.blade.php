@extends('backend.master')

@section('content')
<!-- Start Page content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row text-center">
                    <div class="col-sm-6 ">
                                <div class="card widget-flat border-success bg-success text-white">
                                    <div class="card-body">
                                        <i class="fe-tag"></i>
                                        <h3 class="text-white">{{$admins->count()}}</h3>
                                        <p class="text-uppercase font-13 mb-2 font-weight-bold">Total admin</p>
                                    </div>
                                </div>
                            </div>
                            @php

                              if(App\User::where('utype', 0)){
                                  $users = App\User::where('utype', 0);
                              }
                              

                            @endphp
                         <div class="col-sm-6 ">
                                <div class="card widget-flat border-info bg-warning text-white">
                                    <div class="card-body">
                                        <i class="fe-tag"></i>
                                        <h3 class="text-white">
                                       {{$users->count()}}
                                        </h3>
                                        <p class="text-uppercase font-13 mb-2 font-weight-bold">Total users</p>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="row" style=" margin-top: 30px;">
                        <div class="col-md-6">
                                <div class="card tilebox-one">
                                    <div class="card-body bg-info" style="box-shadow:0 0 35px 0 rgba(154,161,171,.15);">
                                        <i class="icon-paypal float-right text-muted h2 m-0"></i>
                                        <h6 class="text-muted text-uppercase mt-0" style="color:#fff;">Total Seals</h6>
                                        <h2>$<span data-plugin="counterup">{{$total_sales}}</span></h2>
                                        <span class="badge badge-danger"> -29% </span> <span class="text-muted">From previous period</span>
                                    </div>
                                </div>
                            </div>

                               <div class="col-sm-6 ">
                                <div class="card widget-flat border-info bg-danger text-white text-center">
                                    <div class="card-body">
                                        <i class="fe-tag"></i>
                                        <h3 class="text-white">
                                       {{$prodcut_categoris->count()}}
                                        </h3>
                                        <p class="text-uppercase font-13 mb-2 font-weight-bold">Category Product</p>
                                    </div>
                                </div>
                            </div>
                                <div class="col-sm-6 " style=" margin-top: 30px;">
                                <div class="card widget-flat border-info bg-dark text-white text-center">
                                    <div class="card-body">
                                        <i class="fe-tag"></i>
                                        <h3 class="text-white">
                                       {{$shipping_paid}}
                                        </h3>
                                        <p class="text-uppercase font-13 mb-2 font-weight-bold">Payment Paid</p>
                                    </div>
                                </div>
                            </div>
                              <div class="col-sm-6 " style=" margin-top: 30px;">
                                <div class="card widget-flat border-info bg-primary text-white text-center">
                                    <div class="card-body">
                                        <i class="fe-tag"></i>
                                        <h3 class="text-white">
                                       {{$shipping_pandding}}
                                        </h3>
                                        <p class="text-uppercase font-13 mb-2 font-weight-bold">Payment Pendig</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->

    </div> <!-- content -->

    @endsection
