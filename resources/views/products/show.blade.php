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
                <button type="button" class=" mt-4 btn btn-outline-info" id="nearest">find market near me</button>
                <div class="m-2 custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input " name="setRadius" id="setRadius" >
                    <label class="custom-control-label" for="setRadius">set distance in kilometers</label>
                </div>
                <script id="markets" type="text/x-jquery-tmpl">
            <li><a href="{{route('markets.show', [$market ?? ''])}}}">${name}</a>: ${distance}</li>
             <span>location: ${location}</span></li>
        </script>
                <input type="text" name="radius" id="radius">
                <ul id="MarketList" class="list-unstyled" >

                </ul>
            </div>

<div class="col">
    <h4>price: {{$product->price}}$</h4>
    <span>count: {{$product->count}}</span><br>
    @if(isset($product->categories))
        <span class="font-weight-bold">categories:</span>
        @foreach($product->categories as $category)
            <a href="{{route('category-show', [$category->id])}}" class="badge badge-info">{{$category->name}}</a>
        @endforeach
    @endif
    <div class="p-4 my-4 border rounded ">
        <span>description:</span><br>
        <p>{{$product->description}}</p>
    </div>

         @if($product->isAvaible())
         <div id="addBasket">
        <add-product :product="{{$product}}"
        /></div>
    @else
          <h3 class="font-weight-bold text-dark">нет в наличии</h3>
        @endif
        @csrf

    <br> <span>available in magazines:</span><br>
    @if(isset($product->markets))
    @foreach($product->markets  as $market)
        <h5><a href="{{route('marketShow', [$market->id])}}">{{$market->name}}</a></h5>
    @endforeach


     @endif
    <div id="basket_details"></div>
</div>

    </div>
        <h3 class="my-2 text-center">recommend products</h3>
        <div class="row">

    @foreach( $recommendProducts as $product)
            <div class="col-3 m-4 border rounded">
                <img src="{{Storage::url($product->image)}}" alt="" width="" height="100" class="w-100">
                <h4><a href="{{route('productShow', [$product])}}">{{substr($product->name, 0 , 30)}}</a></h4>
                @foreach($product->categories as $category)
                    <span class="badge badge-info">
                           <a href="{{route('category-show', [$category])}}" class="text-white"> {{$category->name}}</a>
                            </span>
                @endforeach
                <br><span class="text-success font-weight-bold">price: {{$product->price}}</span>
            </div>
        @endforeach
        </div>
    </div>

@endsection
