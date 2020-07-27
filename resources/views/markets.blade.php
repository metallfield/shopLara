<?php
?>
@extends('layouts.app')
@section('title', 'markets')
@section('content')

    <div class="container">
        <h2>Markets list</h2>

        @foreach($markets as $market)
            <div class="col my-4 border rounded">
        <h4>Market: <a href="{{route('marketShow', [$market])}}">{{$market->name}}</a></h4>
                <span>Location: <span class="font-weight-bold">{{$market->location}}</span></span>
        <p>{{$market->description}}</p>
            </div>
        @endforeach
        {{$markets->links()}}
    </div>

@endsection
