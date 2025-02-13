@extends('frontend.app')

@section('content')
    @livewire('chat-component', ['user_id' => $id])
@endsection
