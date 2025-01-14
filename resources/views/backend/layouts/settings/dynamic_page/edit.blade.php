@extends('backend.app')

@section('title', 'Dynamic Page Update')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('settings.dynamic_page.index') }}">Settings</a>
                                </li>
                                <li class="breadcrumb-item active">Dynamic Page</li>
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
                            <form action="{{ route('settings.dynamic_page.update', ['id' => $data->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        <div>
                                            <label for="page_title" class="form-label">Title:</label>
                                            <input type="text"
                                                class="form-control @error('page_title') is-invalid @enderror"
                                                id="page_title" name="page_title" placeholder="Please Enter Title"
                                                value="{{ $data->page_title ?? '' }}">
                                            @error('page_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="page_content" class="form-label">Content:</label>
                                        <textarea class="form-control @error('page_content') is-invalid @enderror" id="page_content" name="page_content"
                                            placeholder="Please Enter Content...">{!! $data->page_content ?? '' !!}</textarea>
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
