<?php
?>
@extends('layouts.app')
@section('title', 'create market')
@section('content')
    <div class="container">
        <form action="{{route('markets.store')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" class="form-control" >
            </div>
            @error('name')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="content">description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
            </div>
            @error('description')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="location">location</label>
                <input type="text" name="location" id="location" class="form-control" >
            </div>
            @error('location')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-outline-info btn-block">create</button>
            @csrf
        </form>
    </div>
@endsection
