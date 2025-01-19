@extends('backend.app')

@section('title', 'Edit Service')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Start Page Title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('service.index') }}">Service</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Page Title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('service.update', $service->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        <label for="services_name" class="form-label">Services Name:</label>
                                        <input type="text"
                                            class="form-control @error('services_name') is-invalid @enderror"
                                            id="services_name" name="services_name" placeholder="Please Enter Services Name"
                                            value="{{ old('services_name', $service->services_name) }}">
                                        @error('services_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-xxl-12 col-md-12">
                                        <label for="platform_fee" class="form-label">Platform Fee:</label>
                                        <input type="number"
                                            class="form-control @error('platform_fee') is-invalid @enderror"
                                            id="platform_fee" name="platform_fee" placeholder="Please Enter Platform Fee"
                                            value="{{ old('platform_fee', $service->platform_fee) }}" step="0.01">
                                        @error('platform_fee')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('service.index') }}" class="btn btn-danger">Cancel</a>
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
