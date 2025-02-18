@extends('frontend.app')

@section('title', 'Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}" />
@endpush

@section('content')
    <main>
        <section class="padding-top-from-header">
            <div class="section-padding-x service-provider-profile-content-wrapper">
                <div class="service-profile-provider-content-left">
                    <div class="profile-info">
                        <div class="tm-profile-info-img-area">
                            <img src="{{ $user->avatar ?? asset('backend/images/default_images/user_1.jpg') }}"
                                alt="Profile Picture">
                        </div>
                        <div class="profile-details-wrapper">
                            <div class="profile-name-place-rating-wrapper">
                                <div class="profile-name-place">
                                    <h3>{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</h3>
                                    <p>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M14.5 9C14.5 10.3807 13.3807 11.5 12 11.5C10.6193 11.5 9.5 10.3807 9.5 9C9.5 7.61929 10.6193 6.5 12 6.5C13.3807 6.5 14.5 7.61929 14.5 9Z"
                                                    stroke="#222222" stroke-width="1.5" />
                                                <path
                                                    d="M18.2222 17C19.6167 18.9885 20.2838 20.0475 19.8865 20.8999C19.8466 20.9854 19.7999 21.0679 19.7469 21.1467C19.1724 22 17.6875 22 14.7178 22H9.28223C6.31251 22 4.82765 22 4.25311 21.1467C4.20005 21.0679 4.15339 20.9854 4.11355 20.8999C3.71619 20.0475 4.38326 18.9885 5.77778 17"
                                                    stroke="#222222" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M13.2574 17.4936C12.9201 17.8184 12.4693 18 12.0002 18C11.531 18 11.0802 17.8184 10.7429 17.4936C7.6543 14.5008 3.51519 11.1575 5.53371 6.30373C6.6251 3.67932 9.24494 2 12.0002 2C14.7554 2 17.3752 3.67933 18.4666 6.30373C20.4826 11.1514 16.3536 14.5111 13.2574 17.4936Z"
                                                    stroke="#222222" stroke-width="1.5" />
                                            </svg>
                                        </span>
                                        {{ $user->businessInformation && $user->businessInformation->business_address
                                            ? $user->businessInformation->business_address
                                            : 'No address provided' }}
                                    </p>
                                </div>
                                <div class="service-provider-rating" style="white-space: nowrap">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M11.0489 2.92705C11.3483 2.00574 12.6517 2.00574 12.9511 2.92705L14.4697 7.60081C14.6035 8.01284 14.9875 8.2918 15.4207 8.2918L20.335 8.2918C21.3037 8.2918 21.7065 9.53141 20.9228 10.1008L16.947 12.9894C16.5966 13.244 16.4499 13.6954 16.5838 14.1074L18.1024 18.7812C18.4017 19.7025 17.3472 20.4686 16.5635 19.8992L12.5878 17.0106C12.2373 16.756 11.7627 16.756 11.4122 17.0106L7.43648 19.8992C6.65276 20.4686 5.59828 19.7025 5.89763 18.7812L7.41623 14.1074C7.55011 13.6954 7.40345 13.244 7.05296 12.9894L3.07722 10.1008C2.29351 9.53141 2.69628 8.2918 3.66501 8.2918L8.57929 8.2918C9.01252 8.2918 9.39647 8.01284 9.53035 7.60081L11.0489 2.92705Z"
                                                fill="#FBB040" />
                                        </svg>
                                    </span> {{ $averageRating ?? '' }} ({{ $reviewCount ?? '' }})
                                </div>
                            </div>
                            <p class="profile-details-para">
                                {{ $user->businessInformation && $user->businessInformation->bio
                                    ? $user->businessInformation->bio
                                    : 'No bio provided.' }}
                            </p>
                        </div>
                    </div>

                    <div class="tm-services">
                        <h3>Services By
                            {{ $user->businessInformation ? $user->businessInformation->name : $user->first_name . ' ' . $user->last_name }}
                        </h3>
                        <div class="service-grid">
                            @forelse($user->userServices as $userService)
                                <a href="#" class="service-item">
                                    <div class="service-area-image-area">
                                        <img src="{{ $userService->image ? asset($userService->image) : asset('frontend/images/service-image.jpg') }}"
                                            alt="{{ $userService->service->services_name ?? 'Service Image' }}">
                                    </div>
                                    <div class="tm-service-name-price-wrapper">
                                        <h4>{{ $userService->service->services_name ?? 'Unknown Service' }}</h4>
                                        <h5 class="tm-price">{{ $userService->offered_price }}$</h5>
                                    </div>
                                </a>
                            @empty
                                <p>No services found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>


                <div class="service-profile-provider-content-right">
                    <div>
                        <div style="display:inline-flex" class="booking-box">
                            <a class="armie-check-availability" href="#">Edit Service Information</a>
                        </div>
                    </div>

                    <div class="tools-used">
                        <h3>Tools & Brands Used</h3>
                        <div class="tool-list" id="toolList">
                            @forelse($user->userTools as $tool)
                                <span class="tool-item" data-tool-id="{{ $tool->id }}">
                                    {{ $tool->tool_name }}
                                    <span class="tool-item-cross" data-tool-id="{{ $tool->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                            viewBox="0 0 21 22" fill="none">
                                            <rect y="0.5" width="21" height="21" rx="10.5" fill="#BABABA" />
                                            <path
                                                d="M15.7667 6.5L11.5139 11.3455L16 16.5H13.9543L10.509 12.3848L6.93801 16.5H5L9.50408 11.3455L5.28711 6.5H7.31485L10.5269 10.3483L13.8467 6.5H15.7667Z"
                                                fill="#6B6B6B" />
                                        </svg>
                                    </span>
                                </span>
                            @empty
                                <p>No tools added yet.</p>
                            @endforelse
                        </div>
                        <button type="button" class="add-new-btn" data-bs-toggle="modal" data-bs-target="#toolsSelect">
                            Add New
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                    d="M10 7V10M10 10V13M10 10H13M10 10H7M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                                    stroke="#3F3F46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="tm-service-gallery">
                        <h3>Gallery of Previous Work</h3>
                        <div class="gallery-grid">
                            @forelse($user->userServices as $userService)
                                <a href="#" class="gallery-item">
                                    <div class="gallery-item-img-area">
                                        <img src="{{ $userService->image ? asset($userService->image) : asset('frontend/images/service-image-2.jpg') }}"
                                            alt="{{ $userService->service->services_name ?? 'Bridal Makeup' }}">
                                    </div>
                                    <div class="tm-overlay"></div>
                                    <div class="tm-text-overlay">
                                        <p>{{ $userService->service->services_name ?? 'Bridal Makeup' }}</p>
                                    </div>
                                </a>
                            @empty
                                <p>No gallery items found.</p>
                            @endforelse
                        </div>

                        <button type="button" class="add-new-btn" data-bs-toggle="modal"
                            data-bs-target="#categorySelect">Add New
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                    d="M10 7V10M10 10V13M10 10H13M10 10H7M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                                    stroke="#3F3F46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>


            <div class="section-padding-x comment-area-about-service-provider">
                <h3 class="coment-heading-armie">
                    What Customers says about {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}
                </h3>
                <div class="armie-div-line"></div>
                <div class="tax-profile-left-comment-area">
                    @forelse($reviews as $review)
                        <div class="tax-profile-single-comment">
                            <div class="tax-profile-single-comment-header">
                                <div class="tax-profile-single-comment-author">
                                    <div class="tax-profile-single-comment-author-img">
                                        <img src="{{ asset($review->user->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                            alt="comment_author">
                                    </div>
                                    <div class="tax-profile-single-comment-author-name">
                                        <p>{{ $review->user->first_name ?? '' }} {{ $review->user->last_name ?? '' }}</p>
                                        <span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="none">
                                                    <path fill="{{ $i <= $review->rating ? '#FBB040' : '#cccccc' }}"
                                                        d="M12.4497 5.16294C12.4105 5.04741 12.3383 4.94589 12.242 4.87092C12.1457 4.79595 12.0296 4.75081 11.908 4.74108L8.34974 4.45838L6.80999 1.05044C6.76096 0.940672 6.6812 0.847445 6.58034 0.782004C6.47948 0.716563 6.36184 0.681707 6.2416 0.681641C6.12137 0.681575 6.00369 0.716302 5.90276 0.781632C5.80183 0.846962 5.72197 0.940102 5.67281 1.04981L4.13306 4.45838L0.574848 4.74108C0.455298 4.75055 0.341007 4.79426 0.245649 4.86697C0.150291 4.93969 0.0779045 5.03833 0.0371484 5.1511C-0.00360776 5.26387 -0.0110073 5.386 0.0158351 5.50286C0.0426776 5.61973 0.102625 5.72639 0.188506 5.81008L2.818 8.37306L1.88804 12.3994C1.8598 12.5213 1.86885 12.6489 1.91401 12.7655C1.95918 12.8822 2.03837 12.9826 2.14131 13.0537C2.24426 13.1248 2.3662 13.1634 2.49132 13.1643C2.61644 13.1653 2.73895 13.1286 2.84297 13.0591L6.2414 10.7938L9.63984 13.0591C9.74615 13.1297 9.87153 13.166 9.99911 13.1632C10.1267 13.1604 10.2504 13.1186 10.3535 13.0434C10.4566 12.9683 10.5342 12.8633 10.5759 12.7427C10.6176 12.6221 10.6213 12.4917 10.5867 12.3689L9.4451 8.37494L12.2762 5.82756C12.4616 5.66031 12.5296 5.39946 12.4497 5.16294Z" />
                                                </svg>
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                                <p class="tax-profile-single-comment-time">
                                    {{ $review->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <p class="tax-profile-single-comment-content">
                                {{ $review->review ?? '' }}
                            </p>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>


        {{-- Modal for tools added start --}}
        <div class="modal fade" id="toolsSelect" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="tm-category-upload-form" onsubmit="return false;">
                            <div class="tm-category-upload-form-content-wrapper">
                                <h2 class="tools-upload-heading">Add name of the Tools & Brands you use</h2>
                                <div class="tools-update-area">
                                    <input id="toolNameInput" class="tools-update-name-input" type="text"
                                        placeholder="Type here">
                                    <button type="button" id="btnAddTool" class="add-tools">Add</button>
                                </div>
                                <div class="tool-list" id="toolListModal">
                                </div>
                                <div class="tm-category-upload-form-button w-100 d-flex justify-content-end">
                                    <button type="button" class="common-btn" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal for tools added end --}}


        {{-- Modal for gallery item added start --}}
        <div class="modal fade" id="categorySelect" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action class="tm-category-upload-form">
                            <div class="tm-category-upload-form-content-wrapper">
                                <div class="tm-category-upload-form-img-area"
                                    onclick="document.getElementById('imageUpload').click();">
                                    <input type="file" id="imageUpload" accept="image/*" style="display: none;"
                                        onchange="previewImage(event)">
                                    <img id="preview" src alt="Upload Image">
                                    <p id="uploadText">Click to upload an
                                        image</p>
                                    <div class="edit-icon" id="editIcon" style="display: none;">
                                        <svg class="upload-profile-img-close-btn" width="30px"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path
                                                d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                <div class="tm-category-upload-form-dropdown-area w-100">
                                    <select class="tm-category-upload-form-dropdown-area-select w-100">
                                        <option selected>Select work
                                            Category</option>
                                        <option value="1">Hair
                                            Styling</option>
                                        <option value="2">Makeup</option>
                                        <option value="3">Nail Art</option>
                                    </select>
                                </div>

                                <div class="tm-category-upload-form-button w-100 d-flex justify-content-end">
                                    <button type="submit" class="common-btn">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal for gallery item added end --}}
    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("select").niceSelect();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $("#btnAddTool").off("click").on("click", function(e) {
                e.preventDefault();
                const toolInput = document.getElementById('toolNameInput');
                const toolName = toolInput.value.trim();
                if (!toolName) return;

                axios.post('{{ route('tools.store') }}', {
                        tool_name: toolName
                    })
                    .then(function(response) {
                        if (response.data.status) {
                            const tool = response.data.data;
                            const newSpan = `
                        <span class="tool-item" data-tool-id="${tool.id}">
                            ${tool.tool_name}
                            <span class="tool-item-cross" data-tool-id="${tool.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                    <rect y="0.5" width="21" height="21" rx="10.5" fill="#BABABA" />
                                    <path d="M15.7667 6.5L11.5139 11.3455L16 16.5H13.9543L10.509 12.3848L6.93801 16.5H5L9.50408 11.3455L5.28711 6.5H7.31485L10.5269 10.3483L13.8467 6.5H15.7667Z" fill="#6B6B6B" />
                                </svg>
                            </span>
                        </span>
                        `;
                            // Append the new tool to both the main tool list and modal's tool list
                            $("#toolList").append(newSpan);
                            $("#toolListModal").append(newSpan);
                            // Clear the input field
                            toolInput.value = '';
                        }
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            });

            // Axios listener for deleting a tool (using event delegation)
            $(document).on("click", ".tool-item-cross", function(e) {
                const toolId = $(this).data("tool-id");
                axios.delete('{{ route('tools.destroy', ':tool') }}'.replace(':tool', toolId))
                    .then(function(response) {
                        if (response.data.status) {
                            $(`.tool-item[data-tool-id="${toolId}"]`).remove();
                        }
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            });
        });
    </script>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                const uploadText = document.getElementById('uploadText');
                const editIcon = document.getElementById('editIcon');

                preview.src = reader.result;
                preview.style.display = "block"; // Show image
                uploadText.style.display = "none"; // Hide text
                editIcon.style.display = "flex"; // Show edit icon
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
