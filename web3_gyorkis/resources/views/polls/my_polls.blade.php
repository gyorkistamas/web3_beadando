@extends('layout')

@section('custom_css')
    @livewireStyles
@endsection

@section('title', __('Kérdőíveim'))

@section('content')
   <livewire:list-polls />
@endsection

@section('custom_script')
    @livewireScripts
@endsection
