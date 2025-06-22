@extends('backend.app')

@section('title', 'Home Counter & Text')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">List of Home Counter & Text</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Content</th>
                                            <th class="column-content">Value</th>
                                            <th class="column-status">Status</th>
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

    {{-- Edit Modal Start --}}
    <div class="modal fade" id="editHomeCounterModal" tabindex="-1" aria-labelledby="editHomeCounterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHomeCounterModalLabel">Edit Home Counter & Text</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editHomeCounterForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_home_counter_id" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Content:</label>
                            <textarea class="form-control" id="title" name="title" rows="3" placeholder="Please Enter Content"></textarea>
                            <span class="text-danger error-text title"></span>
                        </div>

                        <div class="mb-3">
                            <label for="sub_title" class="form-label">Value:</label>
                            <input type="text" class="form-control" id="sub_title" name="sub_title"
                                placeholder="Please Enter Value">
                            <span class="text-danger error-text sub_title"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Modal End --}}
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
                        url: "{{ route('cms.home-counter.index') }}",
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
                            data: 'title',
                            name: 'title',
                            orderable: true,
                            searchable: true,
                            width: '75%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'sub_title',
                            name: 'sub_title',
                            orderable: false,
                            searchable: false,
                            width: '10%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '5%'
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



                // Click handler for the "edit-home-counter" links
                $(document).on('click', '.edit-home-counter', function() {
                    let tr = $(this).closest('tr');
                    let rowData = table.row(tr).data();

                    $('#edit_home_counter_id').val(rowData.id);
                    $('#title').val(rowData.title);
                    $('#sub_title').val(rowData.sub_title);

                    // Show modal
                    $('#editHomeCounterModal').modal('show');
                });

                // Submit edit form
                $('#editHomeCounterForm').submit(function(e) {
                    e.preventDefault();
                    $('.error-text').text('');

                    let formData = $(this).serialize();
                    let homeCounterId = $('#edit_home_counter_id').val();

                    axios.put("{{ route('cms.home-counter.update', 0) }}".replace('/0', '/' +
                            homeCounterId), formData)
                        .then(function(response) {
                            if (response.data.success) {
                                $('#editHomeCounterModal').modal('hide');
                                $('#editHomeCounterForm')[0].reset();
                                table.ajax.reload();
                                toastr.success(response.data.message);
                            } else {
                                // Validation errors
                                if (response.data.errors) {
                                    $.each(response.data.errors, function(key, value) {
                                        $('.' + key).text(value[0]);
                                    });
                                }
                                toastr.error('Please fix the errors.');
                            }
                        })
                        .catch(function(error) {
                            console.error('Error updating data:', error);
                            toastr.error('An error occurred while updating.');
                        });
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Status Change Confirm Alert
        function showStatusChangeAlert(id) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }

        // Status Change
        function statusChange(id) {
            let url = '{{ route('cms.home-counter.status', 0) }}'.replace('/0', '/' + id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload();
                    if (resp.success === true) {
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }
    </script>
@endpush
