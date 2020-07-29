<?php
?>
@extends('layouts.app')
@section('title', 'edit product: '.$product->name)
@section('content')
    <div class="container">
        <form action="{{route('products.update', [$product])}}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" class="form-control" required value="{{old('name', isset($product)? $product->name : null)}}">
            </div>
            @error('name')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="description">description</label>
                <textarea type="text" name="description" class="form-control"  rows="6" cols="10">{{old('description', isset($product)? $product->description : null)}}
                </textarea>
            </div>
            @error('description')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <select name="categories[]" id="categories" multiple="multiple" class="form-control" >
                    @foreach($categories as $category)
                        <option value="{{$category->name}}" @if($product->categories->contains($category)) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('categories')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror

            <div class="form-group">
                <label for="image">image</label><br>
                <input id="image" type="file" class="form-controll-file" name="image" >
            </div>
            @error('image')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="price">price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{old('price', isset($product)? $product->price : null)}}">
            </div>
            @error('price')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="count">count</label>
                <input type="number" name="count" id="count" class="form-control" value="{{old('count', isset($product)? $product->count : null)}}">
            </div>
            @error('count')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-outline-info btn-block">update</button>
            @csrf
        </form>
    </div>
@endsection
