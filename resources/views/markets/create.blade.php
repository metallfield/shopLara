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
                <label for="address_address">Address</label>
                <input type="text" id="address-input" name="address_address" class="form-control map-input">
                <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
            </div>
            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">create</button>
            @csrf
        </form>
    </div>
@endsection
