<?php
?>
@extends('layouts.app')
@section('title', 'basket')
@section('content')


    <div class="container">
        <h2>basket</h2> <span class="font-weight-bold text-center my-4">{{ $order->countOfProducts()}}</span>
        <div class="row m-2 ">
            <ul>
                @foreach($order->products()->with('categories')->get() as $product)
                    <div class="p-4 border text-center row align-items-center">
                        <div class=" m-2 col">
                            <img src="{{Storage::url($product->image)}}" alt="" width="100" height="100">
                        </div>
                        <div class="m-2 col ">
                            <a href="{{route('productShow', [$product->id])}}"><span>{{substr($product->name, 0 , 40)}}</span></a>

                        </div>
                        <form action="{{route('basketRemove', $product)}}" method="post">
                            <button class="btn-outline-white" type="submit">-</button>
                            @csrf
                        </form>
                        {{$product->pivot->count}}
                        <form action="{{route('basketAdd', $product)}}" method="post">
                            <button class="btn-outline-dark" type="submit" id="productAdd" data-product="{{$product->id}}">+</button>
                            @csrf
                        </form>

                        <div class=" m-2 col">
                        <span>price for one: </span>    {{$product->price}}
                        </div>
                        <div class="m-2 col">
                          <span>price for full count: </span>  {{$product->getPriceForCount($product->pivot->count)}}
                        </div>

                    </div>

                @endforeach  <div class="col ml-auto text-right">
                    Full price: {{$order->getSumOrder()}}
                </div>
            </ul>
        </div>

        <a  class="btn btn-outline-info btn-block  float-right" href="{{route('basketPlace')}}">Create order</a>
    </div>

@endsection
