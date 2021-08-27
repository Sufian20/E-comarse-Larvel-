@extends('layouts.master')

@section('bg')
      <!-- Begin page -->
        <div class="accountbg" style="background: url({{ asset('backend/images/bg-1.jpg') }});background-size: cover;background-position: center;"></div>
@endsection

@section('content')
<div class="container">
    
    
    <div class="card">
        <div class="card-block">

            <div class="account-box">

                <div class="card-box p-5">
                    <h2 class="text-uppercase text-center pb-4">
                        <a href="{{ route('frontpage') }}" class="text-success">
                        <span><img src="{{ asset('assets/images/logo.png')}}" alt="E Study Note" height="26"></span>
                        </a>
                    </h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="name">Full Name</label>
                                <input name="name" class="form-control  @error('name') is-invalid @enderror" type="text" id="name" required="" placeholder="Michael Zenaty">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="email">Email address</label>
                                <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" id="email" required="" placeholder="john@deo.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="password">Password</label>
                                <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" required="" id="password" placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="password_confirmation">Confrom Password</label>
                                <input class="form-control" required="" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">

                                <div class="checkbox checkbox-custom">
                                    <input id="remember" type="checkbox" checked="">
                                    <label for="remember">
                                        I accept <a href="#" class="text-custom">Terms and Conditions</a>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row text-center m-t-10">
                            <div class="col-12">
                                <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign Up Free</button>
                            </div>
                        </div>

                    </form>

                    <div class="row m-t-40">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">Already have an account?  <a href="{{ route('login')}}" class="text-dark m-l-5"><b>Sign In</b></a></p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    
</div>
    

@endsection
