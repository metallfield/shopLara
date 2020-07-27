<?php
?>
@extends('layouts.app')
@section('title', 'order')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Подтвердите заказ</h1>

            <span class="w-100 text-center font-weight-bold">full price : {{$order->getSumOrder()}}</span>
            <div class="col-12 text-center">



                <p> enter your address , name and email</p>

                {{-- <form action="{{route('basketConfirm')}}" class="form" method="POST">
                    <label for="address">address</label>
                    <input type="text" name="address" id="address" class="form-control my-2">
                    @guest
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" class="form-control my-2 d-block">
                        <label for="email">email</label>
                        <input type="email" name="email" id="email" class="form-control my-2 d-block">
                    @endguest
                    <button type="submit" class="btn-outline-dark btn btn-block rounded btn-lg" >order this</button>
                    @csrf
                </form>

                --}}

                <form
                    role="form"
                    action="{{ route('stripe.post') }}"
                    method="post"
                    class="require-validation"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                    id="payment-form">
                    @csrf
{{-- <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label> <input
                                class='form-control' size='4' type='text'>
                        </div>
                    </div>
                                            --}}

                    <label for="address">billing address</label>
                    <input type="text" name="address" id="address" class="form-control my-2">
                    @error('address')
                    <p class="alert alert-warning">{{$message}}</p>
                    @enderror
                    <label for="shipping_address">shipping address</label>
                    <input type="text" name="shipping_address" id="shipping_address" class="form-control my-2">
                    @guest
                        <label for="name">name</label>
                        <input type="text" name="name" id="name" class="form-control my-2 d-block">
                        @error('name')
                        <p class="alert alert-warning">{{$message}}</p>
                        @enderror
                        <label for="email">email</label>
                        <input type="email" name="email" id="email" class="form-control my-2 d-block">
                        @error('email')
                        <p class="alert alert-warning">{{$message}}</p>
                        @enderror
                    @endguest
                    <div class='m-4 form-row row '>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label> <input
                                autocomplete='off' class='form-control card-number' size='40'
                                type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                            class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                            type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label> <input
                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-md-12 error form-group ' hidden>
                            <div class='alert-danger alert'>Please correct the errors and try
                                again.</div>
                        </div>
                    </div>
                    <input type="text" name="amount" value="{{$order->getSumOrder()}}" hidden>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ({{$order->getSumOrder()}})</button>
                        </div>
                    </div>
                @csrf
                </form>
            </div> </div>
    </div>
@endsection
