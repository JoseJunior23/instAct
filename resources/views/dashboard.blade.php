@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
@include('components.navbar');

    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center" style="margin-top: 100px">
        @include('components.posts-card');
        @include('components.posts-card');
        @include('components.posts-card');
        @include('components.posts-card');
        @include('components.posts-card');
        @include('components.posts-card');
    </div>
@endsection
