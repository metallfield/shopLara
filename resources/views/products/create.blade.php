<?php
?>
@extends('layouts.app')
@section('title', 'create product')
@section('content')
    <div class="container">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" class="form-control" >
            </div>
            @error('name')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="description">description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
            </div>
            @error('description')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror

            <div class="form-group">
                <select name="categories[]" id="categories" multiple="multiple" class="form-control" >
                    @foreach($categories as $category)
                        <option value="{{$category->name}}" >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('categories')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input " id="customSwitch1" >
                    <label class="custom-control-label" for="customSwitch1">has image</label>
                </div>
                <div class="form-group">
                    <input id="image" type="file" class="form-controll-file" name="image" >
                </div>
                @error('image')
                <p class="alert alert-warning">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <label for="price">price</label>
                    <input type="number" name="price" id="price" class="form-control" >
                </div>
                @error('price')
                <p class="alert alert-warning">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <label for="count">count</label>
                    <input type="number" name="count" id="count" class="form-control" >
                </div>
                @error('count')
                <p class="alert alert-warning">{{$message}}</p>
                @enderror
            <button type="submit" class="btn btn-outline-info btn-block">create</button>
            @csrf
        </form>
    </div>

@endsection
