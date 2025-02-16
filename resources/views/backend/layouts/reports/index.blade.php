@extends('backend.app')

@section('title', 'Report List')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('report.index') }}">Table</a></li>
                                <li class="breadcrumb-item active">Report List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Report List</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="column-id">#</th>
                                        <th class="column-content">Report From</th>
                                        <th class="column-content">Report To</th>
                                        <th class="column-content">Message</th>
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

    {{-- Modal for viewing report details --}}
    <div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="ReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="ReportModalLabel" class="modal-title">Report Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

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
                        url: "{{ route('report.index') }}",
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
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                        {
                            data: 'report_from',
                            name: 'report_from',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'report_to',
                            name: 'report_to',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'message',
                            name: 'message',
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                    ],
                });

                $('#datatable').on('draw.dt', function() {
                    $('td.column-action').each(function() {
                        let buttonCount = $(this).find('button').length;
                        let width = 5 + (buttonCount - 1) * 5;
                        $(this).css('width', width + '%');
                    });
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Fetch and display report details
        function showReportDetails(id) {
            let url = '{{ route('report.show', ':id') }}';
            url = url.replace(':id', id);

            axios.get(url)
                .then(function(response) {
                    let data = response.data;
                    let modalBody = document.querySelector('#viewReportModal .modal-body');

                    modalBody.innerHTML = `
                        <p><strong>Report From:</strong> ${data.report_from}</p>
                        <p><strong>Report To:</strong> ${data.report_to}</p>
                        <p><strong>Message:</strong> ${data.message}</p>
                    `;
                })
                .catch(function(error) {
                    console.error(error);
                    toastr.error('Could not fetch report details.');
                });
        }
    </script>
@endpush
