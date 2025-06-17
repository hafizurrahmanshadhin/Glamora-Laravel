@extends('backend.app')

@section('title', 'Booking Cancellation List')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Booking Cancellation List Before Payment</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Canceled By</th>
                                            <th class="column-content">Requested By</th>
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

    {{-- Modal for viewing cancellation details start --}}
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="UserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="UserModalLabel" class="modal-title">Cancellation Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Filled via JS --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for viewing cancellation details end --}}
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
                        url: "{{ route('before-payment.index') }}",
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
                            width: '5%',
                        },
                        {
                            data: 'canceled_by_name',
                            name: 'canceled_by_name',
                            orderable: true,
                            searchable: true,
                            width: '40%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'requested_by_name',
                            name: 'requested_by_name',
                            orderable: true,
                            searchable: true,
                            width: '45%',
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
                            width: '10%',
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
        function showUserDetails(id) {
            let url = '{{ route('before-payment.show', ['id' => ':id']) }}'.replace(':id', id);

            axios.get(url)
                .then(function(response) {
                    // Because the response now has { status, message, code, data: {...} }
                    const responseData = response.data.data;

                    // Convert service string into an array if needed
                    let servicesList = [];
                    if (typeof responseData.services === 'string' && responseData.services !== 'N/A') {
                        servicesList = responseData.services.split(',').map(s => s.trim());
                    }

                    // Build a list for the service names
                    let servicesHtml = '';
                    if (servicesList.length > 0) {
                        servicesList.forEach(function(service, index) {
                            servicesHtml += `<li>${service}</li>`;
                        });
                    } else {
                        servicesHtml = '<li>N/A</li>';
                    }

                    // Render final HTML
                    const modalBody = document.querySelector('#viewUserModal .modal-body');
                    modalBody.innerHTML = `
                    <div style="line-height:1.6;">
                        <h6><b>Canceled By:</b></h6>
                        <p>
                            <strong>Name:</strong> ${responseData.canceled_by_name}<br/>
                            <strong>Email:</strong> ${responseData.canceled_by_email}
                        </p>
                        <hr>
                        <h6><b>Requested By:</b></h6>
                        <p>
                            <strong>Name:</strong> ${responseData.requested_by_name}<br/>
                            <strong>Email:</strong> ${responseData.requested_by_email}
                        </p>
                        <hr>
                        <h6><b>Requested Services:</b></h6>
                        <ol>
                            ${servicesHtml}
                        </ol>
                    </div>
                `;
                })
                .catch(function(error) {
                    console.error(error);
                    toastr.error('Could not fetch details.');
                });
        }
    </script>
@endpush
