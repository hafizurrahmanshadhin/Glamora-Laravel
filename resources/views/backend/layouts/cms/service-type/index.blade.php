@extends('backend.app')

@section('title', 'Service Types')

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
            {{-- ─── Page Title / Breadcrumb ─────────────────────────────────────────────────── --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><i class="fas fa-layer-group me-2"></i>Service Types</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.service-type.index') }}" class="breadcrumb-item active">CMS</a>
                                </li>
                                <li class="breadcrumb-item">Service Types</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ──────────────────────────────────────────────────────────────────────────── --}}

            {{-- Success/Error Alerts --}}
            @if (session('t-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('t-success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('t-error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('t-error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- ─── “Create New Service Type” Form ─────────────────────────────────────────────── --}}
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card border-success">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-plus-circle me-2"></i>
                                Add New Service Type
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('cms.service-type.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row gy-4">
                                    {{-- Title --}}
                                    <div class="col-md-4">
                                        <label for="newTitle" class="form-label">Title<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="title" id="newTitle"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Enter service type title" value="{{ old('title') }}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-4">
                                        <label for="newDescription" class="form-label">Description<span
                                                class="text-danger">*</span></label>
                                        <textarea name="description" id="newDescription" rows="3"
                                            class="form-control @error('description') is-invalid @enderror" placeholder="Enter description" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Image --}}
                                    <div class="col-md-4">
                                        <label for="newImage" class="form-label">Image (optional)</label>
                                        <input type="file" name="image" id="newImage"
                                            class="form-control dropify @error('image') is-invalid @enderror"
                                            data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="20M">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save me-1"></i> Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ──────────────────────────────────────────────────────────────────────────── --}}

            {{-- ─── Existing Service Types – Editable Cards ──────────────────────────────────── --}}
            @foreach ($serviceTypes as $serviceType)
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="card border-secondary">
                            <div
                                class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-edit me-2"></i>
                                    Edit: {{ $serviceType->title ?? 'Untitled' }}
                                </h5>
                                {{-- Delete button --}}
                                <form method="POST" action="{{ route('cms.service-type.destroy', $serviceType->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this Service Type?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-light" data-bs-toggle="tooltip"
                                        title="Delete Service Type">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('cms.service-type.update', $serviceType->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="row gy-3">
                                        {{-- Title --}}
                                        <div class="col-md-4">
                                            <label for="title-{{ $serviceType->id }}" class="form-label">Title<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title-{{ $serviceType->id }}"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter service type title"
                                                value="{{ old('title', $serviceType->title) }}" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Description --}}
                                        <div class="col-md-4">
                                            <label for="description-{{ $serviceType->id }}"
                                                class="form-label">Description<span class="text-danger">*</span></label>
                                            <textarea name="description" id="description-{{ $serviceType->id }}" rows="3"
                                                class="form-control @error('description') is-invalid @enderror" placeholder="Enter description" required>{{ old('description', $serviceType->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Existing Image (if any) --}}
                                        <div class="col-md-4">
                                            <div class="mb-2">
                                                @if ($serviceType->image)
                                                    <label class="form-label d-block">Current Image:</label>
                                                    <img src="{{ asset($serviceType->image) }}" alt="Service Type Image"
                                                        class="img-fluid border mb-2" style="max-height: 120px;">
                                                @endif
                                            </div>
                                            <label for="image-{{ $serviceType->id }}" class="form-label">Replace
                                                Image</label>
                                            <input type="file" name="image" id="image-{{ $serviceType->id }}"
                                                class="form-control dropify @error('image') is-invalid @enderror"
                                                data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="20M"
                                                @if ($serviceType->image) data-default-file="{{ asset($serviceType->image) }}" @endif>
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_image"
                                                    id="remove_image-{{ $serviceType->id }}" value="1">
                                                <label class="form-check-label"
                                                    for="remove_image-{{ $serviceType->id }}">
                                                    Remove existing image
                                                </label>
                                            </div>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="fas fa-save me-1"></i> Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- ──────────────────────────────────────────────────────────────────────────── --}}
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Initialize CKEditor for each description textarea --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($serviceTypes as $serviceType)
                ClassicEditor
                    .create(document.querySelector('#description-{{ $serviceType->id }}'))
                    .catch(error => console.error(error));
            @endforeach

            // Also initialize the “Add New” description (if present)
            if (document.querySelector('#newDescription')) {
                ClassicEditor
                    .create(document.querySelector('#newDescription'))
                    .catch(error => console.error(error));
            }

            // Initialize Dropify on all .dropify inputs
            $('.dropify').dropify();
        });
    </script>
@endpush
