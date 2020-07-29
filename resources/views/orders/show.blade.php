<?php
?>
@extends('layouts.app')

@section('title', 'order' . $order->id)
@section('content')
    <div class="container">
        <h1>order № {{$order->id}} </h1>
        <span>username: {{$order->name}}</span><br>
        <span>address: {{$order->address}}</span><br>
        @if(isset($order->shipping_address))
        <span>shipping: {{$order->shipping_address}}<br>
        @endif
        <span>email: {{$order->email}}</span>
        <table class="table table-light">
            <thead>
            <tr>

                <th>name</th>
                <th>count</th>
                <th>price</th>
                <th>full price</th>
            </tr>
            </thead>
            <tbody>


            @foreach($order->products as $product)

                    <tr>
                    <td><a href="{{route('products.show', [$product->id])}}">
                            <img src="{{Storage::url($product->image)}}" alt="" width="100" height="100"><br>
                         <span class="my-2 text-center text-dark">  {{substr($product->name, 0 , 40)}}</span>
            </a></td>
                    <td>{{$product->pivot->count}}</td>
                    <td>{{$product->price}}$</td>
                    <td>{{$product->price * $product->pivot->count}}$</td>
                </tr>
            @endforeach
            <tr>
                <td>full sum order: {{$order->getSumOrder()}}$</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
