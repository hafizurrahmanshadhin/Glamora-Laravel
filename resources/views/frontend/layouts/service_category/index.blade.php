@extends('frontend.app')

@section('title', 'Service Category')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}" />
@endpush

@section('content')
    <main>
        {{-- service category banner section start --}}
        <section class="service-category-banner-section">
            <div class="service-banner-content-wrapper">
                <h1>Explore Our Categories of Expert <span>Beauty Services</span> </h1>
                <p>
                    Find the perfect beauty professional for your unique
                    needs. Whether you're looking for a stunning new
                    hairstyle, flawless makeup for a special event, or a
                    refreshing spa experience, we have an expert ready to
                    help you shine.
                </p>

                {{-- search container start --}}
                <div class="search-container ">
                    <div class="item location">
                        <div class="title">Location</div>
                        <input id="location-input" placeholder="Search" type="text" value="{{ request('location') }}">
                    </div>

                    <div class="item date">
                        <div class="title">Date</div>
                        <div class="date-picker-container">
                            <input id="date-input" placeholder="DD/MM/YY" type="text" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20"
                                fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M13.9109 0.768617L13.9119 1.51824C16.6665 1.73413 18.4862 3.61119 18.4891 6.48975L18.5 14.9155C18.5039 18.054 16.5322 19.985 13.3718 19.99L5.65188 20C2.51119 20.004 0.514817 18.027 0.510867 14.8795L0.500007 6.55272C0.496057 3.65517 2.25153 1.78311 5.00617 1.53024L5.00518 0.780611C5.0042 0.340832 5.33001 0.00999726 5.76444 0.00999726C6.19886 0.00899776 6.52468 0.338833 6.52567 0.778612L6.52666 1.47826L12.3914 1.47027L12.3904 0.770616C12.3894 0.330837 12.7152 0.00100177 13.1497 2.26549e-06C13.5742 -0.000997234 13.9099 0.328838 13.9109 0.768617ZM2.02148 6.86157L16.9696 6.84158V6.49175C16.9272 4.34283 15.849 3.21539 13.9138 3.04748L13.9148 3.81709C13.9148 4.24688 13.5801 4.5877 13.1556 4.5877C12.7212 4.5887 12.3943 4.24887 12.3943 3.81909L12.3934 3.0095L6.52863 3.01749L6.52962 3.82609C6.52962 4.25687 6.20479 4.5967 5.77036 4.5967C5.33594 4.5977 5.00913 4.25887 5.00913 3.82809L5.00815 3.05847C3.08286 3.25137 2.01753 4.38281 2.02049 6.55072L2.02148 6.86157ZM12.7399 11.4043V11.4153C12.7498 11.8751 13.125 12.2239 13.5801 12.2139C14.0244 12.2029 14.3789 11.8221 14.369 11.3623C14.3483 10.9225 13.9918 10.5637 13.5485 10.5647C13.0944 10.5747 12.7389 10.9445 12.7399 11.4043ZM13.5554 15.892C13.1013 15.882 12.735 15.5032 12.734 15.0435C12.7241 14.5837 13.0884 14.2029 13.5426 14.1919H13.5525C14.0165 14.1919 14.3927 14.5707 14.3927 15.0405C14.3937 15.5102 14.0185 15.891 13.5554 15.892ZM8.67212 11.4203C8.69187 11.8801 9.06804 12.2389 9.52221 12.2189C9.96651 12.1979 10.321 11.8181 10.3012 11.3583C10.2903 10.9085 9.92504 10.5587 9.48074 10.5597C9.02657 10.5797 8.67113 10.9605 8.67212 11.4203ZM9.52616 15.8471C9.07199 15.8671 8.6968 15.5082 8.67607 15.0485C8.67607 14.5887 9.03052 14.2089 9.48469 14.1879C9.92899 14.1869 10.2953 14.5367 10.3052 14.9855C10.3259 15.4463 9.97046 15.8261 9.52616 15.8471ZM4.60433 11.4553C4.62408 11.915 5.00025 12.2749 5.45442 12.2539C5.89872 12.2339 6.25317 11.8531 6.23243 11.3933C6.22256 10.9435 5.85725 10.5937 5.41196 10.5947C4.95779 10.6147 4.60334 10.9955 4.60433 11.4553ZM5.45837 15.8521C5.0042 15.8731 4.62901 15.5132 4.60828 15.0535C4.60729 14.5937 4.96273 14.2129 5.4169 14.1929C5.8612 14.1919 6.2275 14.5417 6.23737 14.9915C6.2581 15.4513 5.90365 15.8321 5.45837 15.8521Z"
                                    fill="#767676" />
                            </svg>
                        </div>
                    </div>

                    <div class="item service">
                        <div class="title">Service</div>
                        <div class="select-service-container">
                            <div class="select-service-btn">
                                <span class="selected-person-count">Select</span>
                                <svg fill="#767676" width="22px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path
                                        d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM504 312l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                                </svg>
                            </div>

                            <div class="selected-service-container">
                                <div class="selected-service-container-list">
                                </div>
                                <div class="selected-service-container-top mt-4">
                                    <div class="selected-service-container-count">
                                        <div class="service-count"><span id="service-count">0</span> Person</div>
                                        <div class="add-service-btn">Add Service</div>
                                    </div>
                                </div>
                                <div class="done-btn">Done</div>
                            </div>

                            <div class="select-service-dropdown">
                                <div class="select-service-dropdown-options d-flex flex-column gap-3 ">
                                    <div class="item d-flex flex-column gap-2">
                                        <div class="title">Select who would like the service</div>
                                        <select id="service-selector" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>Select</option>
                                            <option value="Non Bridal">Non Bridal (Party, Special Occasion)</option>
                                            <option value="Bride">Bride</option>
                                            <option value="Flower Girl">Flower Girl</option>
                                        </select>
                                    </div>

                                    <div class="item d-flex flex-column gap-2">
                                        <div class="title">What service would you like?</div>
                                        <select name="serviceId" class="form-select" id="sub-service-selector">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->services_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="d-flex gap-4 align-items-center ">
                                    <div style="display: none;" class="select-service-dropdown-add-btn mt-4">Add</div>
                                    <div class="select-service-dropdown-cancel-btn mt-4">Cancel</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="search-btn-container">
                        <div class="title"></div>
                        <input type="hidden" name="service_id" id="service_id">
                        <button id="searchBtn" class="search-btn mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30"
                                fill="none">
                                <path
                                    d="M14.0938 23.4375C19.5303 23.4375 23.9375 19.0303 23.9375 13.5938C23.9375 8.1572 19.5303 3.75 14.0938 3.75C8.6572 3.75 4.25 8.1572 4.25 13.5938C4.25 19.0303 8.6572 23.4375 14.0938 23.4375Z"
                                    stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21.0547 20.5547L26.7501 26.2501" stroke="white" stroke-width="3"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
                {{-- search container end --}}
            </div>
        </section>
        {{-- service category banner section end --}}

        {{-- service category start --}}
        <div class="categories-tax-service-section">
            <div class="section-padding-x">
                <div class="categories-tax-card-wrapper">
                    @foreach ($services as $service)
                        <div class="categories-tax-single-card">
                            <div class="catagories-tax-card-hover d-none"></div>
                            <h3>{{ $service->services_name ?? '' }}</h3>
                            <a href="{{ route('available-services', ['serviceId' => $service->id]) }}">Explore
                                <img src="{{ asset('frontend/images/arrow-right.svg') }}" alt>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- service category end --}}

        @include('frontend.partials.join-us')
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Array to hold the selected services.
            let selectedServices = [];

            // Get references to all necessary elements.
            const serviceSelector = document.getElementById("service-selector");
            const subServiceSelector = document.getElementById("sub-service-selector");
            const addButton = document.querySelector(".select-service-dropdown-add-btn");
            const openServiceBtn = document.querySelector(".select-service-btn");
            const doneBtn = document.querySelector(".done-btn");
            const cancelBtn = document.querySelector(".select-service-dropdown-cancel-btn");
            const selectedServiceContainer = document.querySelector(".selected-service-container");
            const selectServiceDropdown = document.querySelector(".select-service-dropdown");
            const selectedContainer = document.querySelector(".selected-service-container-list");
            const serviceCount = document.getElementById("service-count");
            const personCount = document.querySelector(".selected-person-count");

            // Function to update hidden input based on selected services array.
            function updateHiddenInput() {
                let serviceIds = selectedServices.map(item => item.subService).join(',');
                document.getElementById("service_id").value = serviceIds;
            }

            // Function to render the list of selected services.
            const renderSelectedServices = () => {
                selectedContainer.innerHTML = ""; // Clear current list

                selectedServices.forEach((item, index) => {
                    const serviceItem = document.createElement("div");
                    serviceItem.classList.add("service-item");
                    serviceItem.innerHTML = `
                        <div class="item-left">
                            <div class="item-title">${index + 1}. ${item.service}</div>
                            <div class="item-sub-title">${item.subService}</div>
                        </div>
                        <div class="item-right">
                            <span style="cursor:pointer" class="item-delete-btn" data-index="${index}">
                                &#10005;
                            </span>
                        </div>
                    `;
                    selectedContainer.appendChild(serviceItem);
                });

                // Update the service count and selected person text.
                serviceCount.innerText = selectedServices.length;
                personCount.innerText = selectedServices.length > 0 ?
                    `${selectedServices.length} Person${selectedServices.length > 1 ? "s" : ""}` :
                    "Select";

                // Attach delete functionality.
                document.querySelectorAll(".item-delete-btn").forEach((btn) => {
                    btn.addEventListener("click", (event) => {
                        const index = event.target.getAttribute("data-index");
                        selectedServices.splice(index, 1); // Remove from array
                        renderSelectedServices(); // Re-render UI
                        if (selectedServices.length === 0) {
                            addButton.style.display = "block";
                            selectServiceDropdown.style.display = "block";
                        }
                        updateHiddenInput();
                    });
                });
            };

            // Function to check if both selects have valid selections.
            function checkSelection() {
                if (serviceSelector.value !== "Select" && subServiceSelector.value !== "Select") {
                    addButton.style.display = "block"; // Show "Add" button
                } else {
                    addButton.style.display = "none"; // Hide "Add" button
                }
            }

            // Attach change listeners to update button display.
            serviceSelector.addEventListener("change", checkSelection);
            subServiceSelector.addEventListener("change", checkSelection);
            checkSelection(); // Initial check

            // Add button click event.
            addButton.addEventListener("click", () => {
                const selectedService = serviceSelector.value;
                const selectedSubService = subServiceSelector.value;

                // Validate selection.
                if (selectedService === "Select" || selectedSubService === "Select") {
                    alert("Please select a valid service and sub-service.");
                    return;
                }

                // Add the selection to the array.
                selectedServices.push({
                    service: selectedService,
                    subService: selectedSubService // This should be the service ID or service name as needed.
                });

                // Update hidden input with the full array.
                updateHiddenInput();

                // Hide the add button and dropdown, then re-render.
                addButton.style.display = "none";
                selectedServiceContainer.style.display = 'block';
                renderSelectedServices();
                selectServiceDropdown.style.display = "none";
            });

            // Additional UI toggling handlers.
            doneBtn.addEventListener('click', () => {
                selectedServiceContainer.style.display = "none";
            });

            openServiceBtn.addEventListener("click", () => {
                selectedServiceContainer.style.display = "flex";
            });

            cancelBtn.addEventListener("click", () => {
                selectServiceDropdown.style.display = "none";
                selectedServiceContainer.style.display = "block";
                addButton.style.display = "none";
                serviceSelector.value = "Select";
                subServiceSelector.value = "Select";
            });

            // Search button handler remains unchanged.
            document.getElementById('searchBtn').addEventListener('click', function() {
                let selectedServiceIds = document.getElementById('service_id').value.trim();
                if (!selectedServiceIds) {
                    return;
                }
                let locationInput = document.getElementById('location-input').value.trim();
                let queryParams = new URLSearchParams();
                queryParams.append('service_ids', selectedServiceIds);
                if (locationInput) {
                    queryParams.append('location', locationInput);
                }
                let url = "{{ url('available-services') }}";
                if (queryParams.toString()) {
                    url += '?' + queryParams.toString();
                }
                window.location.href = url;
            });
        });
    </script>
@endpush
