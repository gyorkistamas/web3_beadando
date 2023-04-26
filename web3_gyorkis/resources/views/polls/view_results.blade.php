@extends('layout')

@section('title', __('Eredmények'))

@section('content')

    <div class="row d-flex align-items-center flex-column">
        <div class="w-auto mb-4"><h1>{{$poll->name}} @if(!str_ends_with($poll->name, '?')) ? @endif</h1></div>
        <hr>

        <div class="w-auto mb-4"><h4>Kitöltések száma: {{ $poll->number_of_submits }}</h4></div>
        <div class="w-auto">
            @foreach($poll->questions as $question)
                <div class="w-auto mb-4">
                    <h6>{{$question->name}}: {{ $question->number_of_answers }} db válasz</h6>
                    @if($poll->number_of_submits == 0)
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 0%">0 %</div>
                        </div>
                    @else
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{round(($question->number_of_answers / $poll->number_of_submits) * 100, 2)}}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{($question->number_of_answers / $poll->number_of_submits) * 100}}%">{{round(($question->number_of_answers / $poll->number_of_submits) * 100, 2)}} %</div>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

    </div>
@endsection

@section('toast')
    @if(session()->has('answered'))
        <div class="toast text-white bg-success position-fixed bottom-0 end-0 me-4 mb-4" role="alert" aria-live="assertive" aria-atomic="true" id="updateToast" data-bs-theme="dark">
            <div class="toast-header">
                <i class="bi bi-check-square-fill me-1"></i>
                <strong class="me-auto">{{__('Rögzítve!')}}</strong>
                <small>most</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{__('Válaszát rögzítettük!')}}
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
