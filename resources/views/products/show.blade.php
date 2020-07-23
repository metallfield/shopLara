<?php
?>
@extends('layouts.app')
@section('title', $product->name)
@section('content')
    <h2 class="text-center">{{$product->name}}</h2>
    <span id="product-id" data-id="{{$product->id}}"></span>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="{{Storage::url($product->image)}}" alt=""  height="250" class="w-75"><br>
            </div>

<div class="col">
    <span>price: {{$product->price}}</span><br>
    <span>count: {{$product->count}}</span><br>
    @if(isset($product->categories))
        <span class="font-weight-bold">categories:</span>
        @foreach($product->categories as $category)
            <a href="{{route('categories.show', [$category->id])}}" class="badge badge-info">{{$category->name}}</a>
        @endforeach
    @endif
    <div class="p-4 my-4 border rounded ">
        <span>description:</span><br>
        <p>{{$product->description}}</p>
    </div>
    <span>available in magazines:</span><br>
    @foreach($product->markets as $market)
        <h5><a href="{{route('markets.show', [$market])}}">{{$market->name}}</a></h5>
    @endforeach
    <button type="button" class="btn btn-outline-info" id="nearest">find market near me</button>
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input " name="setRadius" id="setRadius" >
        <label class="custom-control-label" for="setRadius">set radius</label>
    </div>
    <script id="markets" type="text/x-jquery-tmpl">
            <li><a href="{{route('markets.show', [$market])}}}">${name}</a>: ${distance}</li>
             <span>location: ${location}</span></li>
        </script>
    <input type="text" name="radius" id="radius">
    <ul id="MarketList" class="list-unstyled" >

    </ul>
</div>

    </div></div>
@endsection
