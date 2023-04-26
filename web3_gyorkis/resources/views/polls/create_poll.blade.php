@extends('layout')

@section('title', __('Új kérdőív létrehozása'))

@section('custom_css')
    @livewireStyles
@endsection

@section('content')
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="form-floating mb-3" data-bs-theme="dark">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name">
                    <label for="floatingInput">{{__('Kérdőív neve')}}</label>
                </div>

                <div class="d-flex justify-content-between mt-5 mb-5 mb-lg-0">
                    <button type="submit" class="btn btn-success">{{__('Létrehozás')}}</button>
                    <a class="btn btn-danger" href="{{route('home')}}">{{__('Mégse')}}</a>
                </div>

            </div>

            <div class="col-12 col-lg-7">
                <livewire:poll-options />
            </div>

        </div>
    </form>
@endsection

@section('custom_script')
    @livewireScripts
@endsection
