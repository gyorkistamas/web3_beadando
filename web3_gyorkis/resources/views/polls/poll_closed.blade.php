@extends('layout')

@section('title', __('A szavazás lezárult'))

@section('content')
    <h1>A szavazás lezárult, így már nem fogad válaszokat!</h1>
    <a class="btn btn-primary" href="{{route('home')}}">Vissza a főoldalra!</a>
@endsection
