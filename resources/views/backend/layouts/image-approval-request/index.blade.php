@extends('backend.app')

@section('title', 'Image Approval Request')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Request</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered table-striped align-middle dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Name</th>
                                            <th class="column-content">Email</th>
                                            <th class="column-content">Image</th>
                                            <th class="column-content">Status</th>
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

    {{-- Image Preview Modal Start --}}
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <img id="previewModalImage" src="" alt="Preview" style="max-width: 100%; height: auto;" />
                </div>
            </div>
        </div>
    </div>
    {{-- Image Preview Modal End --}}
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
                        url: "{{ route('image-approval-request.index') }}",
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
                            className: 'text-center',
                            orderable: false,
                            searchable: false,
                            width: '5%'
                        },
                        {
                            data: 'user_name',
                            name: 'user_name',
                            orderable: true,
                            searchable: true,
                            width: '30%',
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
                            width: '35%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: true,
                            searchable: true,
                            width: '10%',
                            className: 'text-center',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            className: 'text-center',
                            orderable: false,
                            searchable: false,
                            width: '20%'
                        },
                    ],
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Capture click on any link that triggers the modal
        $(document).on('click', '[data-bs-target="#imagePreviewModal"]', function(e) {
            e.preventDefault();
            const imageSrc = $(this).data('image-src');
            $('#previewModalImage').attr('src', imageSrc);
        });

        // Status Change using Axios
        function changeStatus(id, status) {
            let url = '{{ route('image-approval-request.status', ['userGallery' => '__ID__']) }}';
            url = url.replace('__ID__', id);

            axios.post(url, {
                    status: status,
                    _token: '{{ csrf_token() }}'
                })
                .then(function(response) {
                    let resp = response.data;
                    $('#datatable').DataTable().ajax.reload();

                    if (resp.status) {
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                })
                .catch(function(error) {
                    console.error(error);
                    toastr.error('An error occurred. Please try again.');
                });
        }
    </script>
@endpush
