<?php
?>
@extends('layouts.app')
@section('title', 'admin category')
@section('content')
    <div class="container">
        <h2>tags page</h2>
        <table class="table table-light">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        {{$category->description}}
                    </td>
                    <td>
                        <form action="{{route('categories.destroy', $category)}}" method="POST"><a href="{{route('categories.show', [$category])}}" class="btn btn-outline-success">show</a>
                            <a class="btn btn-group btn-warning" href="{{route('categories.edit', [$category])}}">edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete">delete</button></form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
                <a class="btn btn-group btn-success" href="{{route('categories.create')}}">create</a>
        <div class="w-100 d-flex justify-content-center">

        </div>
    </div>

@endsection
