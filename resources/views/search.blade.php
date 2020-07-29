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
        <h1>Search results: </h1>                <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                <form action="/search">
                    <div class="form-inline">
                        <input type="text" name="query" id="query" value="{{request()->input('query')}}">
                        <button type="submit" class="mx-2 btn btn-outline-info rounded-circle"><i class="fa fa-search"></i></button>
                    </div>

                </form>

            <div class="row justify-content-center">

                @if($products->count() > 0)

                @foreach($products as $product)

                    <div class="col-3 m-4 border rounded">
                        <img src="{{Storage::url($product->image)}}" alt="" width="" height="100" class="w-100">
                        <h4><a href="{{route('productShow', [$product])}}">{{$product->name}}</a></h4>
                        @foreach($product->categories as $category)
                            <span class="badge badge-info">
                           <a href="{{route('category-show', [$category])}}" class="text-white"> {{$category->name}}</a>
                            </span>
                        @endforeach
                        <br><span class="text-success font-weight-bold">price: {{$product->price}}$</span>
                    </div>
                @endforeach
                @else
                <h3>nothing found by this query : {{request()->input('query')}}</h3>
                @endif
            </div>
        {{$products->links()}}
        </div>
     </div>
@endsection
