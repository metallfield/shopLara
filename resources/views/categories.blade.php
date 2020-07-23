<?php
?>
@extends('layouts.app')
@section('title', 'categories ')
@section('content')
<div class="container">
    <h2>category list:</h2>
    @foreach($categories as $category)
        <li>
            <a href="{{route('category-show', [$category])}}">{{$category->name}}</a>
        </li>
    @endforeach
    {{$categories->links()}}
</div>

@endsection
