@extends('backend.app')

@section('title', 'Auth Page Image')

@push('styles')
    <style>
        .auth-image-card {
            border-radius: 0.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            text-align: center;
            padding: 20px;
        }

        .auth-image {
            max-width: 100%;
            max-height: 300px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .update-btn {
            margin-top: 10px;
        }

        .file-input {
            display: none;
        }

        .custom-file-label {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <h4 class="mb-0">Auth Page Image</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card auth-image-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Current Auth Page Image</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                @if ($currentImage)
                                    <img src="{{ asset($currentImage->image) }}" alt="Auth Page Image" class="auth-image"
                                        id="currentImagePreview">
                                @else
                                    <div class="alert alert-info">No Auth Page Image set. Please upload one.</div>
                                @endif
                            </div>
                            <hr>
                            <form id="updateImageForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 text-center">
                                    <label for="image" class="form-label custom-file-label btn btn-secondary">
                                        Choose Image
                                    </label>
                                    <input type="file" class="form-control file-input" name="image" id="image"
                                        accept="image/*">
                                    <div class="invalid-feedback" id="imageError"></div>
                                </div>
                                <div id="newImagePreviewContainer" class="mb-3 text-center" style="display:none;">
                                    <h6>New Image Preview:</h6>
                                    <img id="newImagePreview" src="#" alt="New Image Preview" class="auth-image">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary update-btn">
                                        <i class="ri-upload-line align-middle me-1"></i> Update Image
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Clear file input value when clicked to ensure change event fires
            $('#image').on('click', function() {
                this.value = null;
            });

            // Live preview for the new image.
            $("#image").on("change", function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $("#newImagePreview").attr("src", e.target.result);
                        $("#newImagePreviewContainer").fadeIn();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $("#newImagePreviewContainer").fadeOut();
                }
            });

            // Handle image update form submission.
            $('#updateImageForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                // Clear previous errors.
                $('#image').removeClass('is-invalid');
                $('#imageError').text('');

                axios.post("{{ route('cms.auth-page.store') }}", formData, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    if (response.data.status) {
                        toastr.success(response.data.message);
                        if (response.data.newImageUrl) {
                            $("#currentImagePreview").attr("src", response.data.newImageUrl);
                        } else {
                            location.reload();
                        }
                        $('#updateImageForm')[0].reset();
                        $("#newImagePreviewContainer").fadeOut();
                    } else {
                        toastr.error(response.data.message);
                    }
                }).catch(error => {
                    handleFormErrors(error);
                });
            });
        });

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
