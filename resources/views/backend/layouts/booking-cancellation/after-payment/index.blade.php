@extends('backend.app')

@section('title', 'Booking Cancellation List')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Booking Cancellation List After Payment</h5>
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
                                            <th class="column-content">Phone Number</th>
                                            <th class="column-content">Comment</th>
                                            <th class="column-content text-center">Ban Status</th>
                                            <th class="column-content text-center">Action</th>
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

    {{-- Modal for banning a user start --}}
    <div class="modal fade" id="banUserModal" tabindex="-1" aria-labelledby="banUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banUserModalLabel">Ban User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="banUserForm">
                        <input type="hidden" id="banUserId">
                        <div class="mb-3">
                            <label for="banDuration" class="form-label">Select Ban Duration</label>
                            <select class="form-select" id="banDuration" required>
                                <option value="">Choose duration</option>
                                <option value="1">1 day</option>
                                <option value="3">3 days</option>
                                <option value="5">5 days</option>
                                <option value="7">7 days</option>
                                <option value="10">10 days</option>
                                <option value="15">15 days</option>
                                <option value="30">30 days</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" onclick="banUser()">Ban User</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for banning a user end --}}

    {{-- Modal for adding a comment start --}}
    <div class="modal fade" id="commentUserModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="commentUserForm">
                        <input type="hidden" id="commentUserId">
                        <div class="mb-3">
                            <label for="commentText" class="form-label">Enter Comment</label>
                            <textarea class="form-control" id="commentText" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" onclick="submitComment()">Save Comment</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for adding a comment end --}}

    {{-- Modal to show full comment start --}}
    <div class="modal fade" id="fullCommentModal" tabindex="-1" aria-labelledby="fullCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullCommentModalLabel">Full Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="fullCommentText">
                    {{-- Dynamic Data --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal to show full comment end --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Helper to safely escape HTML in JS
            function escapeHtml(text) {
                return text ? text.replace(/[\"&'\/<>]/g, function(a) {
                    return {
                        '"': '&quot;',
                        '&': '&amp;',
                        "'": '&#39;',
                        '/': '&#47;',
                        '<': '&lt;',
                        '>': '&gt;'
                    } [a];
                }) : '';
            }

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            if (!$.fn.DataTable.isDataTable('#datatable')) {
                var table = $('#datatable').DataTable({
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
                        url: "{{ route('after-payment.index') }}",
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
                    // Turn off autoWidth so column widths are respected.
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
                            data: 'canceled_by_name',
                            name: 'canceled_by_name',
                            orderable: true,
                            searchable: true,
                            width: '15%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'email',
                            name: 'email',
                            orderable: true,
                            searchable: true,
                            width: '20%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'phone_number',
                            name: 'phone_number',
                            orderable: true,
                            searchable: true,
                            width: '10%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: null,
                            name: 'admin_comment',
                            render: function(data) {
                                return `<a href="javascript:void(0)" style="color:black; text-decoration:none; cursor:pointer; white-space:normal;word-break:break-word;" onclick="showFullCommentModal('${escapeHtml(data.full_comment)}')">
                                            ${escapeHtml(data.admin_comment)}
                                        </a>`;
                            },
                            orderable: false,
                            searchable: false,
                            width: '35%',
                        },
                        {
                            data: 'ban_status',
                            name: 'ban_status',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '10%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
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
    </script>

    <script>
        function showBanModal(userId) {
            $('#banUserId').val(userId);
            $('#banUserModal').modal('show');
        }

        function banUser() {
            var userId = $('#banUserId').val();
            var duration = $('#banDuration').val();
            if (!duration) {
                alert('Please select a ban duration.');
                return;
            }
            axios.post("{{ route('user.ban') }}", {
                    user_id: userId,
                    duration: duration
                })
                .then(function(response) {
                    toastr.success(response.data.message);
                    $('#banUserModal').modal('hide');
                    // Reload the DataTable to reflect changes
                    $('#datatable').DataTable().ajax.reload(null, false);
                })
                .catch(function(error) {
                    toastr.error('Failed to ban user.');
                });
        }
    </script>

    <script>
        function showCommentModal(userId) {
            // Get the DataTable instance
            var table = $('#datatable').DataTable();
            // Find the row data matching the given userId
            var rowData = table.rows().data().toArray().find(function(row) {
                return row.id == userId;
            });
            // If an existing comment is found and is not 'N/A', populate the textarea
            if (rowData && rowData.full_comment && rowData.full_comment !== 'N/A') {
                $('#commentText').val(rowData.full_comment);
            } else {
                $('#commentText').val('');
            }
            $('#commentUserId').val(userId);
            $('#commentUserModal').modal('show');
        }

        function submitComment() {
            var userId = $('#commentUserId').val();
            var comment = $('#commentText').val();

            axios.post("{{ route('admin-comment') }}", {
                    user_id: userId,
                    comment: comment
                })
                .then(function(response) {
                    toastr.success(response.data.message);
                    $('#commentUserModal').modal('hide');
                    // Reload the DataTable so the updated comment shows
                    $('#datatable').DataTable().ajax.reload(null, false);
                })
                .catch(function(error) {
                    toastr.error('Failed to save comment.');
                });
        }
    </script>

    <script>
        function showFullCommentModal(comment) {
            document.getElementById('fullCommentText').textContent = comment;
            $('#fullCommentModal').modal('show');
        }
    </script>
@endpush
