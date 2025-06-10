@extends('backend.app')

@section('title', 'Questionnaires')

@push('styles')
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 100px !important;
            max-height: 150px !important;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.questionnaires.index') }}" class="breadcrumb-item active">CMS</a>
                                </li>
                                <li class="breadcrumb-item">questionnaires</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('cms.questionnaires.update.questionnaires') }}">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Title:</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" id="title" placeholder="Please Enter Title"
                                            value="{{ old('title', $questionnaires->title ?? '') }}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="main_description" name="description"
                                            placeholder="Enter any detailed information here...">{{ old('description', $questionnaires->description ?? '') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Questionnaires List</h5>
                            <button type="button" class="btn btn-primary btn-sm" id="addNewBlog">Add New
                                Questionnaires</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered table-striped align-middle dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Content</th>
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

    {{-- Create Modal Start --}}
    <div class="modal fade" id="createBlogModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="createBlogForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="create_description" class="form-control" rows="4"
                            placeholder="Please Enter Description"></textarea>
                        <span class="text-danger error-text create_description_error"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Create Modal End --}}

    {{-- Edit Modal Start --}}
    <div class="modal fade" id="editBlogModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editBlogForm" class="modal-content">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_blog_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea id="edit_description" name="description" class="form-control" rows="4"></textarea>
                        <span class="text-danger error-text edit_description_error"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Edit Modal End --}}

    {{-- Modal for viewing blog details start --}}
    <div class="modal fade" id="viewBlogModal" tabindex="-1" aria-labelledby="BlogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="BlogModalLabel" class="modal-title">Blog Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Dynamic data filled by JS --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for viewing blog details end --}}
@endsection


@push('scripts')
    <script>
        // Keep references to each CKEditor instance
        let mainEditor, createEditor, editEditor;

        // Main form CKEditor
        ClassicEditor.create(document.querySelector('#main_description'))
            .then(editor => mainEditor = editor)
            .catch(error => console.error(error));

        // Create-modal CKEditor
        ClassicEditor.create(document.querySelector('#create_description'))
            .then(editor => createEditor = editor)
            .catch(error => console.error(error));

        // Edit-modal CKEditor
        ClassicEditor.create(document.querySelector('#edit_description'))
            .then(editor => editEditor = editor)
            .catch(error => console.error(error));

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
                        url: "{{ route('cms.questionnaires.index') }}",
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
                            data: 'description',
                            name: 'description',
                            orderable: false,
                            searchable: false,
                            width: '65%',
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

                // "Add New Blog" button
                $('#addNewBlog').on('click', () => {
                    $('#createBlogForm')[0].reset();
                    $('.error-text').text('');
                    // Reset CKEditor data for create
                    if (createEditor) createEditor.setData('');
                    $('#createBlogModal').modal('show');
                });

                $('#createBlogForm').submit(e => {
                    e.preventDefault();
                    $('.error-text').text('');
                    axios.post("{{ route('cms.questionnaires.store') }}", new FormData(e
                            .target))
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                $('#createBlogModal').modal('hide');
                                table.ajax.reload();
                                toastr.success(data.message);
                            } else {
                                for (let [k, v] of Object.entries(data.errors || {})) {
                                    $(`.create_${k}_error`).text(v[0]);
                                }
                                toastr.error(data.message);
                            }
                        })
                        .catch(() => toastr.error('Something went wrong.'));
                });

                // Show Edit
                $(document).on('click', '.edit-blog', function() {
                    let row = table.row($(this).closest('tr')).data();
                    $('#edit_blog_id').val(row.id);
                    $('#edit_title').val(row.title);

                    // Set CKEditor data for edit
                    if (editEditor) {
                        editEditor.setData(row.description || '');
                    } else {
                        $('#edit_description').val(row.description || '');
                    }

                    $('.error-text').text('');
                    $('#editBlogModal').modal('show');
                });

                const updateBlogUrlTemplate =
                    "{{ route('cms.questionnaires.update', ['id' => ':id']) }}";

                // Update
                $('#editBlogForm').submit(e => {
                    e.preventDefault();
                    $('.error-text').text('');

                    // get the blog-id and build the real URL
                    const id = $('#edit_blog_id').val();
                    const url = updateBlogUrlTemplate.replace(':id', id);

                    // collect form data (includes _method=PUT)
                    const formData = new FormData(e.target);

                    // post it
                    axios.post(url, formData)
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                $('#editBlogModal').modal('hide');
                                table.ajax.reload();
                                toastr.success(data.message);
                            } else {
                                // validation errors
                                for (let [field, msgs] of Object.entries(data.errors || {})) {
                                    $(`.edit_${field}_error`).text(msgs[0]);
                                }
                                toastr.error(data.message);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            toastr.error('Something went wrong.');
                        });
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Fetch and display blog details in the modal
        async function showBlogDetails(id) {
            let url = '{{ route('cms.questionnaires.show', ['id' => ':id']) }}';
            url = url.replace(':id', id);

            try {
                let response = await axios.get(url);
                if (response.data && response.data.data) {
                    let data = response.data.data;
                    let modalBody = document.querySelector('#viewBlogModal .modal-body');
                    modalBody.innerHTML = `
                        <p><strong>Description:</strong> ${data.description}</p>
                    `;
                } else {
                    toastr.error('No data returned from the server.');
                }
            } catch (error) {
                console.error(error);
                toastr.error('Could not fetch blog details.');
            }
        }

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
            let url = '{{ route('cms.questionnaires.status', ['id' => ':id']) }}'.replace(':id', id);

            axios.get(url)
                .then(function(response) {
                    // console.log(response.data);
                    // Reload your DataTable
                    $('#datatable').DataTable().ajax.reload();

                    if (response.data.status === true) {
                        toastr.success(response.data.message);
                    } else if (response.data.errors) {
                        toastr.error(response.data.errors[0]);
                    } else {
                        toastr.error(response.data.message);
                    }
                })
                .catch(function(error) {
                    toastr.error('An error occurred. Please try again.');
                    console.error(error);
                });
        }

        // delete Confirm
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

        // Delete Button
        function deleteItem(id) {
            const url = '{{ route('cms.questionnaires.destroy', ['id' => ':id']) }}'.replace(':id', id);

            axios.delete(url, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(function(response) {
                    $('#datatable').DataTable().ajax.reload();
                    if (response.data.status === true) {
                        toastr.success(response.data.message);
                    } else if (response.data.errors) {
                        toastr.error(response.data.errors[0]);
                    } else {
                        toastr.error(response.data.message);
                    }
                })
                .catch(function(error) {
                    toastr.error('An error occurred. Please try again.');
                    console.error(error);
                });
        }
    </script>
@endpush
