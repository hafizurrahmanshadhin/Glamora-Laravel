@extends('auth.app')

@section('title', 'Service Provider Registration')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/service-provider-step-form.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="section-padding-x m-top m-bottom">
        {{-- step 1 start --}}
        <div id="service-provider-step-form-1">
            <div class="img-content">
                <img src="{{ asset('frontend/images/dashboard-banner-right.png') }}" alt="">
            </div>

            <div class="text-content">
                <div class="step-count-title">
                    <span>1</span>/3 Create Profile
                </div>
                <div class="step-title">Tell Us About You and Your Business</div>
                <div class="step-sub-title mt-5">
                    Upload your profile photo
                </div>
                <div class="step-upload-profile-container mt-3">
                    <div class="upload-profile-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                            fill="none">
                            <path
                                d="M20 15V25M25 20H15M35 20C35 21.9698 34.612 23.9204 33.8582 25.7403C33.1044 27.5601 31.9995 29.2137 30.6066 30.6066C29.2137 31.9995 27.5601 33.1044 25.7403 33.8582C23.9204 34.612 21.9698 35 20 35C18.0302 35 16.0796 34.612 14.2597 33.8582C12.4399 33.1044 10.7863 31.9995 9.3934 30.6066C8.00052 29.2137 6.89563 27.5601 6.14181 25.7403C5.38799 23.9204 5 21.9698 5 20C5 16.0218 6.58035 12.2064 9.3934 9.3934C12.2064 6.58035 16.0218 5 20 5C23.9782 5 27.7936 6.58035 30.6066 9.3934C33.4196 12.2064 35 16.0218 35 20Z"
                                stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Upload Photo</span>
                    </div>
                    <input class="d-none" id="upload-profile-input" type="file" name="avatar" required>
                    <div class="upload-profile-img">
                        <img src="" alt="">
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
                        <input placeholder="Enter Your Full Name" type="text" name="name" id="name" required>
                    </div>
                    <div class="item">
                        <label for="bio">Add Bio</label>
                        <input placeholder="Write something about your service" type="text" name="bio" id="bio"
                            required>
                    </div>
                    <div class="item">
                        <label for="business_name">Business Name</label>
                        <input placeholder="Enter your Business Address" type="text" name="business_name"
                            id="business_name" required>
                    </div>
                    <div class="item">
                        <label for="professional_title">Professional Title</label>
                        <input placeholder="Enter your Professional Title" type="text" name="professional_title"
                            id="professional_title" required>
                    </div>
                </div>
                {{-- steps-inputs-container end --}}

                {{-- upload documents start --}}
                <div class="step-sub-title">
                    Upload License/Certifications
                </div>

                <div class="upload-documents-container mt-3">
                    <input type="file" id="file-upload" name="license" accept=".pdf,.jpg,.png" required
                        style="display: none" />
                    <div class="upload-area" id="upload-area">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M20 15V25M25 20H15M35 20C35 21.9698 34.612 23.9204 33.8582 25.7403C33.1044 27.5601 31.9995 29.2137 30.6066 30.6066C29.2137 31.9995 27.5601 33.1044 25.7403 33.8582C23.9204 34.612 21.9698 35 20 35C18.0302 35 16.0796 34.612 14.2597 33.8582C12.4399 33.1044 10.7863 31.9995 9.3934 30.6066C8.00052 29.2137 6.89563 27.5601 6.14181 25.7403C5.38799 23.9204 5 21.9698 5 20C5 16.0218 6.58035 12.2064 9.3934 9.3934C12.2064 6.58035 16.0218 5 20 5C23.9782 5 27.7936 6.58035 30.6066 9.3934C33.4196 12.2064 35 16.0218 35 20Z"
                                    stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p style="color: #6B6B6B;" id="upload-btn">Upload Documents</p>
                    </div>
                    <div class="uploaded-files-list" id="uploaded-files-list"></div>
                </div>
                {{-- upload documents end --}}

                {{-- step progress start --}}
                <div class="d-flex align-items-center mt-4 justify-content-between gap-3 flex-wrap ">
                    <div class="step-progress-container d-flex align-items-center gap-2 ">
                        <div class="step-count">33%</div>
                        <div class="step-progress">
                            <div style="width: 33%;" class="step-progress-inner"></div>
                        </div>
                    </div>
                    <div class="step-actions d-flex align-items-center gap-3 ">
                        <a href="" id="step-1-back-btn" class="step-back-btn">
                            Back
                        </a>
                        <button id="step-1-next-btn" class="step-next-btn">
                            Next
                        </button>
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
            <div class="price-range-container">
                <div class="step-count-title ">
                    <span>2</span>/3 Create Profile
                </div>
                <div class="step-title ">
                    How Far Are You Willing to Travel
                </div>

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
                                <input type="range" id="free-radius" min="0" max="100" value="0">
                                <div id="indicator-free-radius" class="value-indicator">0</div>
                            </div>
                        </div>
                        <div class="range-price">
                            <div class="range-title">
                                Charge for this radius
                            </div>
                            <div style="background-color: #E9E9E9;" class="range-price-input mt-3">
                                <input disabled value="0" type="number" name="" id="">
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="range-slider-content">
                            <div class="range-title">
                                <span>Set your travel Radius </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2.40234 12.0781C2.40234 6.51213 6.91447 2 12.4805 2C18.0465 2 22.5586 6.51213 22.5586 12.0781C22.5586 17.6442 18.0465 22.1562 12.4805 22.1562C6.91447 22.1562 2.40234 17.6442 2.40234 12.0781ZM12.4805 10.9062C12.8688 10.9062 13.1836 11.2211 13.1836 11.6094V16.2969C13.1836 16.6852 12.8688 17 12.4805 17C12.0922 17 11.7773 16.6852 11.7773 16.2969V11.6094C11.7773 11.2211 12.0922 10.9062 12.4805 10.9062ZM13.0125 8.32883C13.2723 8.04019 13.2488 7.59561 12.9602 7.33584C12.6715 7.07606 12.227 7.09946 11.9672 7.3881L11.9578 7.39852C11.698 7.68716 11.7215 8.13174 12.0101 8.39151C12.2988 8.65129 12.7433 8.62789 13.0031 8.33924L13.0125 8.32883Z"
                                        fill="#222222" />
                                </svg>
                            </div>
                            <div class="range-slider mt-4">
                                <input type="range" id="travel-radius" min="0" max="100" value="0">
                                <div id="indicator-travel-radius" class="value-indicator">0</div>
                            </div>
                        </div>
                        <div class="range-price">
                            <div class="range-title">
                                Charge for this radius
                            </div>
                            <div class="range-price-input mt-3">
                                <input value="50" type="number" name="" id="">
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
                                <input type="range" id="max-radius" min="0" max="100" value="0">
                                <div id="indicator-max-radius" class="value-indicator">0</div>
                            </div>
                        </div>
                        <div class="range-price">
                            <div class="range-title">
                                Charge for this radius
                            </div>
                            <div class="range-price-input mt-3">
                                <input value="100" type="number" name="" id="">
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="range-slider-content">
                            <div class="d-flex minimum-booking-value-container align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" name=""
                                    id="minimum-booking-checkbox">
                                <label
                                    style="
                            color: var(--Foundation-Black-black-500, #222);font-family: Helvetica Neue; font-style: normal;font-weight: 400;line-height: 150%;
                         "
                                    for="">
                                    Do you want to set any minimum booking value for traveling this far?
                                </label>
                            </div>
                        </div>
                        <div class="range-price">
                            <div class="range-title">
                                Minimum booking value
                            </div>
                            <div class="range-price-input minimum-booking-input mt-3">
                                <input disabled value="0" type="number" name="" id="minimum-booking-input">
                                <span>$</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- step progress start -->
                <div class="d-flex align-items-center mt-4 justify-content-between gap-3 flex-wrap ">
                    <div class="step-progress-container d-flex align-items-center gap-2 ">
                        <div class="step-count">70%</div>
                        <div class="step-progress">
                            <div style="width: 70%;" class="step-progress-inner"></div>
                        </div>
                    </div>
                    <div class="step-actions d-flex align-items-center gap-3 ">
                        <div href="" id="step-2-back-btn" class="step-back-btn">
                            Back
                        </div>
                        <div id="step-2-next-btn" class="step-next-btn">
                            Next
                        </div>
                    </div>
                </div>
                <!-- step progress end -->
            </div>
        </div>
        {{-- step 2 end --}}


        {{-- step 3 start --}}
        <div style="display: none;" id="service-provider-step-form-3">
            <div class="step-count-title text-center">
                <span>3</span>/3 Create Profile
            </div>
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
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->services_name }}</td>

                                <td>
                                    <div class="d-flex select-service-container align-items-center gap-3">
                                        <div class="form-check d-flex align-items-center gap-2">
                                            <input style="cursor: pointer;" class="form-check-input" type="radio"
                                                name="option{{ $service->id }}" id="yes{{ $service->id }}">
                                            <label style="cursor: pointer;" class="form-check-label"
                                                for="yes{{ $service->id }}">Yes</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center gap-2">
                                            <input style="cursor: pointer;" class="form-check-input" type="radio"
                                                name="option{{ $service->id }}" id="no{{ $service->id }}" checked>
                                            <label style="cursor: pointer;" class="form-check-label"
                                                for="no{{ $service->id }}">No</label>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="service-value-input disabled">
                                        <input value="" type="number" name="" id="">
                                        <span>$</span>
                                    </div>
                                </td>

                                <td>
                                    <div class="service-value-input">
                                        <input disabled class="service-charge" value="{{ $service->platform_fee }}%"
                                            type="text" name="platform_fee{{ $service->id }}"
                                            id="platform_fee{{ $service->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.90234 12.0781C2.90234 6.51213 7.41447 2 12.9805 2C18.5465 2 23.0586 6.51213 23.0586 12.0781C23.0586 17.6442 18.5465 22.1562 12.9805 22.1562C7.41447 22.1562 2.90234 17.6442 2.90234 12.0781ZM12.9805 10.9062C13.3688 10.9062 13.6836 11.2211 13.6836 11.6094V16.2969C13.6836 16.6852 13.3688 17 12.9805 17C12.5922 17 12.2773 16.6852 12.2773 16.2969V11.6094C12.2773 11.2211 12.5922 10.9062 12.9805 10.9062ZM13.5125 8.32883C13.7723 8.04019 13.7488 7.59561 13.4602 7.33584C13.1715 7.07606 12.727 7.09946 12.4672 7.3881L12.4578 7.39852C12.198 7.68716 12.2215 8.13174 12.5101 8.39151C12.7988 8.65129 13.2433 8.62789 13.5031 8.33924L13.5125 8.32883Z"
                                                fill="#6B6B6B" />
                                        </svg>
                                    </div>
                                </td>

                                <td>
                                    <div class="service-value-input">
                                        <input class="total-charge" disabled value="" type="number"
                                            name="" id="">
                                        <span>$</span>
                                    </div>
                                </td>

                                <td>
                                    <div class="service-value-input upload-service-img-container">
                                        <div style="cursor: pointer;" class="service-upload-img-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                                viewBox="0 0 25 24" fill="none">
                                                <path
                                                    d="M9.75 22H15.75C20.75 22 22.75 20 22.75 15V9C22.75 4 20.75 2 15.75 2H9.75C4.75 2 2.75 4 2.75 9V15C2.75 20 4.75 22 9.75 22Z"
                                                    stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M9.75 10C10.8546 10 11.75 9.10457 11.75 8C11.75 6.89543 10.8546 6 9.75 6C8.64543 6 7.75 6.89543 7.75 8C7.75 9.10457 8.64543 10 9.75 10Z"
                                                    stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M3.42188 18.95L8.35187 15.64C9.14187 15.11 10.2819 15.17 10.9919 15.78L11.3219 16.07C12.1019 16.74 13.3619 16.74 14.1419 16.07L18.3019 12.5C19.0819 11.83 20.3419 11.83 21.1219 12.5L22.7519 13.9"
                                                    stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span>Upload</span>
                                            <input class="service-file-input d-none" type="file" name=""
                                                id="">
                                        </div>
                                        <img style="max-width: 80px; max-height: 60px; border-radius: 4px; display: flex;
                                    margin: 0 auto; object-fit: cover;"
                                            class="service-uploaded-img" src="" alt="">

                                        <svg width="20px" class="service-delete-btn" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- step progress start --}}
            <div class="d-flex align-items-center mt-4 justify-content-between gap-3 flex-wrap ">
                <div class="step-progress-container d-flex align-items-center gap-2 ">
                    <div class="step-count">85%</div>
                    <div class="step-progress">
                        <div style="width: 85%;" class="step-progress-inner"></div>
                    </div>
                </div>
                <div class="step-actions d-flex align-items-center gap-3 ">
                    <div href="" id="step-3-back-btn" class="step-back-btn">
                        Back
                    </div>
                    <button type="submit" id="step-3-next-btn" class="step-next-btn">
                        Next
                    </button>
                </div>
            </div>
            {{-- step progress end --}}
        </div>
        {{-- step 3 end --}}
    </div>
@endsection

@push('scripts')
    <!-- for map -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const openMapBtn = document.getElementById('step-1-next-btn');
        openMapBtn.addEventListener('click', function() {
            const map = L.map('map').setView([0, 0], 13); // Temporary center
            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
            }).addTo(map);
            // Add a circle
            const circle = L.circle([0, 0], {
                color: 'rgba(88, 88, 88, 0.30)',
                weight: 2,
                fillColor: '#add8e6',
                fillOpacity: 0.5,
                radius: 20000, // Default radius: 20 km
            }).addTo(map);
            // Function to update the circle
            const updateCircle = (lat, lng, radius) => {
                circle.setLatLng([lat, lng]);
                circle.setRadius(radius * 1000); // Convert km to meters
                map.fitBounds(circle.getBounds(), {
                    padding: [20, 20]
                });
            };
            // Fetch user's precise location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const {
                            latitude,
                            longitude
                        } = position.coords;
                        map.setView([latitude, longitude], 13);
                        circle.setLatLng([latitude, longitude]);
                    },
                    (error) => {
                        console.error('Geolocation error:', error);
                        alert('Unable to fetch your location. Please allow location access.');
                    }
                );
            } else {
                alert('Geolocation is not supported by your browser.');
            }
            // Sliders for radius adjustment
            const freeRadiusInput = document.getElementById('free-radius');
            const travelRadiusInput = document.getElementById('travel-radius');
            const maxRadiusInput = document.getElementById('max-radius');
            const freeRadiusValue = document.getElementById('indicator-free-radius');
            const travelRadiusValue = document.getElementById('indicator-travel-radius');
            const maxRadiusValue = document.getElementById('indicator-max-radius');
            // Event listeners for sliders
            freeRadiusInput.addEventListener('input', (e) => {
                const value = e.target.value;
                freeRadiusValue.textContent = `${value} km`;
                updateCircle(circle.getLatLng().lat, circle.getLatLng().lng, value);
            });
            travelRadiusInput.addEventListener('input', (e) => {
                const value = e.target.value;
                travelRadiusValue.textContent = `${value} km`;
                updateCircle(circle.getLatLng().lat, circle.getLatLng().lng, value);
            });
            maxRadiusInput.addEventListener('input', (e) => {
                const value = e.target.value;
                maxRadiusValue.textContent = `${value} km`;
                updateCircle(circle.getLatLng().lat, circle.getLatLng().lng, value);
            });
        });
    </script>

    <!--  for range slider  -->
    <script>
        // Helper function to update the slider value and position
        function updateSliderValue(slider, indicator) {
            const value = slider.value;
            const min = slider.min;
            const max = slider.max;

            // Update the value text
            indicator.textContent = value;

            // Calculate the position of the indicator
            const percentage = ((value - min) / (max - min)) * 100;
            const offset = (percentage / 100) * slider.offsetWidth;

            // Update the position of the value indicator
            indicator.style.left = `${offset}px`;
        }

        // Initialize sliders
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

            // Add event listener for input
            slider.addEventListener("input", () => updateSliderValue(slider, indicator));

            // Initialize position and value
            updateSliderValue(slider, indicator);
        });
    </script>

    <!-- max price set -->
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

    <!-- upload profile image js -->
    <script>
        document.querySelector('.upload-profile-circle').addEventListener('click', function() {
            document.getElementById('upload-profile-input').click();
        });
        document.querySelector('.upload-profile-img-close-btn').addEventListener('click', () => {
            const imgElement = document.querySelector('.upload-profile-img img');
            imgElement.src = '';
            document.querySelector('.upload-profile-img').style.display = 'none';
            document.getElementById('upload-profile-input').value = '';
        })
        document.getElementById('upload-profile-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {

                const imgElement = document.querySelector('.upload-profile-img img');
                const reader = new FileReader();

                reader.onload = function(e) {
                    imgElement.src = e.target.result;
                };

                reader.readAsDataURL(file);
                document.querySelector('.upload-profile-img').style.display = 'block';
            }
        });
    </script>

    <!-- upload documents js -->
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

    <!-- for upload table img -->
    <script>
        // Get all upload containers
        const uploadContainers = document.querySelectorAll('.upload-service-img-container');

        // Loop through each container
        uploadContainers.forEach(container => {
            const uploadFileBtn = container.querySelector('.service-upload-img-btn');
            const uploadFileInput = container.querySelector('.service-file-input');
            const uploadedImg = container.querySelector('.service-uploaded-img');
            const serviceImgDeleteBtn = container.querySelector('.service-delete-btn');

            // Add click event to the upload button
            uploadFileBtn.addEventListener('click', () => {
                uploadFileInput.click(); // Simulate click on the file input
            });

            // Add change event to the file input
            uploadFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    // Load the selected file
                    reader.onload = function(e) {
                        uploadedImg.src = e.target.result; // Update the image source
                        uploadFileBtn.style.display = 'none';
                        serviceImgDeleteBtn.style.display = 'block';
                    };

                    reader.readAsDataURL(file); // Read the file as a Data URL
                }
            });

            // Add click event to delete the image
            serviceImgDeleteBtn.addEventListener('click', () => {
                uploadedImg.src = ''; // Clear the image source
                uploadFileBtn.style.display = 'flex';
                serviceImgDeleteBtn.style.display = 'none';
                uploadFileInput.value = ''; // Clear the file input
            });
        });
    </script>

    <!-- for yes or no btn clicked for table row -->
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

    <script>
        document.querySelectorAll('table tbody tr').forEach((row) => {
            const yesRadio = row.querySelector('input[id^="yes"]');
            const noRadio = row.querySelector('input[id^="no"]');
            const offeredPriceInput = row.querySelector('.service-value-input input[type="number"]');
            const platformFeeInput = row.querySelector('.service-charge');
            const totalChargeInput = row.querySelector('.total-charge');
            const uploadBtn = row.querySelector('.service-upload-img-btn');
            const deleteBtn = row.querySelector('.service-delete-btn');

            function toggleFields(enabled) {
                offeredPriceInput.disabled = !enabled;
                totalChargeInput.disabled = true;
                uploadBtn.style.pointerEvents = enabled ? 'auto' : 'none';
                deleteBtn.style.pointerEvents = enabled ? 'auto' : 'none';
                row.querySelector('.service-value-input').classList.toggle('disabled', !enabled);
            }

            yesRadio.addEventListener('change', () => {
                if (yesRadio.checked) toggleFields(true);
            });
            noRadio.addEventListener('change', () => {
                if (noRadio.checked) {
                    toggleFields(false);
                    offeredPriceInput.value = '';
                    totalChargeInput.value = '';
                }
            });

            offeredPriceInput.addEventListener('input', () => {
                const fee = parseFloat(platformFeeInput.value.replace('%', '')) || 0;
                const price = parseFloat(offeredPriceInput.value) || 0;
                totalChargeInput.value = (((price * fee) / 100) + price).toFixed(2);
            });
        });
    </script>

    <!-- for changing steps -->
    <script>
        const step1 = document.getElementById('service-provider-step-form-1');
        const step2 = document.getElementById('service-provider-step-form-2');
        const step3 = document.getElementById('service-provider-step-form-3');

        const step1NextBtn = document.getElementById('step-1-next-btn');
        const step2BackBtn = document.getElementById('step-2-back-btn');
        const step2NextBtn = document.getElementById('step-2-next-btn');
        const step3BackBtn = document.getElementById('step-3-back-btn');
        const step3NextBtn = document.getElementById('step-3-next-btn');

        step1NextBtn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData();
            formData.append('avatar', document.getElementById('upload-profile-input').files[0]);
            formData.append('name', document.querySelector('input[placeholder="Enter Your Full Name"]').value);
            formData.append('bio', document.querySelector('input[placeholder="Write something about your service"]')
                .value);
            formData.append('business_name', document.querySelector(
                'input[placeholder="Enter your Business Address"]').value);
            formData.append('professional_title', document.querySelector(
                'input[placeholder="Enter your Professional Title"]').value);
            formData.append('license', document.getElementById('file-upload').files[0]);

            axios.post('{{ route('business-information.store') }}', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    // Handle success response
                    console.log(response.data);
                    // Proceed to the next step
                    step1.style.display = "none";
                    step2.style.display = "flex";
                    step2.style.opacity = 1;
                    step2.style.visibility = "visible";
                })
                .catch(error => {
                    // Handle error response
                    console.error(error);
                });
        });

        step2BackBtn.addEventListener('click', () => {
            step2.style.display = "none";
            step1.style.display = "flex";
        })

        step2NextBtn.addEventListener('click', () => {
            step2.style.display = "none";
            step3.style.display = "block";
        })

        step3BackBtn.addEventListener('click', () => {
            step3.style.display = "none";
            step2.style.display = "flex";
        })

        document.getElementById('step-3-next-btn').addEventListener('click', async (event) => {
            event.preventDefault();
            const servicesData = [];
            document.querySelectorAll('table tbody tr').forEach((row) => {
                const serviceId = row.querySelector('input[type="radio"]').name.replace('option', '');
                const yesRadio = row.querySelector(`#yes${serviceId}`);
                if (!yesRadio.checked) return; // Skip if "No" is selected
                const offeredPriceInput = row.querySelector(
                    '.service-value-input input[type="number"]');
                const totalChargeInput = row.querySelector('.total-charge');
                servicesData.push({
                    service_id: serviceId,
                    selected: 1,
                    offered_price: offeredPriceInput.value || 0,
                    total_price: totalChargeInput.value || 0,
                });
            });

            const formData = new FormData();
            servicesData.forEach((service, index) => {
                formData.append(`services[${index}][service_id]`, service.service_id);
                formData.append(`services[${index}][selected]`, service.selected);
                formData.append(`services[${index}][offered_price]`, service.offered_price);
                formData.append(`services[${index}][total_price]`, service.total_price);
                const rowFileInput = document.querySelector(`#yes${service.service_id}`)
                    .closest('tr')
                    .querySelector('.service-file-input').files[0];
                if (rowFileInput) {
                    formData.append(`services[${index}][image]`, rowFileInput);
                }
            });

            try {
                await axios.post("{{ route('business-information.store') }}", formData);
                window.location.href = "{{ route('beauty-expert-dashboard') }}";
            } catch (err) {
                console.error(err);
                alert('Failed to save services');
            }
        });
    </script>
@endpush
