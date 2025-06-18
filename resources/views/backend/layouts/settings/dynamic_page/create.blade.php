@extends('backend.app')

@section('title', 'Dynamic Page Create')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('settings.dynamic_page.store') }}" method="POST">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        <div>
                                            <label for="page_title" class="form-label">Title:</label>
                                            <input type="text"
                                                class="form-control @error('page_title') is-invalid @enderror"
                                                id="page_title" name="page_title" placeholder="Please Enter Title"
                                                value="{{ old('page_title') }}">
                                            @error('page_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="page_content" class="form-label">Content:</label>
                                        <textarea class="form-control @error('page_content') is-invalid @enderror" id="page_content" name="page_content"
                                            placeholder="Please Enter Content...">{{ old('page_content') }}</textarea>
                                        @error('page_content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('settings.dynamic_page.index') }}"
                                            class="btn btn-danger">Cancel</a>
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
            .create(document.querySelector('#page_content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
