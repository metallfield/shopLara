<?php
?>
@extends('layouts.app')
@section('title', $category->name)
@section('content')
    <div class="container">
        <h3>Category {{$category->name}}</h3>
        <p>description: {{$category->description}}</p>

            <div class="row">
                @foreach($category->products as $product)
                    <div class="col m-4 border rounded">
                        <img src="{{Storage::url($product->image)}}" alt="" width="" height="100" class="w-100">
                        <h4><a href="{{route('productShow', [$product])}}">{{$product->name}}</a></h4>
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
