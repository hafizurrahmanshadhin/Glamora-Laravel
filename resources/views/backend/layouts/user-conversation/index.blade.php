@extends('backend.app')

@section('title', 'All User Chats')

@push('styles')
    <style>
        .partners-list {
            max-height: calc(70vh - 100px);
            overflow-y: auto;
        }

        .partner-item {
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .partner-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .partner-item.active {
            background-color: #f8f9fa;
            border-left: 4px solid #dee2e6;
        }

        .partner-item .partner-info h6 {
            margin-bottom: 2px;
            color: #495057;
        }

        .partner-item .partner-info small {
            color: #6c757d;
        }

        .message-bubble {
            max-width: 70%;
            margin-bottom: 15px;
            animation: fadeInUp 0.3s ease;
        }

        .message-bubble.sent {
            margin-left: auto;
        }

        .message-bubble.received {
            margin-right: auto;
        }

        .message-content {
            padding: 12px 16px;
            border-radius: 18px;
            word-wrap: break-word;
            position: relative;
        }

        .message-bubble.sent .message-content {
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
            border-bottom-right-radius: 5px;
        }

        .message-bubble.received .message-content {
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #e9ecef;
            border-bottom-left-radius: 5px;
        }

        .message-time {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 5px;
            color: #6c757d;
        }

        .message-bubble.sent .message-time {
            text-align: right;
        }

        .message-bubble.received .message-time {
            text-align: left;
        }

        .sender-name {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #495057;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
        }

        .partners-list::-webkit-scrollbar {
            width: 6px;
        }

        .partners-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .partners-list::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .partners-list::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }

        #chatMessages::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #chatMessages::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">List of All User Chats</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Name</th>
                                            <th class="column-content">Email</th>
                                            <th class="column-action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Dynamic Data --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fixed-height modal to keep conversation scrollable, centered on screen -->
    <div class="modal fade" id="chatModal" tabindex="-1" aria-hidden="true">
        <!-- Add "modal-dialog-centered" below -->
        <div class="modal-dialog modal-xl modal-dialog-centered" style="max-height:80vh;">
            <div class="modal-content border-0 shadow" style="height:80vh;">
                <div class="modal-header bg-white border-bottom">
                    <h5 class="modal-title">
                        <i class="ri-chat-3-line me-2"></i>
                        <span id="expertName">Conversations History</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Make modal-body fill the remaining space -->
                <div class="modal-body p-0 h-100">
                    <div class="row g-0 h-100">
                        <!-- Left side: partners list -->
                        <div class="col-md-4 border-end bg-light" style="height:100%; overflow-y:auto;">
                            <div class="p-3 border-bottom bg-white">
                                <h6 class="mb-1">
                                    <i class="ri-user-line me-2"></i>Chat Partners
                                </h6>
                                <small class="text-muted">Select a partner to view conversation</small>
                            </div>
                            <div id="partnersList" class="partners-list">
                                <div class="text-center p-4">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading partners...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right side: conversation area -->
                        <div class="col-md-8 d-flex flex-column h-100">
                            <div id="chatHeader" class="p-3 bg-white border-bottom d-none">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center me-3">
                                        <i class="ri-user-line"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0" id="selectedPartnerName">Partner Name</h6>
                                        <small class="text-muted" id="messageCount">0 messages</small>
                                    </div>
                                </div>
                            </div>

                            <!-- This will hold the messages, with scrollable overflow -->
                            <div id="chatMessages" class="flex-grow-1 p-3 overflow-auto" style="background: #fff;">
                                <div class="text-center text-muted py-5">
                                    <i class="ri-chat-3-line fs-1 opacity-50"></i>
                                    <p class="mt-3">Select a partner to view conversation</p>
                                </div>
                            </div>
                        </div><!-- end col-md-8 -->
                    </div><!-- end row -->
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->

    <!-- Image Modal for full-size preview -->
    <div id="imageModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 position-relative">
                    {{-- <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-index-10"
                        data-bs-dismiss="modal" aria-label="Close"
                        style="background: rgba(255,255,255,0.8); border-radius: 50%; padding: 10px;"></button> --}}
                    <img id="modalImage" src="" alt="Full size image" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            if (!$.fn.DataTable.isDataTable('#datatable')) {
                let table = $('#datatable').DataTable({
                    responsive: true,
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"],
                    ],
                    processing: true,
                    serverSide: true,
                    pagingType: "full_numbers",
                    ajax: {
                        url: "{{ route('user-conversation.index') }}",
                        type: "GET",
                    },
                    dom: "<'row table-topbar'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>>" +
                        "<'row'<'col-12'tr>>" +
                        "<'row table-bottom'<'col-md-5 dataTables_left'i><'col-md-7'p>>",
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records...",
                        lengthMenu: "Show _MENU_ entries",
                        processing: `
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>`,
                    },
                    autoWidth: false,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '5%'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            orderable: true,
                            searchable: true,
                            width: '40%'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            orderable: true,
                            searchable: true,
                            width: '50%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '5%'
                        },
                    ],
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        let currentExpertId = null;
        let currentPartnerId = null;

        function viewConversations(expertId) {
            currentExpertId = expertId;
            currentPartnerId = null;

            // Reset modal
            $('#partnersList').html(`
            <div class="text-center p-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading partners...</span>
                </div>
            </div>
        `);

            $('#chatMessages').html(`
            <div class="text-center text-muted py-5">
                <i class="ri-chat-3-line fs-1 opacity-50"></i>
                <p class="mt-3">Select a partner to view conversation</p>
            </div>
        `);

            $('#chatHeader').addClass('d-none');
            $('#chatModal').modal('show');

            // Fetch partners
            $.getJSON(`/admin/user-conversation/${expertId}/partners`)
                .done(function(partners) {
                    if (partners.length === 0) {
                        $('#partnersList').html(`
                        <div class="text-center p-4 text-muted">
                            <i class="ri-user-line fs-2 opacity-50"></i>
                            <p class="mt-2">No chat partners found</p>
                        </div>
                    `);
                        return;
                    }

                    let partnersHtml = '';
                    partners.forEach(function(partner) {
                        partnersHtml += `
                        <div class="partner-item" data-partner-id="${partner.id}"
                             onclick="selectPartner(${partner.id}, '${partner.first_name} ${partner.last_name}')">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center me-3">
                                    <i class="ri-user-line text-primary"></i>
                                </div>
                                <div class="partner-info flex-grow-1">
                                    <h6 class="mb-0">${partner.first_name} ${partner.last_name}</h6>
                                    <small class="text-muted">${partner.email}</small>
                                </div>
                                <div class="text-end">
                                    <i class="ri-arrow-right-s-line text-muted"></i>
                                </div>
                            </div>
                        </div>
                    `;
                    });
                    $('#partnersList').html(partnersHtml);
                })
                .fail(function() {
                    $('#partnersList').html(`
                    <div class="text-center p-4 text-danger">
                        <i class="ri-error-warning-line fs-2"></i>
                        <p class="mt-2">Error loading partners</p>
                    </div>
                `);
                });
        }

        function selectPartner(partnerId, partnerName) {
            if (currentPartnerId === partnerId) return;

            currentPartnerId = partnerId;

            // Update active state
            $('.partner-item').removeClass('active');
            $(`.partner-item[data-partner-id="${partnerId}"]`).addClass('active');

            // Update chat header
            $('#selectedPartnerName').text(partnerName);
            $('#chatHeader').removeClass('d-none');

            // Show loading in chat
            $('#chatMessages').html(`
            <div class="text-center p-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading conversation...</span>
                </div>
            </div>
        `);

            // Fetch messages
            $.getJSON(`/admin/user-conversation/${currentExpertId}/${partnerId}/messages`)
                .done(function(messages) {
                    displayMessages(messages);
                    $('#messageCount').text(`${messages.length} message${messages.length !== 1 ? 's' : ''}`);
                })
                .fail(function() {
                    $('#chatMessages').html(`
                    <div class="text-center p-4 text-danger">
                        <i class="ri-error-warning-line fs-2"></i>
                        <p class="mt-2">Error loading messages</p>
                    </div>
                `);
                });
        }

        function openImageModal(src) {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImg = document.getElementById('modalImage');
            modalImg.src = src;
            modal.show();
        }

        function closeImageModal() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('imageModal'));
            if (modal) {
                modal.hide();
            }
        }

        function displayMessages(messages) {
            if (messages.length === 0) {
                $('#chatMessages').html(`
            <div class="text-center text-muted py-5">
                <i class="ri-chat-off-line fs-1 opacity-50"></i>
                <p class="mt-3">No messages in this conversation</p>
            </div>
        `);
                return;
            }

            let messagesHtml = '';
            let lastDate = '';

            messages.forEach(function(message) {
                const messageDate = new Date(message.created_at);
                const currentDate = messageDate.toDateString();

                // Date separator
                if (currentDate !== lastDate) {
                    messagesHtml += `
                <div class="text-center my-3">
                    <small class="badge bg-light text-muted px-3 py-1">
                        ${messageDate.toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        })}
                    </small>
                </div>
            `;
                    lastDate = currentDate;
                }

                const isExpertSender = (message.sender_id == currentExpertId);
                const bubbleClass = isExpertSender ? 'sent' : 'received';
                const senderName = `${message.sender.first_name} ${message.sender.last_name}`;

                // Build attachment preview HTML with clickable images
                let attachmentHtml = '';
                if (Array.isArray(message.attachments) && message.attachments.length > 0) {
                    attachmentHtml = message.attachments.map(filePath => {
                        const absoluteUrl = `{{ url('/') }}/${filePath}`;
                        const isImage = /\.(png|jpe?g|gif|bmp|webp)$/i.test(filePath);

                        return isImage ?
                            `<img src="${absoluteUrl}" alt="Attachment" onclick="openImageModal('${absoluteUrl}')"
                            style="max-width:150px; margin:5px 0; display:block; border-radius:8px; cursor:pointer;
                                   transition: transform 0.2s ease;"
                            onmouseover="this.style.transform='scale(1.05)'"
                            onmouseout="this.style.transform='scale(1)'" />` :
                            `<a href="${absoluteUrl}" target="_blank" style="display:block; margin:5px 0; color:#007bff; text-decoration:none;">📎 Download File</a>`;
                    }).join('');
                }

                messagesHtml += `
            <div class="message-bubble ${bubbleClass}">
                ${!isExpertSender ? `<div class="sender-name">${senderName}</div>` : ''}
                <div class="message-content">
                    <div class="message-text">${escapeHtml(message.message)}</div>
                    ${attachmentHtml}
                </div>
                <div class="message-time">
                    ${messageDate.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    })}
                </div>
            </div>
        `;
            });

            $('#chatMessages').html(`<div class="messages-container">${messagesHtml}</div>`);

            // Scroll to bottom
            setTimeout(() => {
                const chatContainer = document.getElementById('chatMessages');
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 50);
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Handle modal close
        $('#chatModal').on('hidden.bs.modal', function() {
            currentExpertId = null;
            currentPartnerId = null;
        });
    </script>
@endpush
