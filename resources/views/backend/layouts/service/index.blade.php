@extends('backend.app')

@section('title', 'Services')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('service.index') }}">Table</a></li>
                                <li class="breadcrumb-item active">Services</li>
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
                            <h5 class="card-title mb-0">All Service List</h5>
                            <button type="button" class="btn btn-primary btn-sm" id="addNewService">Add New
                                Service</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered table-striped align-middle dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Services Name</th>
                                            <th class="column-content">Platform Fee</th>
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

    {{-- Create Modal --}}
    <div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createServiceModalLabel">Create New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createServiceForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_services_name" class="form-label">Services Name:</label>
                            <input type="text" class="form-control" id="create_services_name" name="services_name"
                                placeholder="Please Enter Services Name">
                            <span class="text-danger error-text create_services_name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="create_platform_fee" class="form-label">Platform Fee:</label>
                            <input type="number" class="form-control" id="create_platform_fee" name="platform_fee"
                                placeholder="Please Enter Platform Fee">
                            <span class="text-danger error-text create_platform_fee_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editServiceForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_service_id" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_services_name" class="form-label">Services Name:</label>
                            <input type="text" class="form-control" id="edit_services_name" name="services_name"
                                placeholder="Please Enter Services Name">
                            <span class="text-danger error-text edit_services_name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="edit_platform_fee" class="form-label">Platform Fee:</label>
                            <input type="number" class="form-control" id="edit_platform_fee" name="platform_fee"
                                placeholder="Please Enter Platform Fee">
                            <span class="text-danger error-text edit_platform_fee_error"></span>
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

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
                    url: "{{ route('service.index') }}",
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
                        data: 'services_name',
                        name: 'services_name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'platform_fee',
                        name: 'platform_fee',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ],
                columnDefs: [{
                    targets: -1,
                    render: function(data, type, row) {
                        return `
                            <div class="hstack gap-3 fs-base">
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-service" data-id="${row.id}" title="Edit">
                                    <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="showDeleteConfirm('${row.id}')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        `;
                    },
                }],
            });

            // Show Create Modal
            $('#addNewService').click(function() {
                $('#createServiceModal').modal('show');
                $('#createServiceForm')[0].reset();
                $('.error-text').text('');
            });

            // Handle Create Form Submission
            $('#createServiceForm').submit(function(e) {
                e.preventDefault();
                $('.error-text').text('');
                let formData = $(this).serialize();

                axios.post("{{ route('service.store') }}", formData)
                    .then(function(response) {
                        if (response.data.success) {
                            $('#createServiceModal').modal('hide');
                            $('#createServiceForm')[0].reset();
                            table.ajax.reload();
                            toastr.success(response.data.message);
                        } else {
                            $.each(response.data.errors, function(key, value) {
                                $('.create_' + key + '_error').text(value[0]);
                            });
                            toastr.error('Please fix the errors.');
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                        toastr.error('An error occurred while creating the service.');
                    });
            });

            // Show Edit Modal (populate directly from DataTable row data)
            $(document).on('click', '.edit-service', function() {
                let tr = $(this).closest('tr');
                let rowData = table.row(tr).data();
                $('#edit_service_id').val(rowData.id);
                $('#edit_services_name').val(rowData.services_name);
                // Remove the trailing "%" if present in the platform fee display value.
                let fee = rowData.platform_fee;
                if (fee.indexOf('%') !== -1) {
                    fee = fee.replace('%', '');
                }
                $('#edit_platform_fee').val(fee);
                $('#editServiceModal').modal('show');
            });

            // Handle Edit Form Submission
            $('#editServiceForm').submit(function(e) {
                e.preventDefault();
                $('.error-text').text('');
                let formData = $(this).serialize();
                let serviceId = $('#edit_service_id').val();
                console.log('Edit form submitted for ID:', serviceId, 'Data:', formData);

                axios.put('{{ route('service.update', ':id') }}'.replace(':id', serviceId), formData)
                    .then(function(response) {
                        console.log('Update response:', response.data);
                        if (response.data.success) {
                            $('#editServiceModal').modal('hide');
                            $('#editServiceForm')[0].reset();
                            table.ajax.reload();
                            toastr.success(response.data.message);
                        } else {
                            $.each(response.data.errors, function(key, value) {
                                $('.edit_' + key + '_error').text(value[0]);
                            });
                            toastr.error('Please fix the errors.');
                        }
                    })
                    .catch(function(error) {
                        console.error('Error updating service:', error);
                        toastr.error('An error occurred while updating the service.');
                    });
            });
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
            let url = '{{ route('service.status', ':id') }}'.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {
                    console.log(resp);
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

        // Delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to delete this record?',
                text: 'If you delete this, it will be gone forever.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }

        // Delete Item
        function deleteItem(id) {
            let url = '{{ route('service.destroy', ':id') }}'.replace(':id', id);
            let csrfToken = '{{ csrf_token() }}';
            $.ajax({
                type: "DELETE",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload();
                    if (resp['t-success']) {
                        toastr.success(resp.message);
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
