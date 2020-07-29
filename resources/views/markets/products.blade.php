<?php
?>


@extends('layouts.app')
@section('title', 'admin market products')
@section('content')
    <div class="container">
        <h2>{{$market->name}} products</h2>
        <span id="marketID" data-id="{{$market->id}}" hidden></span>
        <table class="table table-light">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>categories</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        {{$product->price}}$
                    </td>
                     <td>
                         @foreach($product->categories as $category)
                             {{$category->name}}
                         @endforeach
                     </td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="product-{{$product->id}}" data-product="{{$product->id}}" name="product-{{$product->id}}" @if($market->products->contains($product)) checked @endif>
                            <label class="custom-control-label" for="product-{{$product->id}}">add product to market</label>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
