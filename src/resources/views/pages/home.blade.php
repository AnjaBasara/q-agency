@extends('index')

@section('content')
    @auth
        @include('pages.authors')
    @else
        @include('pages.login')
    @endauth
@endsection
