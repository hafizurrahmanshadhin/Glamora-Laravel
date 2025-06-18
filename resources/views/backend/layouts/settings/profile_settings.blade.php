@extends('backend.app')

@section('title', 'Profile Settings')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-3">
                    <div class="card overflow-hidden">
                        <div class="cover-photo-wrapper">
                            <img src="{{ Auth::user()->cover_photo ? asset(Auth::user()->cover_photo) : asset('backend/images/small/img-7.jpg') }}"
                                alt="Cover Photo" class="card-img-top profile-wid-img object-fit-cover" style="height: 200px;">
                            <div>
                                <input id="cover_photo_input" type="file" class="cover_photo_input d-none">
                                <label for="cover_photo_input"
                                    class="profile-photo-edit btn btn-light btn-sm position-absolute end-0 top-0 m-3">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Edit Cover Photo
                                </label>
                            </div>
                        </div>
                        <div class="card-body pt-0 mt-n5">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto">
                                    <div class="profile-picture-wrapper">
                                        <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('backend/images/default_images/user_1.jpg') }}"
                                            alt="Profile Picture"
                                            class="avatar-lg rounded-circle object-fit-cover border-0 img-thumbnail user-profile-image">
                                    </div>
                                    <div
                                        class="avatar-xs p-0 rounded-circle profile-photo-edit position-absolute end-0 bottom-0">
                                        <input id="profile_picture_input" type="file"
                                            class="profile_picture_input d-none">
                                        <label for="profile_picture_input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="bi bi-camera"></i>
                                            </span>
                                        </label>
                                    </div>

                                    <style>
                                        .profile-picture-wrapper {
                                            width: 150px;
                                            height: 150px;
                                            border-radius: 50%;
                                            overflow: hidden;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                        }

                                        .profile-picture-wrapper img {
                                            width: 100%;
                                            height: 100%;
                                            object-fit: cover;
                                        }

                                        @media (max-width: 768px) {
                                            .profile-picture-wrapper {
                                                width: 100px;
                                                height: 100px;
                                            }
                                        }
                                    </style>
                                </div>

                                <div class="mt-3">
                                    <h3>{{ ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) ?? '' }}<i
                                            class="bi bi-patch-check-fill align-baseline text-info ms-1"></i></h3>
                                    <h6 class="text-muted">{{ Auth::user()->email ?? '' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xxl-9">
                    <div class="d-flex align-items-center flex-wrap gap-2 mb-4">
                        <ul class="nav nav-pills arrow-navtabs nav-secondary gap-2 flex-grow-1 order-2 order-lg-1"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab"
                                    aria-selected="true">
                                    Personal Details
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    Changes Password
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Personal Details</h6>
                                </div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('update.profile') }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        id="first_name" name="first_name"
                                                        placeholder="Enter Your First Name"
                                                        value="{{ Auth::user()->first_name }}">
                                                    @error('first_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        id="last_name" name="last_name" placeholder="Enter Your Last Name"
                                                        value="{{ Auth::user()->last_name }}">
                                                    @error('last_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email" placeholder="Enter Your Email"
                                                        value="{{ Auth::user()->email }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Changes Password</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('update.Password') }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-2 justify-content-lg-between align-items-center">
                                            <div class="col-lg-4">
                                                <div class="auth-pass-inputgroup">
                                                    <label for="old_password" class="form-label">Current Password*</label>
                                                    <div class="position-relative">
                                                        <input type="password"
                                                            class="form-control password-input @error('old_password') is-invalid @enderror"
                                                            name="old_password" id="old_password"
                                                            placeholder="Enter Current Password">
                                                        @error('old_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <button
                                                            class="btn btn-link position-absolute top-0 end-0 text-decoration-none text-muted password-addon"
                                                            type="button"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="auth-pass-inputgroup">
                                                    <label for="password" class="form-label">New Password*</label>
                                                    <div class="position-relative">
                                                        <input type="password"
                                                            class="form-control password-input @error('password') is-invalid @enderror"
                                                            name="password" id="password" onpaste="return false"
                                                            placeholder="Enter New Password">
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="auth-pass-inputgroup">
                                                    <label for="password_confirmation" class="form-label">Confirm
                                                        Password*</label>
                                                    <div class="position-relative">
                                                        <input type="password"
                                                            class="form-control password-input @error('password_confirmation') is-invalid @enderror"
                                                            onpaste="return false" name="password_confirmation"
                                                            id="password_confirmation"
                                                            placeholder="Enter Confirm Password">
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-success">Change
                                                        Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle file input change
            const profileInput = document.getElementById('profile_picture_input');
            profileInput.addEventListener('change', function() {
                const file = profileInput.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('profile_picture', file);
                formData.append('_token', '{{ csrf_token() }}');

                axios.post('{{ route('update.profile.picture') }}', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            const newImageUrl = response.data.image_url;

                            // Update profile picture on the page
                            document.querySelector('.profile-picture-wrapper img').src = newImageUrl;

                            // Optionally update images elsewhere in the UI
                            document.querySelectorAll('.profile-img-change').forEach(img => {
                                img.src = newImageUrl;
                            });

                            // Show success notification
                            toastr.success('Profile Picture Updated Successfully.');
                        } else {
                            toastr.error(response.data.message || 'An error occurred.');
                        }
                    })
                    .catch(error => {
                        toastr.error('Failed to Update Profile Picture.');
                    });

                // Preview selected image immediately
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Preview image in the profile section
                    document.querySelector('.profile-picture-wrapper img').src = e.target.result;

                    // Preview image in the header
                    const headerImage = document.querySelector('.header-profile-user');
                    if (headerImage) {
                        headerImage.src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle file input change
            const coverPhoto = document.getElementById('cover_photo_input');
            coverPhoto.addEventListener('change', function() {
                const file = coverPhoto.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('cover_photo', file);
                formData.append('_token', '{{ csrf_token() }}');

                axios.post('{{ route('update.cover.photo') }}', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            const newImageUrl = response.data.image_url;

                            // Update profile picture on the page
                            document.querySelector('.cover-photo-wrapper img').src = newImageUrl;

                            // Optionally update images elsewhere in the UI
                            document.querySelectorAll('.cover-photo-change').forEach(img => {
                                img.src = newImageUrl;
                            });

                            // Show success notification
                            toastr.success('Cover Photo Updated Successfully.');
                        } else {
                            toastr.error(response.data.message || 'An error occurred.');
                        }
                    })
                    .catch(error => {
                        toastr.error('Failed to Updated Cover Photo.');
                    });

                // Preview selected image immediately
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.cover-photo-wrapper img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
