@extends('backend.app')

@section('title', 'Social Media Settings')

@push('styles')
    <style>
        .drop-custom {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
            padding: 15px;
            border: 1px solid #4CAF50;
            color: #313131;
            transition: all 0.3s ease;
        }

        .drop-custom:hover {
            background-color: #414241;
            color: white;
        }

        .btn {
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.1);
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('social.index') }}">Settings</a></li>
                                <li class="breadcrumb-item active">Social Media Settings</li>
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
                            <form action="{{ route('social.update') }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-outline-secondary" type="button" onclick="addSocialField()"
                                        style="font-weight: 900" title="Add a new social media field">Add</button>
                                </div>
                                <div id="social_media_container">
                                    @foreach ($social_link as $index => $link)
                                        <div class="social_media input-group mb-3">
                                            <input type="hidden" name="social_media_id[]" value="{{ $link->id }}">
                                            <select class="dropdown-toggle drop-custom" name="social_media[]"
                                                value="@isset($social_link){{ $link->social_media }}@endisset"
                                                title="Select a social media platform">
                                                <option class="dropdown-item">Select Social</option>
                                                <option class="dropdown-item" value="facebook"
                                                    {{ $link->social_media == 'facebook' ? 'selected' : '' }}>Facebook
                                                </option>
                                                <option class="dropdown-item" value="instagram"
                                                    {{ $link->social_media == 'instagram' ? 'selected' : '' }}>Instagram
                                                </option>
                                                <option class="dropdown-item" value="twitter"
                                                    {{ $link->social_media == 'twitter' ? 'selected' : '' }}>Twitter
                                                </option>
                                                <option class="dropdown-item" value="tiktok"
                                                    {{ $link->social_media == 'tiktok' ? 'selected' : '' }}>Tiktok
                                                </option>
                                                <option class="dropdown-item" value="youtube"
                                                    {{ $link->social_media == 'youtube' ? 'selected' : '' }}>YouTube
                                                </option>
                                                <option class="dropdown-item" value="linkedin"
                                                    {{ $link->social_media == 'linkedin' ? 'selected' : '' }}>Linkedin
                                                </option>
                                            </select>
                                            <input type="url" class="form-control"
                                                aria-label="Text input with dropdown button" name="profile_link[]"
                                                value="@isset($social_link){{ $link->profile_link }}@endisset"
                                                placeholder="Enter the profile link here"
                                                title="Enter the profile link here">
                                            <button class="btn btn-danger" type="button" onclick="removeSocialField(this)"
                                                style="font-weight: 900" data-id="{{ $link->id }}"
                                                title="Remove this social media field">Remove</button>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary" title="Submit the form">Submit</button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-danger me-2"
                                        title="Cancel and go back to the dashboard">Cancel</a>
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
        let socialFieldsCount = $('#social_media_container .social_media').length;

        function addSocialField() {
            const socialFieldsContainer = document.getElementById("social_media_container");

            if (socialFieldsCount < 6) {
                const newSocialField = document.createElement("div");
                newSocialField.className = "social_media input-group mb-3";
                newSocialField.innerHTML =
                    `
            <select class="dropdown-toggle drop-custom" name="social_media[]" title="Select a social media platform">
                <option class="dropdown-item">Select Social</option>
                <option class="dropdown-item" value="facebook">Facebook</option>
                <option class="dropdown-item" value="instagram">Instagram</option>
                <option class="dropdown-item" value="twitter">Twitter</option>
                <option class="dropdown-item" value="tiktok">Tiktok</option>
                <option class="dropdown-item" value="youtube">YouTube</option>
                <option class="dropdown-item" value="linkedin">Linkedin</option>
            </select>
            <input type="url" class="form-control" aria-label="Text input with dropdown button" name="profile_link[]" placeholder="Enter the profile link here" title="Enter the profile link here">
            <button class="btn btn-danger" type="button" onclick="removeSocialField(this)" style="font-weight: 900" title="Remove this social media field">Remove</button>`;

                socialFieldsContainer.appendChild(newSocialField);
                socialFieldsCount++;
                document.querySelectorAll('select[name="social_media[]"]').forEach(selectElement => {
                    selectElement.removeEventListener('change', checkForDuplicateSocialMedia);
                    selectElement.addEventListener('change', checkForDuplicateSocialMedia);
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You can only add six social links fields!",
                });
            }
        }

        function removeSocialField(button) {
            const socialField = button.parentElement;
            socialField.remove();
            socialFieldsCount--;
            checkForDuplicateSocialMedia();
        }

        function checkForDuplicateSocialMedia() {
            const allSelections = document.querySelectorAll('select[name="social_media[]"]');
            const allValues = Array.from(allSelections).map(select => select.value);
            const hasDuplicate = allValues.some((value, index) => allValues.indexOf(value) !== index && value !==
                "Select Social");

            if (hasDuplicate) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You cannot add the same social media platform more than once.",
                });
                allSelections.forEach(selectElement => {
                    if (allValues.filter(value => value === selectElement.value).length > 1) {
                        selectElement.value = "Select Social";
                    }
                });
            }
        }

        window.removeSocialField = function(button) {
            const socialLinkId = $(button).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                url: '{{ route('social.delete', '') }}/' + socialLinkId,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $(button).closest('.social_media').remove();
                    socialFieldsCount--;
                    if (response.success === true) {
                        toastr.success(response.message);
                    } else if (response.errors) {
                        toastr.error(response.errors[0]);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong. Please try again.",
                    });
                }
            });
        };

        document.querySelectorAll('select[name="social_media[]"]').forEach(selectElement => {
            selectElement.addEventListener('change', checkForDuplicateSocialMedia);
        });
    </script>
@endpush
