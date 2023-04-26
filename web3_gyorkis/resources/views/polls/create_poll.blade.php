@extends('layout')

@section('title', __('Új kérdőív létrehozása'))

@section('content')
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="form-floating mb-3" data-bs-theme="dark">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name">
                    <label for="floatingInput">{{__('Kérdőív neve')}}</label>
                </div>

                <div class="d-flex justify-content-between mt-auto">
                    <button type="submit" class="btn btn-success">{{__('Létrehozás')}}</button>
                    <a class="btn btn-danger" href="{{route('home')}}">{{__('Mégse')}}</a>
                </div>

            </div>

            <div class="col-12 col-lg-7">
                <div class="d-flex justify-content-start">
                    <h3>{{__('Válaszok száma:')}} <span id="numOfInputs">1</span></h3>
                    <button class="btn btn-primary ms-4" type="button"><i class="bi bi-plus-circle"></i></button>
                    <button class="btn btn-primary ms-4" type="button"><i class="bi bi-dash-circle"></i></button>
                </div>
                <hr>
                <x-poll-input name="answer1"/>
            </div>

        </div>
    </form>
@endsection
