@extends('backend.app')

@section('title', 'Privacy Policy')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('privacy-policy.index') }}">Settings</a></li>
                                <li class="breadcrumb-item active">Privacy Policy</li>
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
                            <form method="POST" action="{{ route('privacy-policy.update') }}">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Please Enter Title"
                                                value="{{ old('title', $privacy_policy->title ?? '') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="disabledInput" class="form-label">Slug:</label>
                                            <input type="text" class="form-control" id="disabledInput" value="{{ $privacy_policy->slug ?? '' }}" disabled="">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="content" class="form-label">Content:</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                                            placeholder="Privacy Policy">{{ old('content', $privacy_policy->content ?? '') }}</textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
