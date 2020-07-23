<?php
?>
@extends('layouts.app')
@section('title', 'dashboard: ')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-4 bg-dark">
            <ul>
                <li>
                    <a href="{{route('products.index')}}">products</a>
                </li>
                <li>
                    <a href="{{route('markets.index')}}">markets</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
