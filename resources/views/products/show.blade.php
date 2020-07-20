<?php
?>
@extends('layouts.app')
@section('title', $product->name)
@section('content')
    <h2 class="text-center">{{$product->name}}</h2>
    <div class="container">

        <img src="{{Storage::url($product->image)}}" alt=""  height="250" class="w-75"><br>
        <span>price: {{$product->price}}</span><br>
        <span>count: {{$product->count}}</span><br>
        @if(isset($product->categories))
            <span class="font-weight-bold">categories:</span>
            @foreach($product->categories as $category)
                <a href="{{route('categories.show', [$category->id])}}" class="badge badge-info">{{$category->name}}</a>
            @endforeach
        @endif
        <p>{{$product->descripition}}</p>
    </div>
@endsection
