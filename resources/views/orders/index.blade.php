<?php
?>
@extends('layouts.app')
@section('title', 'orders')
@section('content')

    <div class="container my-4">
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

            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->name}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->updated_at->format('H:m:s D/M/Y')}}</td>
                    <td>{{$order->getSumOrder()}}</td>
                    <td> <a href="{{route('orders.show', $order)}}" class="btn btn-outline-success">open</a>
                            </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="w-100 d-flex justify-content-center">
            {{$orders->links()}}
        </div>
    </div>


@endsection
