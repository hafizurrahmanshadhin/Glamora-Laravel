@extends('backend.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-content wrapper">
        <div class="container-fluid">

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
    <script>
        $(document).ready(function() {
            // For user with ID 1
            Echo.private('chat.' + 1)
                .listen('MessageSent', (e) => {
                    console.log('MessageSent event on chat.1:', e);
                    // Here you can update your chat window for user 1 if needed.
                })
                .listen('ConversationUpdated', (e) => {
                    console.log('ConversationUpdated event on chat.1:', e);
                    // Here you can update your conversation list for user 1.
                });

            // For user with ID 3
            Echo.private('chat.' + 3)
                .listen('MessageSent', (e) => {
                    console.log('MessageSent event on chat.3:', e);
                    // Here you can update your chat window for user 3 if needed.
                })
                .listen('ConversationUpdated', (e) => {
                    console.log('ConversationUpdated event on chat.3:', e);
                    // Here you can update your conversation list for user 3.
                });
        });
    </script>
@endpush
