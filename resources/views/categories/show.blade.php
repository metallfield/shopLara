<?php
?>
@extends('layouts.app')
@section('title', 'category: '.$category->name)
@section('content')
<div class="container">
        <h2>Tag: {{$category->name}}</h2>
        <div >
            <p>{{$category->description}}</p>
        </div>
    </div>
@endsection
