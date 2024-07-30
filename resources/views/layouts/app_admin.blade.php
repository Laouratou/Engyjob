<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ENGYJOB</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables/datatables.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body class="dashboard-page">
    <div class="main-wrapper">
        @include('components.header_admin')
        @include('components.sidebar_admin')
        @yield('content')
    </div>


    @include('freelancers.modals.category')
    @include('freelancers.modals.skill')
    @include('freelancers.modals.base')
    @include('admin.modals.id_verification')
    @include('modals.logout')



    <!-- jQuery -->
    <script src="{{ asset('admin-assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('admin-assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('admin-assets/js/feather.min.js') }}"></script>
    <!-- Slimscroll JS -->
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Datatables JS -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="{{ asset('admin-assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/logout.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- Custom JS -->
    <script src="{{ asset('admin-assets/js/script.js') }}"></script>

    {{-- <script>
        $(document).ready(function() {

            $('.toggleActive').on('click', function() {
                alert('ok');

                var id = $(this).data('id');
                var model = $(this).data('model');

                $.ajax({
                    type: "POST",
                    data: {
                        id: id,
                        model: model
                    },
                    url: "{{ route('toggleActive') }}",
                    success: function(data) {
                        console.log(data);
                        //reload page
                        window.location.reload();

                    },
                    error: function(data) {
                        console.log(data);
                        //reload page
                        window.location.reload();
                    }
                })

            })

        })
    </script> --}}

    @yield('js')
</body>

</html>
