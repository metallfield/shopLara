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
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($markets as $market)
                <tr >
                    <div class="row d-flex flex-wrap">
                    <div class="col">
                    <th scope="row">{{$market->id}}</th>
                    <td>
                        <a href="{{route('marketShow', [$market])}}">    {{$market->name}}</a>
                    </td>
                    <td>
                        {{$market->description}}
                    </td>
                    <td>{{$market->location}}</td>
                    </div>
                    <div class="">
                    <th class="">
                        <form action="{{route('markets.destroy', $market)}}" method="POST" >
                            <div class="row justify-content-center flex-nowrap ">
                          <div > <a class="mx-1 text-center btn btn-outline-success" href="{{route('markets.show', [$market])}}" >show</a></div>
                         <div >  <a class="mx-1 text-center btn btn-warning" href="{{route('markets.edit', [$market])}}">edit</a></div>
                            @csrf
                            @method('DELETE')
                        <div >    <button type="submit" class="mx-1 text-center btn btn-danger" value="delete">delete</button></div>
                     <div > <a href="{{route('markets.products', [$market])}}" class="mx-1  text-center btn btn-group btn-outline-info">products</a>
                            </div>    </div>
                        </form></th></div></div>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-group btn-success" href="{{route('markets.create')}}">create</a>
        <div class="w-100 d-flex justify-content-center">

        </div>
    </div>

@endsection

