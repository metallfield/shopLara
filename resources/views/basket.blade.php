<?php
?>
@extends('layouts.app')
@section('title', 'basket')
@section('content')

    <h1>this is KORZINA</h1> <span class="font-weight-bold text-center my-4">{{ $order->countOfProducts()}}</span>
    <div class="container">
        <div class="row">
            <ul>
                @foreach($order->products()->with('categories')->get() as $product)
                    <div class="row align-items-center">
                        <div class="col">
                            <img src="{{Storage::url($product->image)}}" alt="" width="150" height="150">
                        </div>
                        <div class="col ">
                            <a href="{{route('products.show', [$product->id])}}"><span>{{$product->name}}</span></a>
                            <span>{{$product->price}}</span>
                        </div>
                        <form action="{{route('basketRemove', $product)}}" method="post">
                            <button class="btn-outline-white" type="submit">-</button>
                            @csrf
                        </form>
                        {{$product->pivot->count}}
                        <form action="{{route('basketAdd', $product)}}" method="post">
                            <button class="btn-outline-dark" type="submit">+</button>
                            @csrf
                        </form>
                        <div class="col ">
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="col">
                            {{$product->price}}
                        </div>
                        <div class="col">
                            {{$product->getPriceForCount($product->pivot->count)}}
                        </div>

                    </div>

                @endforeach  <div class="col ml-auto text-right">
                    Full price: {{$order->getSumOrder()}}
                </div>
            </ul>
        </div>

        <a  class="btn btn-outline-info float-right" href="{{route('basketPlace')}}">Create order</a>
    </div>

@endsection
