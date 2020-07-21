<?php
?>
@extends('layouts.app')
@section('title', 'edit market'.$market->name)
@section('content')
    <div class="container">
        <form action="{{route('markets.update', [$market])}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name', isset($market)? $market->name :null)}}">
            </div>
            @error('name')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="content">description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{old('description', isset($market)? $market->description :null)}}</textarea>
            </div>
            @error('description')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror

            <div class="form-group">
                <label for="address_address">Address</label>
                <input type="text" id="address-input" name="address_address" class="form-control map-input" value="{{old('address_address', isset($market)? $market->location :null)}}">
                <input type="hidden" name="address_latitude" id="address-latitude" value="{{old('address_latitude', isset($market)? $market->lat :null)}}" />
                <input type="hidden" name="address_longitude" id="address-longitude" value="{{old('address_longitude', isset($market)? $market->lng :null)}}" />
            </div>
            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">update</button>
            @csrf
        </form>
    </div>
@endsection

