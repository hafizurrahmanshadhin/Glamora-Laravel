@extends('backend.app')

@section('title', 'System Settings')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('system.index') }}">Settings</a></li>
                                <li class="breadcrumb-item active">System Settings</li>
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
                            <form method="POST" action="{{ route('system.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Please Enter Title"
                                                value="{{ old('title', $setting->title ?? '') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="system_name" class="form-label">System Name:</label>
                                            <input type="text"
                                                class="form-control @error('system_name') is-invalid @enderror"
                                                name="system_name" placeholder="Please Enter System Name" id="system_name"
                                                value="{{ old('system_name', $setting->system_name ?? '') }}">
                                            @error('system_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="email" class="form-label">Email:</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" placeholder="Please Enter Email"
                                                value="{{ old('email', $setting->email ?? '') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="phone_number" class="form-label">Phone Number:</label>
                                            <input type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" placeholder="Please Enter Phone Number" id="phone_number"
                                                value="{{ old('phone_number', $setting->phone_number ?? '') }}">
                                            @error('system_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div>
                                            <label for="address" class="form-label">Address:</label>
                                            <input type="text"
                                                class="form-control form-control @error('address') is-invalid @enderror"
                                                name="address" placeholder="Please Enter Copy Address"
                                                id="address"
                                                value="{{ old('address', $setting->address ?? '') }}">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div>
                                            <label for="copyright_text" class="form-label">Copy Rights Text:</label>
                                            <input type="text"
                                                class="form-control form-control @error('copyright_text') is-invalid @enderror"
                                                name="copyright_text" placeholder="Please Enter Copy Rights Text"
                                                id="copyright_text"
                                                value="{{ old('copyright_text', $setting->copyright_text ?? '') }}">
                                            @error('copyright_text')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="description" class="form-label">About System:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            placeholder="About System...">{{ old('description', $setting->description ?? '') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="logo" class="form-label">Logo:</label>
                                            <input type="hidden" name="remove_logo" value="0">
                                            <input class="form-control dropify @error('logo') is-invalid @enderror"
                                                type="file" name="logo" id="logo"
                                                data-default-file="@isset($setting){{ asset($setting->logo) }}@endisset">
                                            @error('logo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="favicon" class="form-label">Favicon:</label>
                                            <input type="hidden" name="remove_favicon" value="0">
                                            <input class="form-control dropify @error('favicon') is-invalid @enderror"
                                                type="file" name="favicon" id="favicon"
                                                data-default-file="@isset($setting){{ asset($setting->favicon) }}@endisset">
                                            @error('favicon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
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
