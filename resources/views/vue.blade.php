<?php
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="blog-posts-events-demo">
            <div :style="{ fontSize: postFontSize + 'em' }">
                <blog-post
                    v-on:enlarge-text="postFontSize + 1"
                    v-for="post in posts"
                    v-bind:key="post.id"
                    v-bind:post="post"
                    ></blog-post>
            </div>
        </div>
    </div>
@endsection
