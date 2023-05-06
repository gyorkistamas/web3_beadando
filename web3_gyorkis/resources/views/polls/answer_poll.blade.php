@extends('layout')

@section('title', __('Kérdőív kitöltése'))

@section('custom_css')
    @livewireStyles
@endsection

@section('content')
    <form method="POST" action="{{route('polls.answer', $poll->id)}}">
        @csrf
        <div class="row d-flex align-items-center flex-column">
            <div class="w-auto mb-4"><h1>{{$poll->name}} @if(!str_ends_with($poll->name, '?')) ? @endif</h1></div>

            <div class="w-auto">
                @foreach($poll->questions as $question)
                    <div class="form-check w-auto mb-2">
                        <input class="form-check-input" type="{{$poll->is_multiple ? 'checkbox' : 'radio'}}"  name="answer{{$poll->is_multiple ? '[]' : ''}}" value="{{$question->id}}" id="question_{{$question->id}}">
                        <label class="form-check-label" for="question_{{$question->id}}">
                            {{$question->name}}
                        </label>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-primary w-auto" type="submit">{{__('Küldés')}}</button>

        </div>
    </form>

    <div>
        <livewire:poll-comments :poll="$poll"/>
    </div>

@endsection

@section('custom_script')
    @livewireScripts
@endsection
