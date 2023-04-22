@extends('layout')

@section('title', __('Profil frissítése'))


@section('content')
    <div class="row">
        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
            <img src="{{Auth::user()->gravatarLink()}}" class="img img-fluid rounded-circle" style="height: 100px; width: 100px;">
            <h1>{{Auth::user()->name}} <hr></h1>
            <h6>E-mail cím: {{Auth::user()->email}}</h6>
            <h6>Regisztráció ideje: {{\Carbon\Carbon::parse(Auth::user()->created_at)->format('Y.m.d')}}</h6>
        </div>

        <div class="col-12 col-lg-6 d-flex flex-column">
            <form method="POST" action="{{route('edit-profile.save')}}">
                @csrf
                <div class="form-floating mb-3" data-bs-theme="dark">
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="p" value="{{Auth::user()->name}}" required>
                    <label for="nameInput">{{__('Név')}}</label>
                </div>

                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div class="form-floating mb-3" data-bs-theme="dark">
                    <input type="email" class="form-control" id="emailInput" name="email" placeholder="p" value="{{Auth::user()->email}}" required>
                    <label for="emailInput">{{__('Email')}}</label>
                </div>

                @error('email')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div class="form-floating mb-3" data-bs-theme="dark">
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="p">
                    <label for="passwordInput">{{__('Jelszó')}}</label>
                </div>

                @error('password')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div class="form-floating mb-3" data-bs-theme="dark">
                    <input type="password" class="form-control" id="passwordConfInput" name="password_confirmation" placeholder="p">
                    <label for="passwordConfInput">{{__('Jelszó még egyszer')}}</label>
                </div>

                @error('password_confirmation')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div>
                    <button class="btn btn-success" type="submit">{{__('Profil frissítése')}}</button>
                </div>

            </form>
        </div>

    </div>
@endsection

@section('toast')
    @if(session()->has('success'))
        <div class="toast text-white bg-success position-fixed bottom-0 end-0 me-4 mb-4" role="alert" aria-live="assertive" aria-atomic="true" id="updateToast" data-bs-theme="dark">
            <div class="toast-header">
                <i class="bi bi-check-square-fill me-1"></i>
                <strong class="me-auto">Profil frissítése</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                A profil sikeresen frissítve
            </div>
        </div>

    @endif
@endsection

@section('custom_script')
    <script>
        const toastElList = document.querySelectorAll('.toast')
        const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl))

        toastList.forEach(toast => toast.show());

    </script>
@endsection
