@extends('frontend.master')

@section('title')
Checkout Page | E Study Note
@endsection

@section('header_css')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-selection.select2-selection--single {
        width: 100%;
        height: 40px;
        border: 1px solid #d7d7d7;
        margin-bottom: 25px;
        padding-left: 13px;
        border-radius: 0px;

    }

    .StripeElement {
        box-sizing: border-box;

        height: 40px;
        width: 100%;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    .payment{
        display:none;
    }

</style>
@endsection

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                    <form action="{{ route('FinalCheckout') }}" method="post" id="payment-form1">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <p>Full Name *</p>
                                <input type="text" name="name">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Company Name</p>
                                <input type="text" name="company_name">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" name="email">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="phone">
                            </div>
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input type="text" name="address">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select name="country_id" id="country_id">
                                    <option>Select One</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>State *</p>
                                <select name="state_id" id="state_id">

                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Town/City *</p>
                                <select name="city_id" id="city_id">

                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP *</p>
                                <input type="text" name="zipcode">
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        @foreach ($carts as $cart)
                        <li>{{ $cart->product->product_name }} <span class="pull-right">{{ $cart->product_quantity}} X ${{ $cart->product->product_price }}</span></li>
                        @endforeach
                        <li>Subtotal <span class="pull-right"><strong>${{ $SubTotal ?? "" }}</strong></span></li>
                        <li>Discount <span class="pull-right">${{ $after_discount ?? "" }}</span></li>
                        <li>Total<span class="pull-right">${{ $total ?? "" }}</span></li>
                    </ul>
                    @if (session('PaymentSelect'))
                    <div class="alert alert-danger">
                        {{ session('PaymentSelect') }}
                    </div>
                    @endif
                    <ul class="payment-method">
                        <li>
                            <input id="bank" type="radio" name="payment" value="bank">
                            <label for="bank">Direct Bank Transfer</label>
                        </li>
                        <li>
                            <input id="paypal" type="radio" name="payment" value="paypal">
                            <label for="paypal">Paypal</label>
                        </li>
                        <li>
                            <input id="card" type="radio" name="payment" value="card">
                            <label for="card">Credit Card</label>
                        </li>
                        <li>
                            <input id="delivery" type="radio" name="payment" value="cash" checked>
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                  
                   
                    <div class="card payment">
                         <div class="form-row">
                        <label for="card-element">
                            <!-- Credit or debit card -->
                        </label>
                        <div id="card-element">
                            <!--  A Stripe Element will be inserted here. -->
                        </div>

                        <!--   Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    </div>
                   
                    <button>Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->

@endsection

@section('footer_js')

<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="//js.stripe.com/v3/"></script>

<script>
    //============== PAYMENT OPTION SHOW AND HIDE START ======================
    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".payment").not(targetBox).hide();
            $(targetBox).show();
        });
    });
    //============== PAYMENT OPTION SHOW AND HIDE END ======================

    
    $('#country_id').change(function() {
        var country_id = $(this).val();


        if (country_id) {
            $.ajax({
                type: "GET"
                , url: "{{url('api/get-state-list')}}/" + country_id
                , success: function(res) {
                    if (res) {
                        console.log(res)
                        $("#state_id").empty();
                        $("#state_id").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#state_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                    } else {
                        $("#state_id").empty();
                    }
                }
            });
        } else {
            $("#state_id").empty();
            $("#city_id").empty();

        }
    });

    $('#state_id').change(function() {
        var city_id = $(this).val();


        if (city_id) {
            $.ajax({
                type: "GET"
                , url: "{{url('api/get-city-list')}}/" + city_id
                , success: function(res) {
                    if (res) {
                        console.log(res)
                        $("#city_id").empty();
                        $("#city_id").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#city_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                    } else {
                        $("#city_id").empty();
                    }
                }
            });
        } else {
            $("#city_id").empty();

        }
    });

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#country_id, #state_id, #city_id').select2();
    });

    //Payment Methodd

    // Create a Stripe client.
    var stripe = Stripe('pk_test_51H30t6EgeRexmKh6jTLhd6sZp3KfMl81aDDQdZlsluHGRJ1jYjdbm7mB3ZnIMEZnlb8vtpLskgsRpjYR7EDvOByN00gymsmdWI');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d'
            , fontFamily: '"Helvetica Neue", Helvetica, sans-serif'
            , fontSmoothing: 'antialiased'
            , fontSize: '16px'
            , '::placeholder': {
                color: '#aab7c4'
            }
        }
        , invalid: {
            color: '#fa755a'
            , iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

</script>



@endsection
