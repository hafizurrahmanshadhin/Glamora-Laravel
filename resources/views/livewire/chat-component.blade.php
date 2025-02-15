<div style="margin-top: 24px" class="dashboard-layout section-padding-x">
    <div class="messages-container bg-white">
        <!-- inbox container start -->
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
                        <img src="{{ asset('frontend/images/user.png') }}" alt="user" />
                    </div>
                    <div class="message-container">
                        <div class="message-container-top">
                            <div class="title">Ryan Durl</div>
                            <div class="time">7min</div>
                        </div>
                        <div class="text">If the super sale starts</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- inbox container end -->

        <!-- individual user messages start -->
        <div id="user-messages" class="user-messages">
            <div class="user-title">
                <span>{{ $user->first_name }}</span>
                <div class="d-flex align-item-center gap-2">
                    <a href="/dashboard" class="back-to-inbox-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path d="M19 12H5M5 12L11 18M5 12L11 6" stroke="#121715" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Add a unique ID here for auto-scrolling -->
            <div id="chatContainer" class="individual-messages">
                @foreach ($messages as $message)
                    @if ($message['sender'] !== auth()->user()->first_name)
                        <div class="single-message opposite-message">
                            <div class="user-profile">
                                <img src="{{ asset('frontend/images/user.png') }}" alt="user" />
                            </div>
                            <div class="right-content">
                                <div class="user-name">{{ $message['sender'] }}</div>
                                <div class="user-text">
                                    <div class="text">{{ $message['message'] }}</div>
                                    <div class="time">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 16 16" fill="none">
                                            <g clip-path="url(#clip0_248_163)">
                                                <path d="M9.25 5.25L3.75 10.75L1 8" stroke="#F8CF2C"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M14.9996 5.25L9.49961 10.75L8.03711 9.2875" stroke="#F8CF2C"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_248_163">
                                                    <rect width="16" height="16" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <span>{{ $message['time'] ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="single-message my-message">
                            <div class="right-content">
                                <div class="user-name">{{ $message['sender'] }}</div>
                                <div class="user-text">
                                    <div class="text">{{ $message['message'] }}</div>
                                    <div class="time">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 16 16" fill="none">
                                            <g clip-path="url(#clip0_248_163)">
                                                <path d="M9.25 5.25L3.75 10.75L1 8" stroke="#F8CF2C"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M14.9996 5.25L9.49961 10.75L8.03711 9.2875" stroke="#F8CF2C"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_248_163">
                                                    <rect width="16" height="16" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <span>{{ $message['time'] ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="user-profile">
                                <img src="{{ asset('frontend/images/user.png') }}" alt="user" />
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form wire:submit.prevent="sendMessage" class="reply-input-container mb-2">
                <div>
                    <textarea wire:model="message" placeholder="Type a message" rows="1" class="form-control"></textarea>
                </div>
                <div class="actions">
                    <button type="submit" class="send-btn ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                            fill="none">
                            <g clip-path="url(#clip0_248_391)">
                                <path
                                    d="M13.963 7.12523L3.43173 1.23148C3.25625 1.12915 3.05419 1.08162 2.8515 1.09498C2.64881 1.10835 2.45475 1.182 2.29423 1.30648C2.13029 1.43582 2.01127 1.61352 1.95405 1.81434C1.89683 2.01516 1.90433 2.22891 1.97548 2.42523L3.73173 7.33148C3.74949 7.3804 3.78173 7.42275 3.82416 7.45289C3.86659 7.48304 3.91719 7.49955 3.96923 7.50023H8.48173C8.61147 7.49817 8.73717 7.54541 8.83345 7.63241C8.92972 7.71941 8.98942 7.83969 9.00048 7.96898C9.00475 8.03722 8.99498 8.10561 8.97178 8.16993C8.94857 8.23425 8.91242 8.29312 8.86556 8.34291C8.81869 8.3927 8.76212 8.43235 8.69932 8.45941C8.63653 8.48647 8.56885 8.50036 8.50048 8.50023H3.96923C3.91719 8.50091 3.86659 8.51742 3.82416 8.54757C3.78173 8.57771 3.74949 8.62006 3.73173 8.66898L1.97548 13.5752C1.92278 13.7264 1.9069 13.8879 1.92916 14.0464C1.95142 14.2049 2.01117 14.3559 2.10345 14.4866C2.19574 14.6174 2.31789 14.7243 2.45977 14.7984C2.60165 14.8725 2.75916 14.9117 2.91923 14.9127C3.08956 14.912 3.25704 14.869 3.40673 14.7877L13.963 8.87523C14.1176 8.7874 14.2462 8.66016 14.3357 8.50645C14.4252 8.35275 14.4723 8.17808 14.4723 8.00023C14.4723 7.82238 14.4252 7.64771 14.3357 7.494C14.2462 7.3403 14.1176 7.21305 13.963 7.12523Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_248_391">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <!-- individual user messages end -->
    </div>
</div>
