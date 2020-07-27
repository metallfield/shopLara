<?php
?>

@extends('layouts.app')
@section('title', 'admin products')
@section('content')
    <div class="container">
        <h2>products page</h2>
        <table class="table table-light">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>categories</th>
                <th>price</th>
                <th>count</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        @foreach($product->categories as $category)
                            {{$category->name}}
                        @endforeach
                    </td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->count}}</td>
                    <td>
                        <form action="{{route('products.destroy', $product)}}" method="POST"><a href="{{route('products.show', [$product])}}" class="btn btn-outline-success">show</a>
                            <a class="btn btn-group btn-warning" href="{{route('products.edit', [$product])}}">edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete">delete</button></form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-group btn-success" href="{{route('products.create')}}">create</a>
        <div class="w-100 d-flex justify-content-center">

        </div>
        {{$products->links()}}
    </div>

@endsection

