@extends('frontend.app')

@section('title', 'Edit Service Information')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/custom-downloaded-cdn/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/service-provider-step-form.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/custom-downloaded-cdn/flatpickr.min.css') }}" />
    <script src="{{ asset('frontend/custom-downloaded-cdn/flatpickr.js') }}"></script>
    <link href="{{ asset('frontend/custom-downloaded-cdn/aos.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/loader-logo.css') }}" />
@endpush

@section('content')
    <form method="POST" action="{{ route('update-service-information', $user->id) }}" enctype="multipart/form-data"
        id="main-form">
        @csrf
        @method('PATCH')
        <input type="hidden" name="step" id="current-step" value="1">
        <div class="section-padding-x m-top m-bottom">
            {{-- step 1 start --}}
            <div id="service-provider-step-form-1">
                <div class="img-content">
                    <img src="{{ asset('frontend/images/dashboard-banner-right.png') }}" alt="">
                </div>

                <div class="text-content">
                    <div class="step-count-title">
                        <span>1</span>/5 Update Profile
                    </div>
                    <div class="step-title">Tell Us About You and Your Business</div>
                    <div class="step-sub-title mt-5">Upload your profile photo</div>

                    <div class="step-upload-profile-container mt-3">
                        <label for="upload-profile-input" class="upload-profile-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M20 15V25M25 20H15M35 20C35 21.9698 34.612 23.9204 33.8582 25.7403C33.1044 27.5601 31.9995 29.2137 30.6066 30.6066C29.2137 31.9995 27.5601 33.1044 25.7403 33.8582C23.9204 34.612 21.9698 35 20 35C18.0302 35 16.0796 34.612 14.2597 33.8582C12.4399 33.1044 10.7863 31.9995 9.3934 30.6066C8.00052 29.2137 6.89563 27.5601 6.14181 25.7403C5.38799 23.9204 5 21.9698 5 20C5 16.0218 6.58035 12.2064 9.3934 9.3934C12.2064 6.58035 16.0218 5 20 5C23.9782 5 27.7936 6.58035 30.6066 9.3934C33.4196 12.2064 35 16.0218 35 20Z"
                                    stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Upload Photo</span>
                        </label>
                        <input class="d-none" id="upload-profile-input" type="file" name="avatar">
                        <div class="upload-profile-img" style="display: {{ $businessInfo->avatar ? 'block' : 'none' }};">
                            <img src="{{ $businessInfo->avatar ? asset($businessInfo->avatar) : '' }}" alt="Profile Image">
                            <svg class="upload-profile-img-close-btn" width="30px" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path
                                    d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                            </svg>
                        </div>
                    </div>

                    {{-- steps-inputs-container start --}}
                    <div class="steps-inputs-container my-4">
                        <div class="item">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $businessInfo->name) }}" required>
                        </div>

                        <div class="item">
                            <label for="bio">Bio</label>
                            <input type="text" name="bio" id="bio"
                                value="{{ old('bio', $businessInfo->bio) }}" required>
                        </div>

                        <div class="item">
                            <label for="business_name">Business Name</label>
                            <input type="text" name="business_name" id="business_name"
                                value="{{ old('business_name', $businessInfo->business_name) }}" required>
                        </div>

                        <div class="item">
                            <label for="business_address">Business Address</label>
                            <input type="text" name="business_address" id="business_address"
                                value="{{ old('business_address', $businessInfo->business_address) }}" required>
                        </div>

                        <div class="item">
                            <label for="professional_title">Professional Title</label>
                            <input type="text" name="professional_title" id="professional_title"
                                value="{{ old('professional_title', $businessInfo->professional_title) }}" required>
                        </div>
                    </div>
                    {{-- steps-inputs-container end --}}

                    {{-- upload documents start --}}
                    <div class="step-sub-title">Upload License/Certifications</div>
                    <div class="upload-documents-container mt-3">
                        <input type="file" id="file-upload" name="license" accept=".pdf,.jpg,.png" style="display: none">
                        <div class="upload-area" id="upload-area">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                    fill="none">
                                    <path
                                        d="M20 15V25M25 20H15M35 20C35 21.9698 34.612 23.9204 33.8582
                                        25.7403C33.1044 27.5601 31.9995 29.2137 30.6066 30.6066C29.2137 31.9995 27.5601
                                        33.1044 25.7403 33.8582C23.9204 34.612 21.9698 35 20 35C18.0302 35 16.0796
                                        34.612 14.2597 33.8582C12.4399 33.1044 10.7863 31.9995 9.3934 30.6066C8.00052
                                        29.2137 6.89563 27.5601 6.14181 25.7403C5.38799 23.9204 5 21.9698 5 20C5 16.0218
                                        6.58035 12.2064 9.3934 9.3934C12.2064 6.58035 16.0218 5 20 5C23.9782 5 27.7936
                                        6.58035 30.6066 9.3934C33.4196 12.2064 35 16.0218 35 20Z"
                                        stroke="#222222" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p style="color: #6B6B6B;" id="upload-btn">Upload Documents</p>
                        </div>
                        <div class="uploaded-files-list">
                            @if ($businessInfo->license)
                                <p>Uploaded: <a href="{{ asset($businessInfo->license) }}" target="_blank">View
                                        License</a></p>
                            @endif
                        </div>
                    </div>
                    {{-- upload documents end --}}

                    {{-- step progress start --}}
                    <div class="d-flex align-items-center mt-4 justify-content-between gap-3 flex-wrap">
                        <div class="step-progress-container d-flex align-items-center gap-2">
                            <div class="step-count">20%</div>
                            <div class="step-progress">
                                <div style="width: 20%;" class="step-progress-inner"></div>
                            </div>
                        </div>
                        <div class="step-actions d-flex align-items-center gap-3">
                            <a href="#" id="step-1-back-btn" class="step-back-btn">Back</a>
                            <button type="button" id="step-1-next-btn" class="step-next-btn">Next</button>
                        </div>
                    </div>
                    {{-- step progress end --}}
                </div>
            </div>
            {{-- step 1 end --}}


            {{-- step 2 start --}}
            <div style="opacity: 0; top: 0; visibility: hidden;" id="service-provider-step-form-2">
                <div class="map-container">
                    <div id="map"></div>
                </div>
                <input type="hidden" id="latitude" name="latitude"
                    value="{{ old('latitude', $businessInfo->latitude ?? '') }}">
                <input type="hidden" id="longitude" name="longitude"
                    value="{{ old('longitude', $businessInfo->longitude ?? '') }}">
                <input type="hidden" id="address" name="address"
                    value="{{ old('address', $businessInfo->address ?? '') }}">

                <div class="price-range-container">
                    <div class="step-count-title"><span>2</span>/5 Update Profile</div>
                    <div class="step-title">How Far Are You Willing to Travel</div>

                    <div class="price-range-content">
                        <div class="item">
                            <div class="range-slider-content">
                                <div class="range-title">
                                    <span>Set Free Travel Radius</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.40234 12.0781C2.40234 6.51213 6.91447 2 12.4805 2C18.0465 2 22.5586 6.51213 22.5586 12.0781C22.5586 17.6442 18.0465 22.1562 12.4805 22.1562C6.91447 22.1562 2.40234 17.6442 2.40234 12.0781ZM12.4805 10.9062C12.8688 10.9062 13.1836 11.2211 13.1836 11.6094V16.2969C13.1836 16.6852 12.8688 17 12.4805 17C12.0922 17 11.7773 16.6852 11.7773 16.2969V11.6094C11.7773 11.2211 12.0922 10.9062 12.4805 10.9062ZM13.0125 8.32883C13.2723 8.04019 13.2488 7.59561 12.9602 7.33584C12.6715 7.07606 12.227 7.09946 11.9672 7.3881L11.9578 7.39852C11.698 7.68716 11.7215 8.13174 12.0101 8.39151C12.2988 8.65129 12.7433 8.62789 13.0031 8.33924L13.0125 8.32883Z"
                                            fill="#222222" />
                                    </svg>
                                </div>
                                <div class="range-slider mt-4">
                                    <input type="range" id="free-radius" name="free_radius" min="0"
                                        max="100" value="{{ old('free_radius', $travelRadius->free_radius ?? 0) }}">
                                    <div id="indicator-free-radius" class="value-indicator">
                                        {{ old('free_radius', $travelRadius->free_radius ?? 0) }} km
                                    </div>
                                </div>
                            </div>
                            <div class="range-price">
                                <div class="range-title">Charge for this radius</div>
                                <div class="range-price-input mt-3" style="background-color: #E9E9E9;">
                                    <input disabled value="0" type="number">
                                    <span>$</span>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="range-slider-content">
                                <div class="range-title">
                                    <span>Set your travel Radius</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.40234 12.0781C2.40234 6.51213 6.91447 2 12.4805 2C18.0465 2 22.5586 6.51213 22.5586 12.0781C22.5586 17.6442 18.0465 22.1562 12.4805 22.1562C6.91447 22.1562 2.40234 17.6442 2.40234 12.0781ZM12.4805 10.9062C12.8688 10.9062 13.1836 11.2211 13.1836 11.6094V16.2969C13.1836 16.6852 12.8688 17 12.4805 17C12.0922 17 11.7773 16.6852 11.7773 16.2969V11.6094C11.7773 11.2211 12.0922 10.9062 12.4805 10.9062ZM13.0125 8.32883C13.2723 8.04019 13.2488 7.59561 12.9602 7.33584C12.6715 7.07606 12.227 7.09946 11.9672 7.3881L11.9578 7.39852C11.698 7.68716 11.7215 8.13174 12.0101 8.39151C12.2988 8.65129 12.7433 8.62789 13.0031 8.33924L13.0125 8.32883Z"
                                            fill="#222222" />
                                    </svg>
                                </div>
                                <div class="range-slider mt-4">
                                    <input type="range" id="travel-radius" name="travel_radius" min="0"
                                        max="100"
                                        value="{{ old('travel_radius', $travelRadius->travel_radius ?? 0) }}">
                                    <div id="indicator-travel-radius" class="value-indicator">
                                        {{ old('travel_radius', $travelRadius->travel_radius ?? 0) }} km
                                    </div>
                                </div>
                            </div>
                            <div class="range-price">
                                <div class="range-title">Charge for this radius</div>
                                <div class="range-price-input mt-3">
                                    <input type="number" name="travel_charge"
                                        value="{{ old('travel_charge', $travelRadius->travel_charge ?? 0) }}">
                                    <span>$</span>
                                </div>
                            </div>
                        </div>
                        <div style="border-bottom: 1px solid #222; width: 100%; height: 1px;"></div>

                        <div class="item">
                            <div class="range-slider-content">
                                <div class="range-title">
                                    <span>Set Your Maximum Travel Radius</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.40234 12.0781C2.40234 6.51213 6.91447 2 12.4805 2C18.0465 2 22.5586 6.51213 22.5586 12.0781C22.5586 17.6442 18.0465 22.1562 12.4805 22.1562C6.91447 22.1562 2.40234 17.6442 2.40234 12.0781ZM12.4805 10.9062C12.8688 10.9062 13.1836 11.2211 13.1836 11.6094V16.2969C13.1836 16.6852 12.8688 17 12.4805 17C12.0922 17 11.7773 16.6852 11.7773 16.2969V11.6094C11.7773 11.2211 12.0922 10.9062 12.4805 10.9062ZM13.0125 8.32883C13.2723 8.04019 13.2488 7.59561 12.9602 7.33584C12.6715 7.07606 12.227 7.09946 11.9672 7.3881L11.9578 7.39852C11.698 7.68716 11.7215 8.13174 12.0101 8.39151C12.2988 8.65129 12.7433 8.62789 13.0031 8.33924L13.0125 8.32883Z"
                                            fill="#222222" />
                                    </svg>
                                </div>
                                <div class="range-slider mt-4">
                                    <input type="range" id="max-radius" name="max_radius" min="0"
                                        max="100" value="{{ old('max_radius', $travelRadius->max_radius ?? 0) }}">
                                    <div id="indicator-max-radius" class="value-indicator">
                                        {{ old('max_radius', $travelRadius->max_radius ?? 0) }} km
                                    </div>
                                </div>
                            </div>
                            <div class="range-price">
                                <div class="range-title">Charge for this radius</div>
                                <div class="range-price-input mt-3">
                                    <input type="number" name="max_charge" id="max-charge"
                                        value="{{ old('max_charge', $travelRadius->max_charge ?? 0) }}">
                                    <span>$</span>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="range-slider-content">
                                <div class="d-flex minimum-booking-value-container align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" id="minimum-booking-checkbox">
                                    <label style="color: #222; font-family: Helvetica Neue;"
                                        for="minimum-booking-checkbox">
                                        Do you want to set any minimum booking value for traveling this far?
                                    </label>
                                </div>
                            </div>
                            <div class="range-price">
                                <div class="range-title">Minimum booking value</div>
                                <div class="range-price-input minimum-booking-input mt-3">
                                    <input id="minimum-booking-input" type="number" name="min_booking_value"
                                        value="{{ old('min_booking_value', $travelRadius->min_booking_value ?? 0) }}"
                                        disabled>
                                    <span>$</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- step progress start --}}
                    <div class="d-flex align-items-center mt-4 justify-content-between gap-3 flex-wrap">
                        <div class="step-progress-container d-flex align-items-center gap-2">
                            <div class="step-count">40%</div>
                            <div class="step-progress">
                                <div style="width: 40%;" class="step-progress-inner"></div>
                            </div>
                        </div>
                        <div class="step-actions d-flex align-items-center gap-3">
                            <div id="step-2-back-btn" class="step-back-btn">Back</div>
                            <button type="button" id="step-2-next-btn" class="step-next-btn">Next</button>
                        </div>
                    </div>
                    {{-- step progress end --}}
                </div>
            </div>
            {{-- step 2 end --}}


            {{-- step 3 start --}}
            <div style="display: none;" id="service-provider-step-form-3">
                <div class="step-count-title text-center"><span>3</span>/5 Update Profile</div>
                <div class="step-title text-center">Tell Us About You and Your Business</div>

                <div class="table-responsive data-table mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Services</th>
                                <th scope="col">Yes/No</th>
                                <th scope="col">Offered Price</th>
                                <th scope="col">Platform Fee</th>
                                <th scope="col">Total</th>
                                <th scope="col">Add Photo</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($servicesData as $data)
                                <tr>
                                    <td>{{ $data['service']->services_name }}</td>
                                    <td>
                                        <div class="d-flex select-service-container align-items-center gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="services[{{ $loop->index }}][service_id]"
                                                    id="yes{{ $data['service']->id }}"
                                                    value="{{ $data['service']->id }}"
                                                    {{ $data['selected'] ? 'checked' : '' }}
                                                    onchange="toggleService(this, true)">
                                                <label class="form-check-label"
                                                    for="yes{{ $data['service']->id }}">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="services[{{ $loop->index }}][service_id]"
                                                    id="no{{ $data['service']->id }}" value="{{ $data['service']->id }}"
                                                    {{ !$data['selected'] ? 'checked' : '' }}
                                                    onchange="toggleService(this, false)">
                                                <label class="form-check-label"
                                                    for="no{{ $data['service']->id }}">No</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="services[{{ $loop->index }}][selected]"
                                            value="{{ $data['selected'] ? 1 : 0 }}">
                                    </td>
                                    <td>
                                        <div class="service-value-input {{ !$data['selected'] ? 'disabled' : '' }}">
                                            <input class="offered-price" type="number"
                                                name="services[{{ $loop->index }}][offered_price]"
                                                id="offered_price{{ $data['service']->id }}"
                                                value="{{ $data['offered_price'] }}">
                                            <span>$</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="service-value-input">
                                            <input disabled class="service-charge" type="text"
                                                id="platform_fee{{ $data['service']->id }}"
                                                name="platform_fee{{ $data['service']->id }}"
                                                value="{{ $data['service']->platform_fee }}%">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="service-value-input">
                                            <input class="total-charge" disabled type="number"
                                                id="total_price{{ $data['service']->id }}"
                                                value="{{ $data['total_price'] }}">

                                            <input type="hidden" name="services[{{ $loop->index }}][total_price]"
                                                id="hidden_total_price{{ $data['service']->id }}"
                                                value="{{ $data['total_price'] }}">
                                            <span>$</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="service-value-input upload-service-img-container">
                                            <label class="service-upload-img-btn"
                                                for="service_image{{ $data['service']->id }}"
                                                style="cursor: pointer; display: {{ $data['image'] ? 'none' : 'flex' }};">
                                                <span>Upload</span>
                                            </label>
                                            <input class="service-file-input d-none" type="file"
                                                name="services[{{ $loop->index }}][image]"
                                                id="service_image{{ $data['service']->id }}">
                                            <img class="service-uploaded-img"
                                                style="max-width: 80px; max-height: 60px; border-radius: 4px; margin: 0 auto; object-fit: cover; display: {{ $data['image'] ? 'block' : 'none' }};"
                                                src="{{ $data['image'] ? asset($data['image']) : '' }}" alt="">
                                            <svg class="service-delete-btn" width="20px"
                                                style="display: {{ $data['image'] ? 'block' : 'none' }};"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path
                                                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4
                                                                                                                                                                                                                    24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47
                                                                                                                                                                                                                    47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9
                                                                                                                                                                                                                    0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- step progress start --}}
                <div class="d-flex align-items-center mt-4 justify-content-between gap-3 flex-wrap">
                    <div class="step-progress-container d-flex align-items-center gap-2">
                        <div class="step-count">60%</div>
                        <div class="step-progress">
                            <div style="width: 60%;" class="step-progress-inner"></div>
                        </div>
                    </div>
                    <div class="step-actions d-flex align-items-center gap-3">
                        <div id="step-3-back-btn" class="step-back-btn">Back</div>
                        <button type="button" id="step-3-next-btn" class="step-next-btn">Next</button>
                    </div>
                </div>
                {{-- step progress end --}}
            </div>
            {{-- step 3 end --}}

            {{-- Step 4: Profile Information Start --}}
            <div style="display: none;" id="service-provider-step-form-4">
                <div class="text-content">
                    <!-- Centered titles at the top -->
                    <div class="text-center">
                        <div class="step-count-title">
                            <span>4</span>/5 Update Profile
                        </div>
                        <div class="step-title">Update Your Personal Information</div>
                    </div>

                    <!-- Two-column layout container -->
                    <div class="row mt-5">
                        <!-- Left Column: Profile Picture -->
                        <div class="col-md-3">
                            <div class="step-sub-title">Upload your personal profile photo</div>

                            <div class="step-upload-profile-container mt-3">
                                <label for="upload-user-profile-input" class="upload-profile-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                        viewBox="0 0 40 40" fill="none">
                                        <path
                                            d="M20 15V25M25 20H15M35 20C35 21.9698 34.612 23.9204 33.8582 25.7403C33.1044 27.5601 31.9995 29.2137 30.6066 30.6066C29.2137 31.9995 27.5601 33.1044 25.7403 33.8582C23.9204 34.612 21.9698 35 20 35C18.0302 35 16.0796 34.612 14.2597 33.8582C12.4399 33.1044 10.7863 31.9995 9.3934 30.6066C8.00052 29.2137 6.89563 27.5601 6.14181 25.7403C5.38799 23.9204 5 21.9698 5 20C5 16.0218 6.58035 12.2064 9.3934 9.3934C12.2064 6.58035 16.0218 5 20 5C23.9782 5 27.7936 6.58035 30.6066 9.3934C33.4196 12.2064 35 16.0218 35 20Z"
                                            stroke="#222222" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span>Upload Photo</span>
                                </label>
                                <input class="d-none" id="upload-user-profile-input" type="file" name="user_avatar">
                                <div class="upload-profile-img" style="display: {{ $user->avatar ? 'block' : 'none' }};">
                                    <img src="{{ $user->avatar ? asset($user->avatar) : '' }}" alt="User Profile Image">
                                    <svg class="upload-profile-img-close-btn" width="30px"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Personal Information -->
                        <div class="col-md-9">
                            <div class="step-sub-title">Personal Information</div>

                            <div class="steps-inputs-container mt-3">
                                <div class="item">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name"
                                        value="{{ old('first_name', $user->first_name) }}" required>
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="item">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name"
                                        value="{{ old('last_name', $user->last_name) }}" required>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="item">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number"
                                        value="{{ old('phone_number', $user->phone_number) }}" required>
                                    @error('phone_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="item">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" required>{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress and Navigation -->
                    <div class="d-flex align-items-center mt-4 justify-content-between gap-3 flex-wrap">
                        <div class="step-progress-container d-flex align-items-center gap-2">
                            <div class="step-count">80%</div>
                            <div class="step-progress">
                                <div style="width: 80%;" class="step-progress-inner"></div>
                            </div>
                        </div>
                        <div class="step-actions d-flex align-items-center gap-3">
                            <div id="step-4-back-btn" class="step-back-btn">Back</div>
                            <button type="button" id="step-4-next-btn" class="step-next-btn">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Step 4 end --}}

            {{-- Step 5: Password Update Start --}}
            <div style="display: none;" id="service-provider-step-form-5">
                <div class="text-content">
                    <div class="step-count-title">
                        <span>5</span>/5 Update Profile
                    </div>
                    <div class="step-title">Update Your Password</div>
                    <div class="step-sub-title mt-5">Secure your account with a new password (Optional)</div>

                    <div class="steps-inputs-container my-4">
                        <div class="item">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password"
                                placeholder="Enter your current password (leave blank to skip)">
                            @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="item">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password"
                                placeholder="Enter your new password (leave blank to skip)">
                            @error('new_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="item">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                placeholder="Confirm your new password">
                            @error('new_password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-4 justify-content-between gap-3 flex-wrap">
                        <div class="step-progress-container d-flex align-items-center gap-2">
                            <div class="step-count">100%</div>
                            <div class="step-progress">
                                <div style="width: 100%;" class="step-progress-inner"></div>
                            </div>
                        </div>
                        <div class="step-actions d-flex align-items-center gap-3">
                            <div id="step-5-back-btn" class="step-back-btn">Back</div>
                            <button type="submit" id="step-5-next-btn" class="step-next-btn">Complete</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- step 5 end --}}
        </div>
    </form>

    <div id="overlay" class="overlay">
        <div class="loader-logo">
            <img src="{{ asset('frontend/logo.png') }}" alt="Loading...">
        </div>
    </div>
@endsection

@push('scripts')
    {{-- for map --}}
    <script src="{{ asset('frontend/js/leaflet.js') }}"></script>
    <script>
        let map;
        let currentMarker;
        let travelRadiusCircle;
        let freeRadiusCircle;
        let maxRadiusCircle;

        // Default coordinates (Canberra)
        const defaultLat = -35.3;
        const defaultLng = 149.1167;

        // Debounce timer for auto-save
        let autoSaveTimer;

        function debounceAutoSave(delay) {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(autoSaveLocation, delay);
        }

        // Auto-save location using Axios
        function autoSaveLocation() {
            const formData = new FormData();
            formData.append('latitude', document.getElementById('latitude').value);
            formData.append('longitude', document.getElementById('longitude').value);
            formData.append('address', document.getElementById('address').value);

            axios.post('{{ route('update-service-location') }}', formData, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    console.log('Location autosaved:', response.data);
                })
                .catch(error => {
                    console.error('Auto-save error:', error);
                });
        }

        // New function for updating free radius circle (green):
        function updateFreeRadiusCircle(kmValue) {
            if (!map) return;
            const latLng = currentMarker ? currentMarker.getLatLng() : map.getCenter();
            const radiusInMeters = kmValue * 1000;

            if (freeRadiusCircle) {
                freeRadiusCircle.setLatLng(latLng);
                freeRadiusCircle.setRadius(radiusInMeters);
            } else {
                freeRadiusCircle = L.circle(latLng, {
                    color: 'green',
                    fillColor: '#32CD32',
                    fillOpacity: 0.2,
                    radius: radiusInMeters
                }).addTo(map);
            }

            // Auto-zoom if radius is more than 1km
            if (kmValue > 1 && freeRadiusCircle) {
                map.fitBounds(freeRadiusCircle.getBounds(), {
                    animate: true,
                    padding: [20, 20]
                });
            }
        }

        // Existing function for updating travel radius circle (orange):
        function updateTravelRadiusCircle(kmValue) {
            if (!map) return;
            const latLng = currentMarker ? currentMarker.getLatLng() : map.getCenter();
            const radiusInMeters = kmValue * 1000;

            if (travelRadiusCircle) {
                travelRadiusCircle.setLatLng(latLng);
                travelRadiusCircle.setRadius(radiusInMeters);
            } else {
                travelRadiusCircle = L.circle(latLng, {
                    color: 'orange',
                    fillColor: '#FFA500',
                    fillOpacity: 0.2,
                    radius: radiusInMeters
                }).addTo(map);
            }

            // Move this inside the function:
            if (kmValue > 1 && travelRadiusCircle) {
                map.fitBounds(travelRadiusCircle.getBounds(), {
                    animate: true,
                    padding: [20, 20]
                });
            }
        }

        // New function for updating max radius circle (red):
        function updateMaxRadiusCircle(kmValue) {
            if (!map) return;
            const latLng = currentMarker ? currentMarker.getLatLng() : map.getCenter();
            const radiusInMeters = kmValue * 1000;

            if (maxRadiusCircle) {
                maxRadiusCircle.setLatLng(latLng);
                maxRadiusCircle.setRadius(radiusInMeters);
            } else {
                maxRadiusCircle = L.circle(latLng, {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.2,
                    radius: radiusInMeters
                }).addTo(map);
            }

            // Auto-zoom if radius is more than 1km
            if (kmValue > 1 && maxRadiusCircle) {
                map.fitBounds(maxRadiusCircle.getBounds(), {
                    animate: true,
                    padding: [20, 20]
                });
            }
        }

        // Function to initialize the map
        function initializeMap() {
            const mapElement = document.getElementById('map');
            mapElement.style.height = "400px";

            // Remove extra zoom control by not adding our own since default is enabled.
            map = L.map('map', {
                center: [defaultLat, defaultLng],
                zoom: 13,
                scrollWheelZoom: true
                // Do not disable zoomControl: true is the default
            });
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const customIcon = L.icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            // Function to update the marker and associated circle on the map
            function updateMarker(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                if (currentMarker) {
                    currentMarker.setLatLng([lat, lng]);
                } else {
                    currentMarker = L.marker([lat, lng], {
                        draggable: true,
                        icon: customIcon
                    }).addTo(map);
                    currentMarker.bindPopup('Selected Location').openPopup();
                    currentMarker.on('dragend', function(e) {
                        const {
                            lat,
                            lng
                        } = e.target.getLatLng();
                        updateMarker(lat, lng);
                    });
                }
                map.setView([lat, lng], 13, {
                    animate: true
                });

                // Update circles based on slider values:
                const freeRadiusValue = document.getElementById('free-radius').value;
                const travelRadiusValue = document.getElementById('travel-radius').value;
                const maxRadiusValue = document.getElementById('max-radius').value;

                updateFreeRadiusCircle(freeRadiusValue);
                updateTravelRadiusCircle(travelRadiusValue);
                updateMaxRadiusCircle(maxRadiusValue);

                // Reverse geocoding to fetch address
                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('address').value = data.display_name || 'Unknown';
                        debounceAutoSave(1000);
                    })
                    .catch(() => {
                        document.getElementById('address').value = 'Location not found';
                        debounceAutoSave(1000);
                    });
            }

            // Use geolocation if available, otherwise fallback to default location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        updateMarker(position.coords.latitude, position.coords.longitude);
                    },
                    () => {
                        updateMarker(defaultLat, defaultLng);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 5000
                    }
                );
            } else {
                updateMarker(defaultLat, defaultLng);
            }
        }
    </script>

    <script>
        // Wait until the second step of the form is visible before initializing the map
        document.addEventListener("DOMContentLoaded", function() {
            const step2 = document.getElementById('service-provider-step-form-2');
            const observer = new MutationObserver((mutations, obs) => {
                if (window.getComputedStyle(step2).display !== "none") {
                    if (typeof map === 'undefined' || !map) {
                        initializeMap();
                    } else if (map.invalidateSize) {
                        setTimeout(() => {
                            map.invalidateSize();
                        }, 300);
                    }
                    obs.disconnect();
                }
            });
            observer.observe(step2, {
                attributes: true,
                attributeFilter: ["style"]
            });
        });
    </script>

    <script>
        // Update slider value display and update the travel radius circle on slider change
        function updateSliderValue(slider, indicator) {
            const value = slider.value;
            const min = slider.min;
            const max = slider.max;
            indicator.textContent = value + " km";
            const percentage = ((value - min) / (max - min)) * 100;
            const offset = (percentage / 100) * slider.offsetWidth;
            indicator.style.left = `${offset}px`;
        }

        const sliders = [{
                id: "free-radius",
                indicatorId: "indicator-free-radius"
            },
            {
                id: "travel-radius",
                indicatorId: "indicator-travel-radius"
            },
            {
                id: "max-radius",
                indicatorId: "indicator-max-radius"
            }
        ];

        sliders.forEach(({
            id,
            indicatorId
        }) => {
            const slider = document.getElementById(id);
            const indicator = document.getElementById(indicatorId);
            slider.addEventListener("input", () => {
                updateSliderValue(slider, indicator);
                if (id === "free-radius") {
                    updateFreeRadiusCircle(slider.value);
                }
                if (id === "travel-radius") {
                    updateTravelRadiusCircle(slider.value);
                }
                if (id === "max-radius") {
                    updateMaxRadiusCircle(slider.value);
                }
            });
            updateSliderValue(slider, indicator);
            if (id === "free-radius") {
                updateFreeRadiusCircle(slider.value);
            }
            if (id === "travel-radius") {
                updateTravelRadiusCircle(slider.value);
            }
            if (id === "max-radius") {
                updateMaxRadiusCircle(slider.value);
            }
        });
    </script>

    {{-- max price set --}}
    <script>
        // JavaScript
        const checkbox = document.getElementById('minimum-booking-checkbox');
        const input = document.getElementById('minimum-booking-input');
        const container = document.querySelector('.minimum-booking-input')

        // Listen for changes on the checkbox
        checkbox.addEventListener('change', () => {
            // Enable or disable the input based on the checkbox state
            input.disabled = !checkbox.checked;

            // Add or remove 'active' class based on checkbox state
            if (checkbox.checked) {
                container.classList.add('active');
            } else {
                container.classList.remove('active');
                input.value = 0;
            }
        });
    </script>

    {{-- upload profile image js --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imgElement = document.querySelector(".upload-profile-img img");
            const uploadProfileImgContainer = document.querySelector(".upload-profile-img");
            const fileInput = document.getElementById('upload-profile-input');

            // Show container if an image already exists.
            if (imgElement.src && imgElement.src !== window.location.href) {
                uploadProfileImgContainer.style.display = "block";
            }

            // Remove the manual click event (the label now triggers the file input via its "for" attribute).
            document.querySelector('.upload-profile-img-close-btn').addEventListener('click', () => {
                imgElement.src = '';
                uploadProfileImgContainer.style.display = 'none';
                fileInput.value = '';
            });

            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    uploadProfileImgContainer.style.display = 'block';
                }
            });
        });
    </script>

    {{-- upload documents js --}}
    <script>
        const uploadBtn = document.getElementById('upload-btn');
        const fileInput = document.getElementById('file-upload');
        const uploadArea = document.getElementById('upload-area');
        const uploadedFilesList = document.getElementById('uploaded-files-list');
        const submitBtn = document.getElementById('submit-step-form-btn');

        // Global array to store uploaded files
        let uploadedFiles = [];

        // Click to trigger file input
        uploadArea.addEventListener('click', function() {
            fileInput.click(); // Trigger the hidden file input
        });

        // Handle file input change (for click upload)
        fileInput.addEventListener('change', function() {
            handleFileUpload(this.files);
        });

        // Drag and Drop functionality
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault(); // Prevent default to allow drop
            uploadArea.style.borderColor = 'green'; // Change border on dragover
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#ccc'; // Reset border on drag leave
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault(); // Prevent default behavior (prevent file from being opened)
            uploadArea.style.borderColor = '#ccc'; // Reset border after drop
            handleFileUpload(e.dataTransfer.files); // Handle the dropped files
        });

        // Function to handle file uploads
        function handleFileUpload(files) {
            const allowedTypes = [
                "application/pdf",
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document", // .docx
                "application/vnd.ms-excel", // .xls
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", // .xlsx
                "text/plain"
            ];

            for (const file of files) {
                if (allowedTypes.includes(file.type)) {
                    // Store the file in the global array
                    uploadedFiles.push(file);

                    const fileElement = document.createElement('div');
                    fileElement.classList.add('uploaded-file');
                    fileElement.innerHTML = `
            <span>${file.name}</span>
            <button class="close-btn" onclick="removeFile(this, '${file.name}')">X</button>
        `;
                    uploadedFilesList.appendChild(fileElement);
                } else {
                    console.log(`File type not allowed: ${file.name}`);
                }
            }
        }

        // Function to remove a file from the uploaded list
        function removeFile(button, fileName) {
            // Remove the file element from the DOM
            button.parentElement.remove();

            // Remove the file from the global array by its name
            uploadedFiles = uploadedFiles.filter(file => file.name !== fileName);
        }
    </script>

    {{-- for upload table img --}}
    <script>
        // Get all upload containers for table images
        const uploadContainers = document.querySelectorAll('.upload-service-img-container');

        uploadContainers.forEach(container => {
            const uploadFileInput = container.querySelector('.service-file-input');
            const uploadedImg = container.querySelector('.service-uploaded-img');
            const serviceImgDeleteBtn = container.querySelector('.service-delete-btn');
            const uploadBtnLabel = container.querySelector('.service-upload-img-btn');

            // When file selection changes, update the image and toggle button visibility.
            uploadFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        uploadedImg.src = e.target.result;
                        // Explicitly force the image to display
                        uploadedImg.style.display = 'block';
                        uploadBtnLabel.style.display = 'none';
                        serviceImgDeleteBtn.style.display = 'block';
                    };

                    reader.readAsDataURL(file);
                }
            });

            // When the delete button is clicked, clear the image and reset the input.
            serviceImgDeleteBtn.addEventListener('click', () => {
                uploadedImg.src = '';
                uploadBtnLabel.style.display = 'flex';
                serviceImgDeleteBtn.style.display = 'none';
                uploadFileInput.value = '';
                // Optionally hide the image element
                uploadedImg.style.display = 'none';
            });
        });
    </script>

    {{-- for yes or no btn clicked for table row --}}
    <script>
        // Select all rows in the table
        document.querySelectorAll("tr").forEach((row) => {
            // Get all radio buttons within the row
            const radioButtons = row.querySelectorAll('input[type="radio"]');

            // Find "Yes" and "No" radio buttons dynamically
            let yesRadio, noRadio;
            radioButtons.forEach((radio) => {
                const label = row.querySelector(`label[for="${radio.id}"]`);
                if (label && label.textContent.trim() === "Yes") yesRadio = radio;
                if (label && label.textContent.trim() === "No") noRadio = radio;
            });

            // Get all service-value-input containers in the row
            const serviceValueInputs = row.querySelectorAll(".service-value-input");

            // Function to toggle the 'disabled' class on containers
            const toggleInputs = () => {
                if (noRadio) {
                    const isDisabled = noRadio.checked; // Check if 'No' is selected
                    serviceValueInputs.forEach((container) => {
                        // Toggle the 'disabled' class on the container
                        if (isDisabled) {
                            container.classList.add("disabled");
                        } else {
                            container.classList.remove("disabled");
                        }
                    });
                }
            };

            // Attach event listeners to the radio buttons
            if (yesRadio && noRadio) {
                yesRadio.addEventListener("change", toggleInputs);
                noRadio.addEventListener("change", toggleInputs);

                // Initialize the state based on the default selection
                toggleInputs();
            }
        });
    </script>

    {{-- for total price calculation --}}
    <script>
        document.querySelectorAll('table tbody tr').forEach((row) => {
            // Get the Yes/No radio buttons.
            const yesRadio = row.querySelector('input[id^="yes"]');
            const noRadio = row.querySelector('input[id^="no"]');
            // Get the hidden "selected" input.
            const hiddenSelected = row.querySelector('input[name^="services"][name$="[selected]"]');
            // Get the offered price input.
            const offeredPriceInput = row.querySelector('input.offered-price');
            // Get the platform fee element (which holds a value like "10%").
            const platformFeeElem = row.querySelector('.service-charge');
            // Get the displayed total price (disabled) input.
            const totalChargeInput = row.querySelector('input.total-charge');
            // Get the hidden total price input (which is submitted with the form).
            const hiddenTotalPriceInput = row.querySelector(
                'input[type="hidden"][name^="services"][name$="[total_price]"]'
            );

            // Function to update the total price
            function updateTotal() {
                let feeStr = platformFeeElem.value || platformFeeElem.getAttribute('value');
                const fee = parseFloat(feeStr.replace('%', '')) || 0;
                const price = parseFloat(offeredPriceInput.value) || 0;
                const total = (price + (price * fee / 100)).toFixed(2);
                totalChargeInput.value = total;
                if (hiddenTotalPriceInput) {
                    hiddenTotalPriceInput.value = total;
                }
            }

            // Function to toggle fields based on whether service is selected.
            function toggleFields(isSelected) {
                // Update the hidden selected field.
                if (hiddenSelected) {
                    hiddenSelected.value = isSelected ? 1 : 0;
                }
                // Enable or disable the offered price input.
                offeredPriceInput.disabled = !isSelected;
                // Optionally update styling below if you rely on a 'disabled' class.
                row.querySelector('.service-value-input').classList.toggle('disabled', !isSelected);
                if (!isSelected) {
                    // Clear offered price and total values if unselected.
                    offeredPriceInput.value = '';
                    totalChargeInput.value = '';
                    if (hiddenTotalPriceInput) {
                        hiddenTotalPriceInput.value = '';
                    }
                } else {
                    updateTotal();
                }
            }

            // Attach change listeners if both radios exist.
            if (yesRadio && noRadio) {
                yesRadio.addEventListener('change', () => {
                    if (yesRadio.checked) {
                        toggleFields(true);
                    }
                });
                noRadio.addEventListener('change', () => {
                    if (noRadio.checked) {
                        toggleFields(false);
                    }
                });
                // Initialize the state based on the default selection.
                toggleFields(yesRadio.checked);
            }

            // Attach event for offered price input to update total on change.
            if (offeredPriceInput) {
                offeredPriceInput.addEventListener('input', updateTotal);
                updateTotal();
            }
        });
    </script>

    {{-- User profile image upload script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const userImgElement = document.querySelector("#service-provider-step-form-4 .upload-profile-img img");
            const userUploadProfileImgContainer = document.querySelector(
                "#service-provider-step-form-4 .upload-profile-img");
            const userFileInput = document.getElementById('upload-user-profile-input');

            if (userImgElement.src && userImgElement.src !== window.location.href) {
                userUploadProfileImgContainer.style.display = "block";
            }

            document.querySelector('#service-provider-step-form-4 .upload-profile-img-close-btn').addEventListener(
                'click', () => {
                    userImgElement.src = '';
                    userUploadProfileImgContainer.style.display = 'none';
                    userFileInput.value = '';
                });

            userFileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        userImgElement.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    userUploadProfileImgContainer.style.display = 'block';
                }
            });
        });
    </script>

    {{-- for changing steps --}}
    <script>
        const step1 = document.getElementById('service-provider-step-form-1');
        const step2 = document.getElementById('service-provider-step-form-2');
        const step3 = document.getElementById('service-provider-step-form-3');
        const step4 = document.getElementById('service-provider-step-form-4');
        const step5 = document.getElementById('service-provider-step-form-5');

        const overlay = document.getElementById('overlay');
        const form = document.querySelector('#main-form');
        const currentStepInput = document.getElementById('current-step');

        const step1NextBtn = document.getElementById('step-1-next-btn');
        const step2BackBtn = document.getElementById('step-2-back-btn');
        const step2NextBtn = document.getElementById('step-2-next-btn');
        const step3BackBtn = document.getElementById('step-3-back-btn');
        const step3NextBtn = document.getElementById('step-3-next-btn');
        const step4BackBtn = document.getElementById('step-4-back-btn');
        const step4NextBtn = document.getElementById('step-4-next-btn');
        const step5BackBtn = document.getElementById('step-5-back-btn');
        const step5NextBtn = document.getElementById('step-5-next-btn');

        // Track current step
        let currentStep = 1;

        // Step 1 to 2
        step1NextBtn.addEventListener('click', () => {
            step1.style.display = "none";
            step2.style.display = "flex";
            step2.style.opacity = 1;
            step2.style.visibility = "visible";
            currentStep = 2;
            currentStepInput.value = "2";

            setTimeout(() => {
                sliders.forEach(({
                    id,
                    indicatorId
                }) => {
                    const slider = document.getElementById(id);
                    const indicator = document.getElementById(indicatorId);
                    updateSliderValue(slider, indicator);
                });
            }, 100);
        });

        // Step 2 back to 1
        step2BackBtn.addEventListener('click', () => {
            step2.style.display = "none";
            step1.style.display = "flex";
            currentStep = 1;
            currentStepInput.value = "1";
        });

        // Step 2 to 3
        step2NextBtn.addEventListener('click', () => {
            step2.style.display = "none";
            step3.style.display = "block";
            currentStep = 3;
            currentStepInput.value = "3";
        });

        // Step 3 back to 2
        step3BackBtn.addEventListener('click', () => {
            step3.style.display = "none";
            step2.style.display = "flex";
            currentStep = 2;
            currentStepInput.value = "2";
        });

        // Step 3 to 4 - Submit Steps 1-3 data
        step3NextBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            try {
                overlay.style.display = 'flex';
                currentStepInput.value = "3";

                // Submit the form for steps 1-3
                const formData = new FormData(form);

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                overlay.style.display = 'none';

                if (response.ok) {
                    // Move to step 4 after successful submission
                    step3.style.display = "none";
                    step4.style.display = "block";
                    currentStep = 4;
                    currentStepInput.value = "4";
                } else {
                    // Handle validation errors
                    const result = await response.text();
                    // You may want to parse and display errors here
                    console.error('Validation failed');
                }
            } catch (error) {
                overlay.style.display = 'none';
                console.error('Error submitting form:', error);
            }
        });

        // Step 4 back to 3
        step4BackBtn.addEventListener('click', () => {
            step4.style.display = "none";
            step3.style.display = "block";
            currentStep = 3;
            currentStepInput.value = "3";
        });

        // Step 4 to 5 - Submit Step 4 data
        step4NextBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            try {
                overlay.style.display = 'flex';
                currentStepInput.value = "4";

                // Submit the form for step 4
                const formData = new FormData(form);

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                overlay.style.display = 'none';

                if (response.ok) {
                    // Move to step 5 after successful submission
                    step4.style.display = "none";
                    step5.style.display = "block";
                    currentStep = 5;
                    currentStepInput.value = "5";
                } else {
                    // Handle validation errors
                    console.error('Step 4 validation failed');
                }
            } catch (error) {
                overlay.style.display = 'none';
                console.error('Error submitting step 4:', error);
            }
        });

        // Step 5 back to 4
        step5BackBtn.addEventListener('click', () => {
            step5.style.display = "none";
            step4.style.display = "block";
            currentStep = 4;
            currentStepInput.value = "4";
        });

        // Final submit - Step 5
        step5NextBtn.addEventListener('click', function(e) {
            if (currentStep === 5) {
                overlay.style.display = 'flex';
                currentStepInput.value = "5";
                // Let the form submit naturally
            }
        });
    </script>
@endpush
