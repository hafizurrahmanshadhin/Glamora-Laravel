@extends('backend.app')

@section('title', 'Clients Feedback Update')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('clients-feedback.index') }}">Clients
                                        Feedback</a>
                                </li>
                                <li class="breadcrumb-item active">Update</li>
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
                            <form action="{{ route('clients-feedback.update', ['id' => $clientsFeedback->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        <div>
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Please Enter Name"
                                                value="{{ $clientsFeedback->name ?? '' }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-12 col-md-12">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" placeholder="Please Enter Title"
                                                value="{{ $clientsFeedback->title ?? '' }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-12 col-md-12">
                                        <label for="rating" class="form-label">Rating:</label>
                                        <input type="number" step="1" min="0" max="5"
                                            class="form-control @error('rating') is-invalid @enderror"
                                            placeholder="Please enter your rating" name="rating" id="rating"
                                            value="{{ old('rating', $clientsFeedback->rating) }}">
                                        @error('rating')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="description" class="form-label">Content:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            placeholder="Type here...">{!! $clientsFeedback->description ?? '' !!}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('clients-feedback.index') }}" class="btn btn-danger">Cancel</a>
                                    </div>
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
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
