@extends('backend.app')

@section('title', 'Edit Service Type')

@push('styles')
    <style>
        .dropify-wrapper {
            height: 285px;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Page breadcrumb --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.service-type.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.service-type.index') }}">Service Types</a>
                                </li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Success/Error Messages --}}
            @if (session('t-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('t-success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('t-error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('t-error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Edit form --}}
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-edit me-1"></i>
                                Edit Service Type
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('cms.service-type.update', $serviceType->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Title:</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" id="title" placeholder="Enter Title"
                                            value="{{ old('title', $serviceType->title ?? '') }}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                            placeholder="About Service Type..." required>{{ old('description', $serviceType->description ?? '') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image" class="form-label">Image (optional):</label>
                                        <input type="hidden" name="remove_image" value="0">
                                        <input class="form-control dropify @error('image') is-invalid @enderror"
                                            type="file" name="image" id="image"
                                            data-default-file="@if ($serviceType->image) {{ asset($serviceType->image) }} @endif">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small class="text-muted">
                                            If you want to remove the existing image, click the “remove” button on the
                                            preview.
                                        </small>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary mt-2">
                                            <i class="fas fa-save me-1"></i>
                                            Update Service Type
                                        </button>
                                        <a href="{{ route('cms.service-type.index') }}" class="btn btn-secondary mt-2">
                                            <i class="fas fa-arrow-left me-1"></i>
                                            Back to List
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> {{-- end card --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function() {
            $('.dropify').dropify();

            // If user clicks remove on dropify, set remove_image=1
            $('#image').on('dropify.afterClear', function() {
                $('input[name="remove_image"]').val('1');
            });
        });
    </script>
@endpush
