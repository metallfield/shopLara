<?php
/**
 * Created by PhpStorm.
 * User: dudos
 * Date: 22.07.20
 * Time: 15:38
 */
?>

@extends('layouts.app')
@section('title', 'search')
@section('content')
    <div class="container">
        <h1>home page</h1>                <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


            <div class="row justify-content-center">



                @foreach($products as $product)

                    <div class="col-3 m-4 border rounded">
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
        {{$products->links()}}
        </div>
     </div>
@endsection
