@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card-box p-5">
        <h2 class="text-uppercase text-center pb-4">
            <a href="{{ route('frontpage') }}" class="text-success">
                <span><img src="{{ asset('assets/images/logo.png') }}" alt="" height="26"></span>
            </a>
        </h2>
        <p class="text-muted text-center">
            Enter your emaill address and we'll send an emaill with instructions to reset password
        </p>
        <form method="POST" action="{{ route('password.email') }}">
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
            <div class="form-group row text-center m-t-10">
                <div class="col-12">
                    <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Reset Password</button>
                </div>
            </div>
        </form>
        <div class="row m-t-50">
            <div class="col-sm-12 text-center">
                <p class="text-muted">Back to <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
            </div>
        </div>
    </div>
</div>
@endsection
