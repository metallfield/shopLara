<?php
?>

@extends('layouts.app')
@section('title', 'edit category: '.$category->name)
@section('content')
    <div class="container">
        <form action="{{route('categories.update', [$category])}}" method="POST">
            @method('PATCH')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" class="form-control" required value="{{old('name', isset($category)? $category->name : null)}}">
            </div>
            @error('name')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="description">description</label>
                <textarea type="text" name="description" class="form-control" rows="6">{{old('description', isset($category)? $category->description : null)}}
                </textarea>
            </div>
            @error('description')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-outline-info btn-block">update</button>
            @csrf
        </form>
    </div>
@endsection

