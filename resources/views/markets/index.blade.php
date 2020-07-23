<?php
?>
@extends('layouts.app')
@section('title', 'admin markets')
@section('content')
    <div class="container">
        <h2>markets page</h2>
        <table class="table table-light">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>description</th>
                <th>location</th>
            </tr>
            </thead>
            <tbody>
            @foreach($markets as $market)
                <tr>
                    <th scope="row">{{$market->id}}</th>
                    <td>
                        {{$market->name}}
                    </td>
                    <td>
                        {{$market->description}}
                    </td>
                    <td>{{$market->location}}</td>
                    <td>
                        <form action="{{route('markets.destroy', $market)}}" method="POST"><a href="{{route('markets.show', [$market])}}" class="btn btn-outline-success">show</a>
                            <a class="btn btn-group btn-warning" href="{{route('markets.edit', [$market])}}">edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete">delete</button></form>
                        <a href="{{route('markets.products', [$market])}}" class="btn btn-group btn-outline-info">products</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-group btn-success" href="{{route('markets.create')}}">create</a>
        <div class="w-100 d-flex justify-content-center">

        </div>
    </div>

@endsection

