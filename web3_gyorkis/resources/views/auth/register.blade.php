@extends('layout')

@section('title', __('Regisztráció'))

@section('custom_script')
    <script src="{{url('/javascript/reg_form_validation.js')}}" defer></script>
@endsection

@section('content')
    <div class="row text-center">
        <h1>Regisztráció <hr></h1>
    </div>

    <form method="POST" action="{{route('register.store')}}" id="regForm">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-5">
                <div class="form-floating w-100 w-lg-50" data-bs-theme="dark">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Simple name" value="{{old('name')}}" required>
                    <label for="name" class="ms-2">{{__('Név')}}</label>
                </div>
                <div class="alert alert-danger mt-2" role="alert" data-bs-theme="dark" id="nameError" hidden>
                    A név mező nem lehet üres!
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-lg-5">
                <div class="form-floating w-100 w-lg-50" data-bs-theme="dark">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Simple name" value="{{old('email')}}" required>
                    <label for="email" class="ms-2">{{__('E-mail cím')}}</label>
                </div>
                <div class="alert alert-danger mt-2" role="alert" data-bs-theme="dark" id="emailError" hidden>
                    Az email cím nem megfelelően lett megadva!
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-lg-5">
                <div class="form-floating w-100 w-lg-50" data-bs-theme="dark">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Simple name" required>
                    <label for="password" class="ms-2">{{__('Jelszó')}}</label>
                </div>
                <div class="alert alert-danger mt-2" role="alert" data-bs-theme="dark" id="passwordError" hidden>
                    A jelszó legalább 8 karakter legyen!
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-lg-5">
                <div class="form-floating w-100 w-lg-50" data-bs-theme="dark">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Simple name" required>
                    <label for="password_confirmation" class="ms-2">{{__('Jelszó megint')}}</label>
                </div>
                <div class="alert alert-danger mt-2" role="alert" data-bs-theme="dark" id="passwordConfError" hidden>
                    A két jelszó nem egyezik meg!
                </div>
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
