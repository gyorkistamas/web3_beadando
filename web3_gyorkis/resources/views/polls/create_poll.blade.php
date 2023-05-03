@extends('layout')

@section('title', __('Új kérdőív létrehozása'))

@section('custom_css')
    @livewireStyles
@endsection

@section('content')


        @if(session()->has('success'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-success" role="alert" data-bs-theme="dark">
                    {{__('Használja az alábbi linket a kérdőív megosztására: ')}}<a href="{{route('polls.answer', session()->get('poll_id'))}}">{{route('polls.answer', session()->get('poll_id'))}}</a>
                    <button class="btn btn-primary ms-2" onclick="copy('{{route('polls.answer', session()->get('poll_id'))}}')"><i class="bi bi-pencil-square me-2"></i>{{__('Link másolása')}}</button>
                </div>
            </div>
        @endif


    <form method="POST" action="{{route('polls.store')}}">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="form-floating mb-3" data-bs-theme="dark">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name" name="name" required>
                    <label for="floatingInput">{{__('Kérdőív neve')}}</label>
                </div>

                <div class="form-floating mb-3" data-bs-theme="dark">
                    <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"></textarea>
                    <label for="description">{{__('Leírás')}}</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_multiple" name="is_multiple">
                    <label class="form-check-label" for="flexSwitchCheckDefault">{{__('Több válasz megjelölhető')}}</label>
                </div>

                <div class="d-flex justify-content-between mt-5 mb-5 mb-lg-0">
                    <button type="submit" class="btn btn-success"><i class="bi bi-plus-square me-2"></i>{{__('Létrehozás')}}</button>
                    <a class="btn btn-danger" href="{{route('home')}}"><i class="bi bi-x-circle me-2"></i>{{__('Mégse')}}</a>
                </div>

            </div>

            <div class="col-12 col-lg-7">
                <livewire:poll-options />
            </div>

        </div>
    </form>
@endsection

@section('toast')
    @if(session()->has('success'))
        <div class="toast text-white bg-success position-fixed bottom-0 end-0 me-4 mb-4" role="alert" aria-live="assertive" aria-atomic="true" id="updateToast" data-bs-theme="dark">
            <div class="toast-header">
                <i class="bi bi-check-square-fill me-1"></i>
                <strong class="me-auto">{{__('Sikeres létrehozás!')}}</strong>
                <small>most</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{__('A kérdőív sikeresen létrehozva!')}}
            </div>
        </div>

    @endif
@endsection

@section('custom_script')
    @livewireScripts
    <script>
        const toastElList = document.querySelectorAll('.toast')
        const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl))

        toastList.forEach(toast => toast.show());

        function copy(text) {

            navigator.clipboard.writeText(text);
        }

    </script>
@endsection
