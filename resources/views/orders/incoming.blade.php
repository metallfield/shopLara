<?php
?>
@extends('layouts.app')
@section('title', 'incoming orders')
@section('content')

    <div class="container my-4">
        <h3>incoming orders</h3>
        <table class="table table-light">
            <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>address</th>
                <th>email</th>
                <th>date</th>
                <th>full price</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
    @if(isset($orders))
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->name}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->updated_at->format('H:m:s D/M/Y')}}</td>
                    <td>{{$order->ownerProductsSum()}}</td>
                    <td> <a href="{{route('incomingOrderShow', $order)}}" class="btn btn-outline-success">open</a>
                    </td>
                </tr>
            @endforeach
    @endif
            </tbody>
        </table>

    </div>


@endsection
