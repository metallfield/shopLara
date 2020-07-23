<?php
?>
@extends('layouts.app')
@section('title', 'market: '.$market->name)
@section('content')
    <div class="container">
        <h2> {{$market->name}}</h2>
        <div >
            <p>{{$market->description}}</p>
        </div>
        <div class="location"><h3>location: </h3>{{$market->location}}</div>
        <div class="form-group">
            <label for="address_address">Address</label>
            <input type="text" id="address-input" name="address_address" class="form-control map-input" hidden>
            <input type="hidden" name="address_latitude" id="address-latitude" value="{{$market->lat}}" />
            <input type="hidden" name="address_longitude" id="address-longitude" value="{{$market->lng}}" />
        </div>
        <div id="address-map-container" style="width:100%;height:300px; ">
            <div style="width: 100%; height: 100%" id="address-map"></div>
        </div>
    </div>
@endsection
