@extends('frontend.app')

@section('title', 'Chat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/inbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}" />
    <style>
        /* Keep your core design */
        .individual-messages {
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            scroll-behavior: smooth;
            /* Fixed height for desktop */
            height: 400px;
        }

        .user-messages {
            display: flex;
            flex-direction: column;
            /* Set a fixed overall height so that the reply form is always visible */
            height: 700px;
        }

        .reply-input-container {
            margin-top: auto;
        }

        /* Responsive styles for mobile devices */
        @media (max-width: 768px) {
            .dashboard-layout {
                margin-top: 0;
                padding: 10px;
            }

            .messages-container {
                display: flex;
                flex-direction: column;
                /* Use full viewport height */
                height: 100vh;
            }

            /* Hide the inbox on mobile */
            .inbox {
                display: none;
            }

            .user-messages {
                width: 100%;
                display: flex;
                flex-direction: column;
                /* Reserve full viewport height minus some padding if needed */
                height: calc(100vh - 20px);
            }

            .individual-messages {
                flex: 1;
                overflow-y: auto;
                height: auto;
            }

            .reply-input-container {
                margin-top: auto;
                padding: 10px;
                background: #fff;
                border-top: 1px solid #eaeaea;
            }

            .user-name,
            .text {
                font-size: 14px;
            }
        }
    </style>
@endpush

@section('content')
    <div style="margin-top: 24px" class="dashboard-layout section-padding-x">
        <div class="messages-container bg-white">
            {{-- inbox container start --}}
            <div class="inbox">
                <div class="inbox-top">
                    <div class="inbox-title">Inbox</div>
                </div>

                <div class="general-title-container">
                    <div class="general-title">General</div>
                    <div class="general-title-border"></div>
                </div>

                <div class="inbox-messages">
                    <div class="item">
                        <div class="profile-container">
                            <img src="{{ asset($receiver->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                alt="user" />
                        </div>

                        <div class="message-container">
                            <div class="message-container-top">
                                <div class="title">{{ $receiver->first_name ?? '' }} {{ $receiver->last_name ?? '' }}</div>
                                {{-- <div class="time">7min</div> --}}
                            </div>
                            {{-- <div class="text">If the super sale starts</div> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- inbox container end --}}

            {{-- Chat messages container start --}}
            <div id="user-messages" class="user-messages">
                <div class="user-title">
                    <span>{{ $receiver->first_name ?? '' }} {{ $receiver->last_name ?? '' }}</span>
                </div>

                <div id="chatContainer" class="individual-messages">
                    @foreach ($messages as $msg)
                        @if ($msg->sender->id !== auth()->id())
                            <div class="single-message opposite-message">
                                <div class="user-profile">
                                    <img src="{{ asset($msg->sender->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                        alt="user" />
                                </div>
                                <div class="right-content">
                                    <div class="user-name">{{ $msg->sender->first_name }} {{ $msg->sender->last_name }}
                                    </div>
                                    <div class="user-text">
                                        <div class="text">{{ $msg->message }}</div>
                                        <div class="time">
                                            <span>{{ $msg->created_at->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="single-message my-message">
                                <div class="right-content">
                                    <div class="user-name">{{ $msg->sender->first_name }} {{ $msg->sender->last_name }}
                                    </div>
                                    <div class="user-text">
                                        <div class="text">{{ $msg->message }}</div>
                                        <div class="time">
                                            <span>{{ $msg->created_at->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-profile">
                                    <img src="{{ asset($msg->sender->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                        alt="user" />
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <form id="chatForm" class="reply-input-container mb-2">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                    <div>
                        <textarea name="message" placeholder="Type a message" rows="1" class="form-control"></textarea>
                    </div>
                    <div class="actions">
                        <button type="submit" class="send-btn ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path
                                    d="M13.963 7.12523L3.43173 1.23148C3.25625 1.12915 3.05419 1.08162 2.8515 1.09498C2.64881 1.10835 2.45475 1.182 2.29423 1.30648C2.13029 1.43582 2.01127 1.61352 1.95405 1.81434C1.89683 2.01516 1.90433 2.22891 1.97548 2.42523L3.73173 7.33148C3.74949 7.3804 3.78173 7.42275 3.82416 7.45289C3.86659 7.48304 3.91719 7.49955 3.96923 7.50023H8.48173C8.61147 7.49817 8.73717 7.54541 8.83345 7.63241C8.92972 7.71941 8.98942 7.83969 9.00048 7.96898C9.00475 8.03722 8.99498 8.10561 8.97178 8.16993C8.94857 8.23425 8.91242 8.29312 8.86556 8.34291C8.81869 8.3927 8.76212 8.43235 8.69932 8.45941C8.63653 8.48647 8.56885 8.50036 8.50048 8.50023H3.96923C3.91719 8.50091 3.86659 8.51742 3.82416 8.54757C3.78173 8.57771 3.74949 8.62006 3.73173 8.66898L1.97548 13.5752C1.92278 13.7264 1.9069 13.8879 1.92916 14.0464C1.95142 14.2049 2.01117 14.3559 2.10345 14.4866C2.19574 14.6174 2.31789 14.7243 2.45977 14.7984C2.60165 14.8725 2.75916 14.9117 2.91923 14.9127C3.08956 14.912 3.25704 14.869 3.40673 14.7877L13.963 8.87523C14.1176 8.7874 14.2462 8.66016 14.3357 8.50645C14.4252 8.35275 14.4723 8.17808 14.4723 8.00023C14.4723 7.82238 14.4252 7.64771 14.3357 7.494C14.2462 7.3403 14.1176 7.21305 13.963 7.12523Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            {{-- Chat messages container end --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Subscribe to the channel once on page load
            Echo.private('chat-channel.' + '{{ auth()->user()->id }}')
                .listen('MessageSendEvent', (e) => {
                    addChatMessage(e, false);
                });
        });

        // Get CSRF token once
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Handle form submission for sending new messages
        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('{{ route('chat.send') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    // Immediately display the sent message
                    addChatMessage(data, true);
                    // Clear the textarea
                    this.querySelector('textarea[name="message"]').value = '';
                })
                .catch(err => console.error(err));
        });

        function addChatMessage(msg, isMine) {
            const chatContainer = document.getElementById('chatContainer');
            // If it's me, show my local user avatar, else use msg.sender.avatar
            const senderAvatar = isMine ?
                "{{ auth()->user()->avatar ? asset(Auth::user()->avatar) : asset('backend/images/default_images/user_1.jpg') }}" :
                msg.sender.avatar;
            const senderName = isMine ?
                "{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" :
                `${msg.sender.first_name} ${msg.sender.last_name}`;
            const messageText = msg.message;
            const wrapper = document.createElement('div');
            wrapper.classList.add('single-message', isMine ? 'my-message' : 'opposite-message');
            wrapper.innerHTML = `
            ${!isMine ? `
                    <div class="user-profile">
                        <img src="${senderAvatar}" alt="user" />
                    </div>
                ` : ''}
            <div class="right-content">
                <div class="user-name">${senderName}</div>
                <div class="user-text">
                    <div class="text">${messageText}</div>
                    <div class="time"><span>${msg.created_at}</span></div>
                </div>
            </div>
            ${isMine ? `
                    <div class="user-profile">
                        <img src="${senderAvatar}" alt="user" />
                    </div>
                ` : ''}
        `;
            chatContainer.appendChild(wrapper);
            // Auto-scroll to the bottom of the messages area
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    </script>
@endpush
