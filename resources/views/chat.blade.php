@extends('frontend.app')

@section('title', 'Chat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/inbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}" />

    <style>
        .individual-messages {
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            scroll-behavior: smooth;
        }
    </style>
@endpush

@section('content')
    @livewire('chat-component', ['user_id' => $id])
@endsection
