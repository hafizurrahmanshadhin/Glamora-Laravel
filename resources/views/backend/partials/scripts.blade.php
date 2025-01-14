{{-- axios --}}
<script src="{{ asset('backend/custom_downloaded_file/axios.min.js') }}"></script>

{{-- JQUERY JS --}}
<script src="{{ asset('backend/custom_downloaded_file/jquery.min.js') }}"></script>

{{-- JAVASCRIPT --}}
<script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins.js') }}"></script>

<script src="{{ asset('backend/libs/list.js/list.min.js') }}"></script>

{{-- Swiper slider js --}}
<script src="{{ asset('backend/libs/swiper/swiper-bundle.min.js') }}"></script>

{{-- apexcharts --}}
<script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>

{{-- dashboard doctor init js --}}
<script src="{{ asset('backend/js/pages/dashboard-doctor.init.js') }}"></script>

{{-- password-create init --}}
<script src="{{ asset('backend/js/pages/passowrd-create.init.js') }}"></script>

{{-- profile-setting init js --}}
<script src="{{ asset('backend/js/pages/profile-setting.init.js') }}"></script>

{{-- prismjs plugin --}}
<script src="{{ asset('backend/libs/prismjs/prism.js') }}"></script>

{{-- dropify js --}}
<script src="{{ asset('backend/js/dropify.min.js') }}"></script>

<script src="{{ asset('backend/libs/list.pagination.js/list.pagination.min.js') }}"></script>

{{-- listjs init --}}
<script src="{{ asset('backend/js/pages/listjs.init.js') }}"></script>

{{-- Sweet Alerts js --}}
<script src="{{ asset('backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>

{{-- DataTables JS --}}
<script src="{{ asset('backend/custom_downloaded_file/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/custom_downloaded_file/dataTables.bootstrap5.min.js') }}"></script>

{{-- Summernote Editor js --}}
<script src="{{ asset('backend/plugins/summernote-editor/summernote1.js') }}"></script>
<script src="{{ asset('backend/js/summernote.js') }}"></script>

{{-- Summernote start --}}
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2,
            height: 220,
        });
    });
</script>
{{-- Summernote end --}}

{{-- ckeditor.js --}}
<script src="{{ asset('backend/custom_downloaded_file/ckeditor.js') }}"></script>

{{-- dropify start --}}
<script>
    $(document).ready(function() {
        $('.dropify').dropify();

        $('#logo').on('dropify.afterClear', function(event, element) {
            $('input[name="remove_logo"]').val('1');
        });

        $('#favicon').on('dropify.afterClear', function(event, element) {
            $('input[name="remove_favicon"]').val('1');
        });
    });
</script>
{{-- dropify end --}}

{{-- toaster js --}}
<script src="{{ asset('backend/js/toastr.min.js') }}"></script>

{{-- toastr start --}}
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        toastr.options.positionClass = 'toast-top-right';

        @if (Session::has('t-success'))
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': true,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            toastr.success("{{ session('t-success') }}");
        @endif

        @if (Session::has('t-error'))
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': true,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            toastr.error("{{ session('t-error') }}");
        @endif

        @if (Session::has('t-info'))
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': true,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            toastr.info("{{ session('t-info') }}");
        @endif

        @if (Session::has('t-warning'))
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': true,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            toastr.warning("{{ session('t-warning') }}");
        @endif
    });
</script>
{{-- toastr end --}}

{{-- App js --}}
<script src="{{ asset('backend/js/app.js') }}"></script>
@stack('scripts')
