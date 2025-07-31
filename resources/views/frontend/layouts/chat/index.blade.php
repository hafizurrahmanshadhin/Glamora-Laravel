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
            padding: 15px;
            gap: 15px;
        }

        .user-messages {
            display: flex;
            flex-direction: column;
            /* Set a fixed overall height so that the reply form is always visible */
            height: 700px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .user-title {
            background: linear-gradient(135deg, #FFCED5 0%, #FFF8F9 100%);
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            font-weight: 600;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-title::before {
            content: '💬';
            font-size: 20px;
        }

        /* Modern message bubbles */
        .single-message {
            display: flex;
            gap: 12px;
            max-width: 85%;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .opposite-message {
            align-self: flex-start;
        }

        .my-message {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #f0f0f0;
            flex-shrink: 0;
        }

        .right-content {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .user-name {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-bottom: 4px;
        }

        .user-text {
            background: #f8f9fa;
            padding: 12px 16px;
            border-radius: 18px 18px 18px 4px;
            position: relative;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .my-message .user-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 18px 18px 4px 18px;
        }

        .text {
            font-size: 14px;
            line-height: 1.5;
            word-wrap: break-word;
            margin-bottom: 8px;
        }

        .time {
            font-size: 11px;
            color: #999;
            text-align: right;
            margin-top: 5px;
        }

        .my-message .time {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Attachment styles with image preview */
        .attachment {
            margin: 8px 0;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .attachment img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .attachment img:hover {
            transform: scale(1.05);
        }

        .attachment a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: background 0.2s ease;
        }

        .attachment a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .my-message .attachment a {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .my-message .attachment a:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Modern reply form */
        .reply-input-container {
            margin-top: auto;
            padding: 20px;
            background: white;
            border-top: 1px solid #eee;
            border-radius: 0 0 12px 12px;
        }

        .reply-input-container .d-flex {
            background: #f8f9fa;
            border-radius: 25px;
            padding: 8px;
            border: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .reply-input-container .d-flex:focus-within {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .reply-input-container textarea {
            border: none;
            background: transparent;
            resize: none;
            padding: 8px 16px;
            font-size: 14px;
            line-height: 1.4;
            max-height: 100px;
        }

        .reply-input-container textarea:focus {
            outline: none;
            box-shadow: none;
        }

        /* File upload button */
        .file-upload-btn {
            background: transparent;
            border: none;
            padding: 8px 12px;
            border-radius: 50%;
            color: #666;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .file-upload-btn:hover {
            background: #e9ecef;
            color: #667eea;
        }

        /* Send button */
        .send-btn {
            background: linear-gradient(135deg, ##FFCED5 0%, #FFF8F9 100%);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .send-btn:active {
            transform: scale(0.95);
        }

        /* File preview styles */
        .file-preview-container {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 12px;
            border: 1px solid #e9ecef;
        }

        .file-preview-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
            background: white;
            border-radius: 8px;
            margin-bottom: 8px;
            border: 1px solid #e9ecef;
        }

        .file-preview-item:last-child {
            margin-bottom: 0;
        }

        .file-preview-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e9ecef;
        }

        .file-preview-icon {
            width: 50px;
            height: 50px;
            background: #f0f0f0;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .file-preview-info {
            flex: 1;
            min-width: 0;
        }

        .file-preview-name {
            font-size: 13px;
            font-weight: 500;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-preview-size {
            font-size: 11px;
            color: #666;
        }

        .file-remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .file-remove-btn:hover {
            background: #c82333;
            transform: scale(1.1);
        }

        /* Image modal for full-size view */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(5px);
        }

        .image-modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 90%;
            max-height: 90%;
        }

        .image-modal-content img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .image-modal-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
        }

        .image-modal-close:hover {
            opacity: 0.7;
        }

        /* Typing indicator */
        .typing-indicator {
            display: none;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: #f8f9fa;
            border-radius: 18px;
            margin: 10px 0;
            max-width: 100px;
        }

        .typing-dots {
            display: flex;
            gap: 4px;
        }

        .typing-dot {
            width: 6px;
            height: 6px;
            background: #999;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes typing {

            0%,
            80%,
            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
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
                padding: 10px;
            }

            .reply-input-container {
                margin-top: auto;
                padding: 15px;
                background: #fff;
                border-top: 1px solid #eaeaea;
            }

            .user-name,
            .text {
                font-size: 14px;
            }

            .single-message {
                max-width: 95%;
            }

            .attachment img {
                max-width: 150px;
                max-height: 150px;
            }
        }

        /* Online status indicator */
        .online-status {
            width: 12px;
            height: 12px;
            background: #28a745;
            border: 2px solid white;
            border-radius: 50%;
            position: absolute;
            bottom: 2px;
            right: 2px;
        }

        .user-profile {
            position: relative;
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- inbox container end --}}

            {{-- Chat messages container start --}}
            <div id="user-messages" class="user-messages">
                <div class="user-title">
                    <span>{{ $receiver->first_name ?? '' }} {{ $receiver->last_name ?? '' }}</span>
                    <span style="margin-left: auto; font-size: 12px; opacity: 0.8;">Online</span>
                </div>

                <div id="chatContainer" class="individual-messages">
                    @foreach ($messages as $msg)
                        @if ($msg->sender->id !== auth()->id())
                            <div class="single-message opposite-message">
                                <div class="user-profile">
                                    <img src="{{ asset($msg->sender->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                        alt="user" />
                                    <div class="online-status"></div>
                                </div>
                                <div class="right-content">
                                    <div class="user-name">{{ $msg->sender->first_name }} {{ $msg->sender->last_name }}
                                    </div>
                                    <div class="user-text">
                                        {{-- Show text if present --}}
                                        @if ($msg->message)
                                            <div class="text">{{ $msg->message }}</div>
                                        @endif

                                        {{-- Show each attachment with image preview --}}
                                        @if (!empty($msg->attachments) && is_array($msg->attachments))
                                            @foreach ($msg->attachments as $relPath)
                                                @php
                                                    $extension = strtolower(pathinfo($relPath, PATHINFO_EXTENSION));
                                                    $isImage = in_array($extension, [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'gif',
                                                        'webp',
                                                        'svg',
                                                    ]);
                                                @endphp
                                                <div class="attachment">
                                                    @if ($isImage)
                                                        <img src="{{ asset($relPath) }}" alt="Image"
                                                            onclick="openImageModal('{{ asset($relPath) }}')">
                                                    @else
                                                        <a href="{{ asset($relPath) }}" target="_blank"
                                                            class="text-decoration-none">
                                                            @if (in_array($extension, ['pdf']))
                                                                📄
                                                            @elseif (in_array($extension, ['doc', 'docx']))
                                                                📝
                                                            @elseif (in_array($extension, ['mp4', 'avi', 'mov']))
                                                                🎥
                                                            @else
                                                                📎
                                                            @endif
                                                            {{ basename($relPath) }}
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

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
                                        @if ($msg->message)
                                            <div class="text">{{ $msg->message }}</div>
                                        @endif

                                        @if (!empty($msg->attachments) && is_array($msg->attachments))
                                            @foreach ($msg->attachments as $relPath)
                                                @php
                                                    $extension = strtolower(pathinfo($relPath, PATHINFO_EXTENSION));
                                                    $isImage = in_array($extension, [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'gif',
                                                        'webp',
                                                        'svg',
                                                    ]);
                                                @endphp
                                                <div class="attachment">
                                                    @if ($isImage)
                                                        <img src="{{ asset($relPath) }}" alt="Image"
                                                            onclick="openImageModal('{{ asset($relPath) }}')">
                                                    @else
                                                        <a href="{{ asset($relPath) }}" target="_blank"
                                                            class="text-decoration-none">
                                                            @if (in_array($extension, ['pdf']))
                                                                📄
                                                            @elseif (in_array($extension, ['doc', 'docx']))
                                                                📝
                                                            @elseif (in_array($extension, ['mp4', 'avi', 'mov']))
                                                                🎥
                                                            @else
                                                                📎
                                                            @endif
                                                            {{ basename($relPath) }}
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                        <div class="time">
                                            <span>{{ $msg->created_at->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-profile">
                                    <img src="{{ asset($msg->sender->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                        alt="user" />
                                    <div class="online-status"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {{-- Typing indicator --}}
                    <div id="typingIndicator" class="typing-indicator">
                        <div class="typing-dots">
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                        </div>
                        <span style="font-size: 12px; color: #666;">typing...</span>
                    </div>
                </div>

                {{-- File preview container --}}
                <div id="filePreviewContainer" class="file-preview-container" style="display: none;">
                    <div id="filePreviewList"></div>
                </div>

                {{-- FORM: now accepts multiple file uploads --}}
                <form id="chatForm" class="reply-input-container mb-2" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                    <div class="d-flex align-items-end">
                        <textarea name="message" placeholder="Type a message..." rows="1" class="form-control me-2"></textarea>

                        {{-- 📎 button + hidden file input (multiple) --}}
                        <label class="file-upload-btn me-2">
                            📎
                            <input type="file" name="attachments[]" multiple
                                accept="
                                       image/*,
                                       video/*,
                                       application/pdf,
                                       application/msword,
                                       application/vnd.openxmlformats-officedocument.wordprocessingml.document
                                   "
                                style="display: none;">
                        </label>

                        <button type="submit" class="send-btn">
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

    {{-- Image Modal --}}
    <div id="imageModal" class="image-modal">
        <span class="image-modal-close" onclick="closeImageModal()">&times;</span>
        <div class="image-modal-content">
            <img id="modalImage" src="" alt="Full size image">
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let selectedFiles = [];

        document.addEventListener('DOMContentLoaded', function() {
            // Subscribe to the channel once on page load
            Echo.private('chat-channel.' + '{{ auth()->user()->id }}')
                .listen('MessageSendEvent', (e) => {
                    addChatMessage(e, false);
                });

            // Scroll to bottom after messages are loaded
            const chatContainer = document.getElementById('chatContainer');
            chatContainer.scrollTop = chatContainer.scrollHeight;

            // Grab file input
            const fileInput = document.querySelector('input[name="attachments[]"]');
            const filePreviewContainer = document.getElementById('filePreviewContainer');
            const filePreviewList = document.getElementById('filePreviewList');

            // When files are chosen, show preview
            fileInput.addEventListener('change', function() {
                selectedFiles = Array.from(fileInput.files);
                updateFilePreview();
            });

            // Auto-resize textarea
            const messageTextarea = document.querySelector('textarea[name="message"]');
            messageTextarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 100) + 'px';
            });
        });

        function updateFilePreview() {
            const filePreviewContainer = document.getElementById('filePreviewContainer');
            const filePreviewList = document.getElementById('filePreviewList');

            if (selectedFiles.length === 0) {
                filePreviewContainer.style.display = 'none';
                return;
            }

            filePreviewContainer.style.display = 'block';
            filePreviewList.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-preview-item';

                const isImage = file.type.startsWith('image/');
                let previewElement = '';

                if (isImage) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        fileItem.querySelector('.file-preview-thumbnail').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    previewElement = `<img class="file-preview-image file-preview-thumbnail" src="" alt="Preview">`;
                } else {
                    let icon = '📎';
                    if (file.type.includes('pdf')) icon = '📄';
                    else if (file.type.includes('word')) icon = '📝';
                    else if (file.type.includes('video')) icon = '🎥';

                    previewElement = `<div class="file-preview-icon">${icon}</div>`;
                }

                fileItem.innerHTML = `
                    ${previewElement}
                    <div class="file-preview-info">
                        <div class="file-preview-name">${file.name}</div>
                        <div class="file-preview-size">${formatFileSize(file.size)}</div>
                    </div>
                    <button type="button" class="file-remove-btn" onclick="removeFile(${index})">×</button>
                `;

                filePreviewList.appendChild(fileItem);
            });
        }

        function removeFile(index) {
            selectedFiles.splice(index, 1);
            updateFileInput();
            updateFilePreview();
        }

        function updateFileInput() {
            const fileInput = document.querySelector('input[name="attachments[]"]');
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.style.display = 'block';
            modalImg.src = src;
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('imageModal');
            if (event.target == modal) {
                closeImageModal();
            }
        }

        // Get CSRF token once
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Handle form submission for sending new messages
        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerText = "Sending...";

            const formData = new FormData(form);

            selectedFiles.forEach((file, index) => {
                formData.append(`attachments[${index}]`, file);
            });

            fetch('{{ route('chat.send') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async res => {
                    const data = await res.json();

                    // Always re-enable button and reset text
                    submitButton.disabled = false;
                    submitButton.innerText = "";
                    // Optionally, restore the SVG icon:
                    submitButton.innerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M13.963 7.12523L3.43173 1.23148C3.25625 1.12915 3.05419 1.08162 2.8515 1.09498C2.64881 1.10835 2.45475 1.182 2.29423 1.30648C2.13029 1.43582 2.01127 1.61352 1.95405 1.81434C1.89683 2.01516 1.90433 2.22891 1.97548 2.42523L3.73173 7.33148C3.74949 7.3804 3.78173 7.42275 3.82416 7.45289C3.86659 7.48304 3.91719 7.49955 3.96923 7.50023H8.48173C8.61147 7.49817 8.73717 7.54541 8.83345 7.63241C8.92972 7.71941 8.98942 7.83969 9.00048 7.96898C9.00475 8.03722 8.99498 8.10561 8.97178 8.16993C8.94857 8.23425 8.91242 8.29312 8.86556 8.34291C8.81869 8.3927 8.76212 8.43235 8.69932 8.45941C8.63653 8.48647 8.56885 8.50036 8.50048 8.50023H3.96923C3.91719 8.50091 3.86659 8.51742 3.82416 8.54757C3.78173 8.57771 3.74949 8.62006 3.73173 8.66898L1.97548 13.5752C1.92278 13.7264 1.9069 13.8879 1.92916 14.0464C1.95142 14.2049 2.01117 14.3559 2.10345 14.4866C2.19574 14.6174 2.31789 14.7243 2.45977 14.7984C2.60165 14.8725 2.75916 14.9117 2.91923 14.9127C3.08956 14.912 3.25704 14.869 3.40673 14.7877L13.963 8.87523C14.1176 8.7874 14.2462 8.66016 14.3357 8.50645C14.4252 8.35275 14.4723 8.17808 14.4723 8.00023C14.4723 7.82238 14.4252 7.64771 14.3357 7.494C14.2462 7.3403 14.1176 7.21305 13.963 7.12523Z" fill="white"/></svg>`;

                    if (!res.ok) {
                        // Show error message (you can display it above the form or as a toast)
                        // alert(data.message || 'Failed to send message.');
                        return;
                    }
                    // Immediately display the sent message
                    addChatMessage(data, true);

                    // Clear the textarea and reset height
                    const textarea = this.querySelector('textarea[name="message"]');
                    textarea.value = '';
                    textarea.style.height = 'auto';

                    // Clear selected files
                    selectedFiles = [];
                    updateFilePreview();

                    // Clear file input
                    const fileInput = this.querySelector('input[name="attachments[]"]');
                    fileInput.value = null;
                })
                .catch(err => {
                    submitButton.disabled = false;
                    submitButton.innerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M13.963 7.12523L3.43173 1.23148C3.25625 1.12915 3.05419 1.08162 2.8515 1.09498C2.64881 1.10835 2.45475 1.182 2.29423 1.30648C2.13029 1.43582 2.01127 1.61352 1.95405 1.81434C1.89683 2.01516 1.90433 2.22891 1.97548 2.42523L3.73173 7.33148C3.74949 7.3804 3.78173 7.42275 3.82416 7.45289C3.86659 7.48304 3.91719 7.49955 3.96923 7.50023H8.48173C8.61147 7.49817 8.73717 7.54541 8.83345 7.63241C8.92972 7.71941 8.98942 7.83969 9.00048 7.96898C9.00475 8.03722 8.99498 8.10561 8.97178 8.16993C8.94857 8.23425 8.91242 8.29312 8.86556 8.34291C8.81869 8.3927 8.76212 8.43235 8.69932 8.45941C8.63653 8.48647 8.56885 8.50036 8.50048 8.50023H3.96923C3.91719 8.50091 3.86659 8.51742 3.82416 8.54757C3.78173 8.57771 3.74949 8.62006 3.73173 8.66898L1.97548 13.5752C1.92278 13.7264 1.9069 13.8879 1.92916 14.0464C1.95142 14.2049 2.01117 14.3559 2.10345 14.4866C2.19574 14.6174 2.31789 14.7243 2.45977 14.7984C2.60165 14.8725 2.75916 14.9117 2.91923 14.9127C3.08956 14.912 3.25704 14.869 3.40673 14.7877L13.963 8.87523C14.1176 8.7874 14.2462 8.66016 14.3357 8.50645C14.4252 8.35275 14.4723 8.17808 14.4723 8.00023C14.4723 7.82238 14.4252 7.64771 14.3357 7.494C14.2462 7.3403 14.1176 7.21305 13.963 7.12523Z" fill="white"/></svg>`;
                    // alert('Failed to send message.');
                    // console.error(err);
                });
        });

        // Listen for Enter key (without Shift) in the textarea to submit the form
        const messageTextarea = document.querySelector('textarea[name="message"]');
        messageTextarea.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                document.getElementById('chatForm').dispatchEvent(new Event('submit', {
                    cancelable: true
                }));
            }
        });

        function addChatMessage(msg, isMine) {
            const chatContainer = document.getElementById('chatContainer');
            const senderAvatar = isMine ?
                "{{ auth()->user()->avatar ? asset(Auth::user()->avatar) : asset('backend/images/default_images/user_1.jpg') }}" :
                msg.sender.avatar;

            const senderName = isMine ?
                "{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" :
                `${msg.sender.first_name} ${msg.sender.last_name}`;

            const messageText = msg.message;
            const attachments = msg.attachments || []; // array of URLs
            const timeStamp = msg.created_at;

            const wrapper = document.createElement('div');
            wrapper.classList.add('single-message', isMine ? 'my-message' : 'opposite-message');

            let innerHtml = '';

            if (!isMine) {
                innerHtml += `
                    <div class="user-profile">
                        <img src="${senderAvatar}" alt="user" />
                        <div class="online-status"></div>
                    </div>
                `;
            }

            // Generate attachments HTML with image preview
            let attachmentsHtml = '';
            if (attachments.length > 0) {
                attachmentsHtml = attachments.map(url => {
                    const fileName = url.split('/').pop();
                    const extension = fileName.split('.').pop().toLowerCase();
                    const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(extension);

                    if (isImage) {
                        return `
                            <div class="attachment">
                                <img src="${url}" alt="Image" onclick="openImageModal('${url}')">
                            </div>
                        `;
                    } else {
                        let icon = '📎';
                        if (['pdf'].includes(extension)) icon = '📄';
                        else if (['doc', 'docx'].includes(extension)) icon = '📝';
                        else if (['mp4', 'avi', 'mov'].includes(extension)) icon = '🎥';

                        return `
                            <div class="attachment">
                                <a href="${url}" target="_blank" class="text-decoration-none">
                                    ${icon} ${fileName}
                                </a>
                            </div>
                        `;
                    }
                }).join('');
            }

            innerHtml += `
                <div class="right-content">
                    <div class="user-name">${senderName}</div>
                    <div class="user-text">
                        ${messageText ? `<div class="text">${messageText}</div>` : ''}
                        ${attachmentsHtml}
                        <div class="time"><span>${timeStamp}</span></div>
                    </div>
                </div>
            `;

            if (isMine) {
                innerHtml += `
                    <div class="user-profile">
                        <img src="${senderAvatar}" alt="user" />
                        <div class="online-status"></div>
                    </div>
                `;
            }

            wrapper.innerHTML = innerHtml;
            chatContainer.appendChild(wrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Simulate typing indicator (optional)
        let typingTimer;
        const typingIndicator = document.getElementById('typingIndicator');

        messageTextarea.addEventListener('input', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                // Hide typing indicator after user stops typing
            }, 1000);
        });
    </script>
@endpush
