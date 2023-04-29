@extends('layout')

@section('custom_css')
    @livewireStyles
@endsection

@section('title', __('Kérdőíveim'))

@section('content')
   <livewire:list-polls />
@endsection

@section('toast')
        <div class="toast-container position-fixed bottom-0 end-0 me-4 mb-4">
            <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="pollClosed" data-bs-theme="dark">
                <div class="toast-header">
                    <i class="bi bi-check-square-fill me-1"></i>
                    <strong class="me-auto">{{__('Szavazás lezárva')}}</strong>
                    <small>most</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{__('Szavazás lezárva!')}}
                </div>
            </div>

            <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="pollOpened" data-bs-theme="dark">
                <div class="toast-header">
                    <i class="bi bi-check-square-fill me-1"></i>
                    <strong class="me-auto">{{__('Szavazás megnyitva')}}</strong>
                    <small>most</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{__('Szavazás újra megnyitva!')}}
                </div>
            </div>

            <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="polldeleted" data-bs-theme="dark">
                <div class="toast-header">
                    <i class="bi bi-check-square-fill me-1"></i>
                    <strong class="me-auto">{{__('Szavazás lezárva')}}</strong>
                    <small>most</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{__('Szavazás törölve!')}}
                </div>
            </div>
        </div>
@endsection

@section('custom_script')
    @livewireScripts

    <script>
        const closed = bootstrap.Toast.getOrCreateInstance(document.getElementById('pollClosed'));
        const opened = bootstrap.Toast.getOrCreateInstance(document.getElementById('pollOpened'));
        const deleted = bootstrap.Toast.getOrCreateInstance(document.getElementById('polldeleted'));

        window.addEventListener('alert', event => {
           switch (event.detail.type) {
               case 'opened':
                   opened.show();
                   break;
               case 'closed':
                   closed.show();
                   break;
               case 'deleted':
                   deleted.show();
                   break;
           }
        });
    </script>
@endsection
