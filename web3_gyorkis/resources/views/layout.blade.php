<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="{{ url('/css/layout.css') }}" rel="stylesheet" type="text/css">
    @yield('custom_css')

    <title>@yield('title')</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary rounded-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <i class="bi bi-check-square-fill"></i>
            {{config('app.name')}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ms-0 ms-lg-3 mt-3 mt-lg-0">
                    <a class="btn {{ request()->route()->named('home') == 'home' ? 'btn-success' : 'btn-secondary'}} w-100" aria-current="page" href="{{route('home')}}"><i class="bi bi-house-door-fill me-1"></i>{{__('Főoldal')}}</a>
                </li>

                @auth
                    <li class="nav-item ms-0 ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn {{ request()->route()->named('polls') ? 'btn-success' : 'btn-secondary'}} w-100" aria-current="page" href="/"><i class="bi bi-card-checklist me-1"></i>{{__('Szavazásaim')}}</a>
                    </li>
                    <li class="nav-item ms-0 ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn {{ request()->route()->named('polls.create') ? 'btn-success' : 'btn-secondary'}} w-100" aria-current="page" href="{{route('polls.create')}}"><i class="bi bi-file-earmark-plus me-1"></i>{{__('Szavazás létrehozása')}}</a>
                    </li>
                @endauth

                @guest
                    <li class="nav-item ms-0 ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn {{ request()->route()->named('login') ? 'btn-success' : 'btn-secondary'}} w-100" href="{{route('login')}}"><i class="bi bi-box-arrow-in-left me-1"></i>{{__('Bejelentkezés')}}</a>
                    </li>
                    <li class="nav-item ms-0 ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn {{ request()->route()->named('register') ? 'btn-success' : 'btn-secondary'}} w-100" href="{{route('register')}}"><i class="bi bi-person-fill-add me-1"></i>{{__('Regisztráció')}}</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item ms-0 ms-lg-3 mt-3 mt-lg-0">
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{Auth::user()->gravatarLink()}}" class="profilPic"/>Felhasználó
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{route('edit-profile')}}"><i class="bi bi-pencil-square me-1"></i>{{__('Profil szerkesztése')}}</a></li>
                                <li><a class="dropdown-item text-danger" href="{{route('logout')}}"><i class="bi bi-box-arrow-left me-1"></i>{{__('Kijelentkezés')}}</a></li>
                            </ul>
                        </div>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<div class="container bg-dark text-white px-3 py-4 mt-4 rounded-3" style="--bs-bg-opacity: .8;">
    @yield('content')
</div>

@yield('toast')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@yield('custom_script')
</body>
</html>
