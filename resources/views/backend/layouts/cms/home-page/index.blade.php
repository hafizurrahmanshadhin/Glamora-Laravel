@extends('backend.app')

@section('title', 'Home Page Image')

@push('styles')
    <style>
        .image-card {
            position: relative;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .image-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        /* Updated to show full image ratio */
        .card-img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .image-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 0.5rem;
        }

        .grid-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .empty-state {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 2rem;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Home Page Images Gallery</h5>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addImageModal">
                                <i class="ri-add-line align-middle me-1"></i> Add New Image
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row" id="image-grid">
                                {{-- Dynamic images will be loaded here --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Upload New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadImageForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Select Image</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                            <div class="form-text">Allowed formats: jpeg, png, jpg, gif (Max size: 20MB)</div>
                            <div class="invalid-feedback" id="imageError"></div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-upload-line align-middle me-1"></i> Upload Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            loadImages();

            // Handle form submission for adding a new image
            document.getElementById('uploadImageForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                // Clear previous errors
                $('#image').removeClass('is-invalid');
                $('#imageError').text('');

                axios.post("{{ route('cms.home-page.store') }}", formData, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    if (response.data.status) {
                        toastr.success(response.data.message);
                        $('#addImageModal').modal('hide');
                        loadImages();
                        this.reset();
                    } else {
                        toastr.error(response.data.message);
                    }
                }).catch(error => {
                    handleFormErrors(error);
                });
            });
        });

        function loadImages() {
            axios.get("{{ route('cms.home-page.index') }}", {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(response => {
                    const images = response.data.data;
                    let html = '';

                    if (images && images.length > 0) {
                        images.forEach((image) => {
                            html += `
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="image-card">
                                <div class="image-actions">
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${image.id}">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                                <img src="{{ asset('') }}${image.image}" class="card-img" alt="Home page image">
                            </div>
                        </div>`;
                        });
                    } else {
                        html = `
                    <div class="col-12">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="ri-image-line display-4 text-muted"></i>
                            </div>
                            <h4 class="mt-3">No Images Found</h4>
                            <p class="text-muted">Start by uploading new images using the "Add New Image" button</p>
                        </div>
                    </div>`;
                    }

                    $('#image-grid').html(html);
                    initializeDeleteButtons();
                })
                .catch(error => {
                    $('#image-grid').html(`
                    <div class="col-12">
                        <div class="alert alert-danger">
                            Error loading images: ${error.message}
                        </div>
                    </div>
                `);
                });
        }

        function initializeDeleteButtons() {
            $('.delete-btn').off('click').on('click', function() {
                const imageId = $(this).data('id');
                confirmDelete(imageId);
            });
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete("{{ route('cms.home-page.destroy', '') }}/" + id, {
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (response.data.status) {
                                toastr.success(response.data.message);
                                loadImages();
                            }
                        })
                        .catch(error => {
                            toastr.error(error.response?.data?.message || 'Error deleting image');
                        });
                }
            });
        }

        function handleFormErrors(error) {
            const errors = error.response?.data?.errors;
            if (error.response?.status === 422 && errors) {
                Object.keys(errors).forEach(field => {
                    const errorMessage = errors[field][0];
                    const inputField = document.getElementById(field);
                    if (inputField) {
                        inputField.classList.add('is-invalid');
                        const errorElement = document.getElementById(`${field}Error`);
                        if (errorElement) {
                            errorElement.textContent = errorMessage;
                        }
                    }
                });
            } else {
                toastr.error(error.response?.data?.message || 'An error occurred. Please try again.');
            }
        }
    </script>
@endpush
