@extends('layout')

@section('title', __('Bejelentkezés'))

@section('content')
    <div class="row text-center">
        <h1>{{__('Bejelentkezés')}}<hr></h1>
    </div>

    @if(session()->has('bad_credentials'))
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-lg-5">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-theme="dark">
                    A bejelentkezés sikertelen, kérlek ellenőrizd a megadott adatokat!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{route('login.auth')}}" id="loginForm">
        @csrf
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-lg-5">
                <div class="form-floating w-100 w-lg-50" data-bs-theme="dark">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Simple name" value="{{old('email')}}" required>
                    <label for="email" class="ms-2">{{__('E-mail cím')}}</label>
                </div>
                @error('email')
                <div class="alert alert-danger mt-2" role="alert" data-bs-theme="dark" id="emailError">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-lg-5">
                <div class="form-floating w-100 w-lg-50" data-bs-theme="dark">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Simple name" required>
                    <label for="password" class="ms-2">{{__('Jelszó')}}</label>
                </div>
                @error('password')
                <div class="alert alert-danger mt-2" role="alert" data-bs-theme="dark" id="passwordError">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-lg-5 d-flex justify-content-between">
                <button type="submit" class="btn btn-success">{{__('Küldés')}}</button>
                <a class="btn btn-primary" href="{{route('home')}}">{{__('Vissza a főoldalra')}}</a>
            </div>
        </div>
    </form>
@endsection
