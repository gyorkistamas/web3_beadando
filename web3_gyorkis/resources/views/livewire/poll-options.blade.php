<div>
    <div class="d-flex justify-content-start">
        <h3>{{__('Válaszok száma:')}} {{$count}}</h3>
        <button class="btn btn-primary ms-4" type="button" wire:click="increase" @if($count == 10) disabled @endif><i class="bi bi-plus-circle"></i></button>
        <button class="btn btn-primary ms-4" type="button" wire:click="decrease" @if($count == 1) disabled @endif><i class="bi bi-dash-circle"></i></button>
    </div>
    <hr>
    @for($i = 0; $i < $count; $i++)
        <x-poll-input name="answer{{$i}}"/>
    @endfor
</div>
