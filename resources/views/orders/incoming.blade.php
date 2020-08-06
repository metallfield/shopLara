<?php
?>
@extends('layouts.app')
@section('title', 'incoming orders')
@section('content')

    <div class="container my-4" id="order">
        <incoming-orders-component  :user_id="{{auth()->id()}}"/>


    </div>


@endsection

