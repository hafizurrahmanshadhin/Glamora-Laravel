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
                    <h2>Have any question? feel free to contact us</h2>

                    <div class="armie-info-item">
                        <span class="contact-svg-span">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                fill="none">
                                <path
                                    d="M16.0008 23.1996C15.1963 23.1998 14.4213 22.8969 13.83 22.3513C13.2388 21.8058 12.8747 21.0575 12.8104 20.2556C10.6763 19.5002 8.87766 18.0152 7.73202 16.0626C6.58638 14.11 6.16738 11.8155 6.54898 9.58404C6.93059 7.35258 8.08826 5.32768 9.81765 3.86678C11.547 2.40588 13.7369 1.60291 16.0008 1.59961C18.4086 1.59926 20.7287 2.50375 22.5009 4.13373C24.2731 5.76371 25.3681 8.00015 25.5688 10.3996C25.5755 10.5037 25.5604 10.608 25.5246 10.706C25.4888 10.8039 25.433 10.8934 25.3608 10.9686C25.2886 11.0438 25.2015 11.1032 25.1051 11.143C25.0087 11.1828 24.905 11.202 24.8008 11.1996C24.5865 11.1942 24.3818 11.1094 24.2266 10.9615C24.0713 10.8137 23.9766 10.6134 23.9608 10.3996C23.8183 8.98495 23.3013 7.63382 22.4632 6.48532C21.625 5.33683 20.4959 4.43247 19.192 3.86535C17.8882 3.29823 16.4568 3.08883 15.0452 3.25872C13.6335 3.42861 12.2927 3.97165 11.1606 4.83193C10.0286 5.69221 9.14629 6.83864 8.60454 8.15321C8.06279 9.46778 7.88118 10.903 8.07839 12.3111C8.27561 13.7191 8.84453 15.0492 9.72659 16.1644C10.6086 17.2795 11.772 18.1394 13.0968 18.6556C13.3378 18.1347 13.7146 17.6883 14.1875 17.363C14.6604 17.0378 15.212 16.8457 15.7847 16.8069C16.3573 16.7681 16.9298 16.8841 17.4423 17.1426C17.9547 17.4012 18.3882 17.7928 18.6972 18.2764C19.0063 18.76 19.1796 19.3179 19.199 19.8915C19.2184 20.4651 19.0832 21.0334 18.8075 21.5368C18.5318 22.0402 18.1257 22.4602 17.6319 22.7527C17.1381 23.0453 16.5747 23.1996 16.0008 23.1996ZM8.01518 19.1996H8.16078C9.10535 20.1262 10.2066 20.8781 11.4136 21.4204C11.7683 22.5907 12.5563 23.5815 13.6167 24.1905C14.6772 24.7996 15.9301 24.9809 17.1197 24.6975C18.3092 24.4141 19.3458 23.6873 20.0177 22.6656C20.6897 21.6438 20.9463 20.4041 20.7352 19.1996H24.0008C24.8495 19.1996 25.6634 19.5368 26.2635 20.1369C26.8636 20.737 27.2008 21.5509 27.2008 22.3996C27.2008 25.1052 25.868 27.1452 23.7848 28.4748C21.7336 29.782 18.9688 30.3996 16.0008 30.3996C13.0328 30.3996 10.268 29.782 8.21678 28.4748C6.13358 27.1468 4.80078 25.1036 4.80078 22.3996C4.80078 20.6188 6.24558 19.1996 8.01518 19.1996ZM22.4008 11.1996C22.4011 12.2822 22.1268 13.3472 21.6036 14.295C21.0803 15.2428 20.3251 16.0423 19.4088 16.6188C18.9625 16.169 18.4316 15.8121 17.8467 15.5685C17.2618 15.3249 16.6344 15.1995 16.0008 15.1996C15.3672 15.1995 14.7398 15.3249 14.1549 15.5685C13.57 15.8121 13.0391 16.169 12.5928 16.6188C11.3775 15.8545 10.4544 14.7038 9.97198 13.3516C9.72587 12.6608 9.60031 11.9329 9.60078 11.1996C9.60078 9.50222 10.2751 7.87436 11.4753 6.67413C12.6755 5.47389 14.3034 4.79961 16.0008 4.79961C17.6982 4.79961 19.326 5.47389 20.5263 6.67413C21.7265 7.87436 22.4008 9.50222 22.4008 11.1996Z"
                                    fill="white"></path>
                            </svg>
                        </span>
                        <div class="contact-address-para">
                            <p class="contact-address-text">SEND US EMAIL FOR INQUIRY</p>
                            <a class="contact-address-way">{{ $systemSettings->email }}</a>
                        </div>
                    </div>
                </div>

                <div class="armie-contact-form">
                    <form id="contactForm" novalidate>
                        <label for="name">Name</label>
                        <span id="nameError" style="color:red;"></span>
                        <input type="text" id="name" name="name" placeholder="Enter your name" ...existing
                            code...>

                        <label for="email">Email</label>
                        <span id="emailError" style="color:red;"></span>
                        <input type="email" id="email" name="email" placeholder="Enter your email" ...existing
                            code...>

                        <label for="phone_number">Phone</label>
                        <span id="phoneNumberError" style="color:red;"></span>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number"
                            ...existing code...>

                        <label for="message">Subject</label>
                        <span id="messageError" style="color:red;"></span>
                        <textarea id="message" name="message" placeholder="Enter your message" ...existing code...></textarea>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>

        @include('frontend.partials.join-us')
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            // Prevent duplicate events
            event.preventDefault();
            event.stopImmediatePropagation();

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
                        if (errors.message) { // Ensure field name matches validation rules
                            document.getElementById('messageError').innerText = errors.message[0];
                        }
                        toastr.error('Please fix the errors and try again.');
                    } else {
                        toastr.error('An unexpected error occurred. Please try again later.');
                    }
                });
        });
    </script>
@endpush
