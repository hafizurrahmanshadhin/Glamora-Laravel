@extends('frontend.app')

@section('title', 'Contact')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/magnific-popup.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}" />
@endpush

@section('content')
    <main>
        <section class="padding-top-from-header section-padding-x">
            <div class="armie-contact-container">
                <div class="armie-contact-info">
                    <h2>Have any question? feel free to contact with us.</h2>
                    <div class="armie-info-item">
                        <span class="contact-svg-span">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                fill="none">
                                <path
                                    d="M9.14403 3.25931C10.668 4.36998 11.8547 5.88598 12.868 7.33664L13.4574 8.19531L14.0134 9.01531C14.2915 9.42162 14.4104 9.91604 14.3474 10.4044C14.2845 10.8927 14.0441 11.3408 13.672 11.6633L11.0707 13.5953C10.945 13.6861 10.8566 13.8194 10.8217 13.9704C10.7869 14.1215 10.8081 14.28 10.8814 14.4166C11.4707 15.4873 12.5187 17.082 13.7187 18.282C14.9187 19.482 16.5894 20.5993 17.7347 21.2553C17.8783 21.3359 18.0473 21.3585 18.207 21.3183C18.3667 21.2781 18.505 21.1783 18.5934 21.0393L20.2867 18.462C20.598 18.0484 21.0573 17.7714 21.5683 17.6889C22.0793 17.6064 22.6024 17.7248 23.028 18.0193L23.912 18.6313C25.564 19.778 27.3387 21.0806 28.696 22.818C28.9113 23.095 29.0482 23.4248 29.0926 23.7729C29.1369 24.1209 29.087 24.4745 28.948 24.7966C27.832 27.4006 25.008 29.618 22.0707 29.51L21.6707 29.4873L21.36 29.4606L21.016 29.4206L20.6414 29.37L20.2347 29.3033L20.0214 29.2633L19.5734 29.1673L19.3387 29.114L18.8507 28.9886L18.3374 28.842L17.8014 28.6686C15.34 27.834 12.216 26.194 9.0107 22.9886C5.80536 19.7833 4.1667 16.6606 3.33203 14.1993L3.1587 13.6633L3.01203 13.15L2.8867 12.662L2.7827 12.2006C2.75269 12.0561 2.72469 11.9112 2.6987 11.766L2.63203 11.3593L2.5787 10.9846L2.54003 10.6406L2.51336 10.33L2.49203 9.92998C2.38403 7.00198 4.62536 4.15798 7.21736 3.04731C7.52933 2.9126 7.87096 2.86131 8.20874 2.89848C8.54651 2.93564 8.86882 3.05999 9.14403 3.25931ZM19.9907 8.05264L20.1454 8.06998C21.1159 8.24117 22.0073 8.71523 22.6919 9.42422C23.3764 10.1332 23.819 11.0407 23.956 12.0166C24.0049 12.3542 23.9225 12.6977 23.7259 12.9764C23.5292 13.2551 23.2333 13.4478 22.8988 13.5149C22.5644 13.5821 22.217 13.5185 21.928 13.3372C21.6391 13.156 21.4305 12.8709 21.3454 12.5406L21.3147 12.3873C21.2611 12.0048 21.0978 11.646 20.8446 11.3542C20.5914 11.0625 20.2592 10.8503 19.888 10.7433L19.6814 10.6966C19.3466 10.6373 19.0471 10.4523 18.8442 10.1795C18.6413 9.90661 18.5502 9.56656 18.5898 9.22884C18.6293 8.89112 18.7963 8.58125 19.0567 8.36262C19.3171 8.14399 19.6512 8.0331 19.9907 8.05264ZM20.0014 3.99931C22.1231 3.99931 24.1579 4.84217 25.6582 6.34246C27.1585 7.84275 28.0014 9.87758 28.0014 11.9993C28.001 12.3392 27.8709 12.666 27.6376 12.9131C27.4043 13.1603 27.0854 13.309 26.7462 13.3289C26.4069 13.3488 26.0729 13.2384 25.8123 13.0203C25.5516 12.8022 25.3842 12.4928 25.344 12.1553L25.3347 11.9993C25.3346 10.6454 24.8195 9.3422 23.894 8.35402C22.9684 7.36585 21.7017 6.76666 20.3507 6.67798L20.0014 6.66598C19.6477 6.66598 19.3086 6.5255 19.0586 6.27545C18.8085 6.0254 18.668 5.68627 18.668 5.33264C18.668 4.97902 18.8085 4.63988 19.0586 4.38984C19.3086 4.13979 19.6477 3.99931 20.0014 3.99931Z"
                                    fill="white" />
                            </svg>
                        </span>
                        <div class="contact-address-para">
                            <p class="contact-address-text">CALL US FOR immediate SUPPORT</p>
                            <a class="contact-address-way" href="tel:+666-888-0000">666-888-0000</a>
                        </div>
                    </div>

                    <div class="armie-info-item">
                        <span class="contact-svg-span">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                fill="none">
                                <path
                                    d="M16.0008 23.1996C15.1963 23.1998 14.4213 22.8969 13.83 22.3513C13.2388 21.8058 12.8747 21.0575 12.8104 20.2556C10.6763 19.5002 8.87766 18.0152 7.73202 16.0626C6.58638 14.11 6.16738 11.8155 6.54898 9.58404C6.93059 7.35258 8.08826 5.32768 9.81765 3.86678C11.547 2.40588 13.7369 1.60291 16.0008 1.59961C18.4086 1.59926 20.7287 2.50375 22.5009 4.13373C24.2731 5.76371 25.3681 8.00015 25.5688 10.3996C25.5755 10.5037 25.5604 10.608 25.5246 10.706C25.4888 10.8039 25.433 10.8934 25.3608 10.9686C25.2886 11.0438 25.2015 11.1032 25.1051 11.143C25.0087 11.1828 24.905 11.202 24.8008 11.1996C24.5865 11.1942 24.3818 11.1094 24.2266 10.9615C24.0713 10.8137 23.9766 10.6134 23.9608 10.3996C23.8183 8.98495 23.3013 7.63382 22.4632 6.48532C21.625 5.33683 20.4959 4.43247 19.192 3.86535C17.8882 3.29823 16.4568 3.08883 15.0452 3.25872C13.6335 3.42861 12.2927 3.97165 11.1606 4.83193C10.0286 5.69221 9.14629 6.83864 8.60454 8.15321C8.06279 9.46778 7.88118 10.903 8.07839 12.3111C8.27561 13.7191 8.84453 15.0492 9.72659 16.1644C10.6086 17.2795 11.772 18.1394 13.0968 18.6556C13.3378 18.1347 13.7146 17.6883 14.1875 17.363C14.6604 17.0378 15.212 16.8457 15.7847 16.8069C16.3573 16.7681 16.9298 16.8841 17.4423 17.1426C17.9547 17.4012 18.3882 17.7928 18.6972 18.2764C19.0063 18.76 19.1796 19.3179 19.199 19.8915C19.2184 20.4651 19.0832 21.0334 18.8075 21.5368C18.5318 22.0402 18.1257 22.4602 17.6319 22.7527C17.1381 23.0453 16.5747 23.1996 16.0008 23.1996ZM8.01518 19.1996H8.16078C9.10535 20.1262 10.2066 20.8781 11.4136 21.4204C11.7683 22.5907 12.5563 23.5815 13.6167 24.1905C14.6772 24.7996 15.9301 24.9809 17.1197 24.6975C18.3092 24.4141 19.3458 23.6873 20.0177 22.6656C20.6897 21.6438 20.9463 20.4041 20.7352 19.1996H24.0008C24.8495 19.1996 25.6634 19.5368 26.2635 20.1369C26.8636 20.737 27.2008 21.5509 27.2008 22.3996C27.2008 25.1052 25.868 27.1452 23.7848 28.4748C21.7336 29.782 18.9688 30.3996 16.0008 30.3996C13.0328 30.3996 10.268 29.782 8.21678 28.4748C6.13358 27.1468 4.80078 25.1036 4.80078 22.3996C4.80078 20.6188 6.24558 19.1996 8.01518 19.1996ZM22.4008 11.1996C22.4011 12.2822 22.1268 13.3472 21.6036 14.295C21.0803 15.2428 20.3251 16.0423 19.4088 16.6188C18.9625 16.169 18.4316 15.8121 17.8467 15.5685C17.2618 15.3249 16.6344 15.1995 16.0008 15.1996C15.3672 15.1995 14.7398 15.3249 14.1549 15.5685C13.57 15.8121 13.0391 16.169 12.5928 16.6188C11.3775 15.8545 10.4544 14.7038 9.97198 13.3516C9.72587 12.6608 9.60031 11.9329 9.60078 11.1996C9.60078 9.50222 10.2751 7.87436 11.4753 6.67413C12.6755 5.47389 14.3034 4.79961 16.0008 4.79961C17.6982 4.79961 19.326 5.47389 20.5263 6.67413C21.7265 7.87436 22.4008 9.50222 22.4008 11.1996Z"
                                    fill="white" />
                            </svg>
                        </span>
                        <div class="contact-address-para">
                            <p class="contact-address-text">SEND US EMAIL FOR INQUIRY</p>
                            <a class="contact-address-way" href="mailto:electrico@gmail.com"> electrico@gmail.com </a>
                        </div>
                    </div>
                </div>

                <div class="armie-contact-form">
                    <form id="contactForm">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name"
                            value="{{ old('name') }}" required>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your Email"
                            value="{{ old('name') }}" required>

                        <label for="phone_number">Phone</label>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone"
                            value="{{ old('phone_number') }}" required>

                        <label for="Message">Subject</label>
                        <textarea id="Message" name="Message" placeholder="Type your text" required>{{ old('Message') }}</textarea>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>

        <section class="join-us-section">
            <div class="join-us-section-content">
                <h3>Join Us</h3>
                <h2>Discover Beauty Services</h2>
                <p>
                    Step into a world of top-rated beauty professionals ready
                    to cater to your unique needs. Whether you're looking
                    for a new look or routine care, our platform connects
                    you with the best beauty experts in your area. Explore a
                    variety of services and easily book appointments that
                    fit your schedule.
                </p>
                <a href="{{ route('join') }}" class="common-btn">Sign Up Now</a>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Clear previous error messages
            document.getElementById('nameError').innerText = '';
            document.getElementById('emailError').innerText = '';
            document.getElementById('phoneNumberError').innerText = '';
            document.getElementById('messageError').innerText = '';

            const formData = new FormData(this);

            axios.post('{{ route('contact.store') }}', formData)
                .then(response => {
                    toastr.success('Your message has been sent successfully!');
                    document.getElementById('contactForm').reset();
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        const errors = error.response.data.errors;
                        if (errors.name) {
                            document.getElementById('nameError').innerText = errors.name[0];
                        }
                        if (errors.email) {
                            document.getElementById('emailError').innerText = errors.email[0];
                        }
                        if (errors.phone_number) {
                            document.getElementById('phoneNumberError').innerText = errors.phone_number[0];
                        }
                        if (errors.Message) {
                            document.getElementById('messageError').innerText = errors.Message[0];
                        }
                        toastr.error('Please fix the errors and try again.');
                    } else {
                        toastr.error('An unexpected error occurred. Please try again later.');
                    }
                });
        });
    </script>
@endpush
