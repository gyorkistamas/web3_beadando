<div>
    <div class="card w-auto" data-bs-theme="dark">
        <div class="card-body">
            <h5 class="card-title">{{$poll->name}}</h5>
            <p class="card-text">{{__('Válaszok száma')}}: {{$poll->number_of_submits}}
                @if($poll->running)
                    <span class="badge text-bg-success ms-2">{{__('Folyamatban')}}</span>
                @else
                    <span class="badge text-bg-danger ms-2">{{__('Lezárva')}}</span>
                @endif
            </p>

            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#canvas{{$poll->id}}" aria-controls="offcanvasExample">
                {{__('Megtekintés')}}
            </button>
        </div>
    </div>

    <div class="offcanvas offcanvas-start @if($isUpdate) show @endif" tabindex="-1" id="canvas{{$poll->id}}" aria-labelledby="offcanvasLabel" data-bs-theme="dark" data-bs-scroll="true" data-bs-backdrop="false">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasLabel">{{$poll->name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h5 class="mb-3">Válaszok száma: {{$poll->number_of_submits}}
            @if($poll->running)
                <span class="badge text-bg-success ms-2">{{__('Folyamatban')}}</span>
            @else
                <span class="badge text-bg-danger ms-2">{{__('Lezárva')}}</span>
            @endif
            </h5>

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


            <div class="d-flex align-items-center">

                @if($poll->running)
                    <button class="btn btn-warning" wire:click="closePoll">{{ __('Lezárás') }}</button>
                @else
                    <button class="btn btn-success" wire:click="reopenPoll">{{__('Újranyitás')}}</button>
                @endif

                <button class="btn btn-danger ms-3 me-4" data-bs-toggle="modal" data-bs-target="#modal{{$poll->id}}">{{__('Törlés')}}</button>

                <div class="spinner-border text-primary" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modal{{$poll->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Törlés')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1>Biztosan törli a kérdőívet?</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="deletePoll">{{__('Törlés')}}</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('Mégsem')}}</button>
                </div>
            </div>
        </div>
    </div>

</div>
