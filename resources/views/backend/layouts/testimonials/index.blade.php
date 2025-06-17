@extends('backend.app')

@section('title', 'Testimonial List')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Testimonial List</h5>
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
                                            <th class="column-content">Review</th>
                                            <th class="column-content text-center">Rating</th>
                                            <th class="column-content">Status</th>
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

    {{-- Modal for viewing user details --}}
    <div class="modal fade" id="viewTestimonialModal" tabindex="-1" aria-labelledby="TestimonialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="TestimonialModalLabel" class="modal-title">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="testimonialName"></span></p>
                    <p><strong>Review:</strong> <span id="testimonialEmail"></span></p>
                    <p><strong>Rating:</strong> <span id="testimonialRole"></span></p>
                    <p><strong>Status:</strong> <span id="testimonialStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        url: "{{ route('testimonial.index') }}",
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
                            data: 'name',
                            name: 'name',
                            orderable: true,
                            searchable: true,
                            width: '25%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'review',
                            name: 'review',
                            orderable: true,
                            searchable: true,
                            width: '40%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'rating',
                            name: 'rating',
                            orderable: true,
                            searchable: true,
                            className: 'text-center w-sm-25',
                            width: '5%'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false,
                            className: 'text-center w-sm-25',
                            width: '20%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center w-sm-25',
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

        // Fetch and display testimonial details
        function showTestimonialDetails(id) {
            let url = '{{ route('testimonial.show', ['id' => ':id']) }}';
            url = url.replace(':id', id);

            axios.get(url)
                .then(function(response) {
                    let data = response.data;
                    $('#testimonialName').text(data.name);
                    $('#testimonialEmail').text(data.review);
                    $('#testimonialRole').text(data.rating);
                    $('#testimonialStatus').text(data.status);
                })
                .catch(function(error) {
                    console.error(error);
                    toastr.error('Could not fetch user details.');
                });
        }

        // Status Change
        function changeStatus(id, status) {
            let url = '{{ route('testimonial.status', ['id' => ':id']) }}'.replace(':id', id);
            url = url.replace(':id', id);

            axios.post(url, {
                    status: status,
                    _token: '{{ csrf_token() }}'
                })
                .then(function(response) {
                    let resp = response.data;
                    console.log(resp);
                    $('#datatable').DataTable().ajax.reload();
                    if (resp.success === true) {
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
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
