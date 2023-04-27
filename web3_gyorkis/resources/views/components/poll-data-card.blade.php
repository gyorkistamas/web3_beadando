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

        <a href="{{route('polls.result', $poll->id)}}" class="btn btn-primary">{{__('Eredmények')}}</a>
        @if($poll->running)
            <a class="btn btn-warning m-2">{{__(('Lezárás'))}}</a>
        @else
            <a class="btn btn-success m-2">{{__('Újranyitás')}}</a>
        @endif
        <a class="btn btn-danger m-2">{{__('Törlés')}}</a>
    </div>
</div>
