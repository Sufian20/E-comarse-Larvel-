@extends('layouts.master')

@section('bg')
      <!-- Begin page -->
        <div class="accountbg" style="background: url({{ asset('backend/images/bg-2.jpg') }});background-size: cover;background-position: center;"></div>
@endsection


@section('content')
<div class="container">
    <div class="card-body">
        <div class="card-box p-5">
            <h2 class="text-uppercase text-center pb-4">
                <a href="{{ route('frontpage') }}" class="text-success">
                    <span><img src="{{ asset('assets/images/logo.png') }}" alt="" height="26"></span>
                </a>
            </h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group m-b-20 row">
                    <div class="col-12">
                        <label for="email">Email address</label>
                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" id="email"  placeholder="Enter your email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>

                <div class="form-group row m-b-20">
                    <div class="col-12">
                        @if (Route::has('password.request'))
                            <a class="text-muted float-right" href="{{ route('password.request') }}">
                                <small>{{ __('Forgot Your Password?') }}</small>
                            </a>
                        @endif
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

                        <div class="checkbox checkbox-custom">
                            <input id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group row text-center m-t-10">
                    <div class="col-12">
                        <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign In</button>
                    </div>
                </div>

            </form>

            <div class="row m-t-50">
                <div class="col-sm-12 text-center">
                    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                </div>
            </div>

            <div class="form-group row text-center m-t-5">
                   <div class="col-sm-4 text-center">
                   
                 <a href="{{ route('GitHub') }}" class="btn btn-github waves-effect waves-light">
                         <i class="fa fa-github mr-1"></i> Github
                    </a>
                                            
                </div>

                 <div class="col-sm-4 text-center">
                   
                 <button type="button" class="btn btn-googleplus waves-effect waves-light">
                                                <i class="fas fa-google-plus-g mr-1"></i> Google+
             </button>
                                            
                </div>
            </div>


        </div>

        
    </div>
</div>
@endsection
