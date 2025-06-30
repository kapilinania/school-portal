<!-- resources/views/layouts/master.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/simple-calendar/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>



    <div class="main-wrapper">
        @include('partials.header')
        <div class="sidebar" id="sidebar">
            @include('partials.teachersidebar') 
        </div>

        <div class="page-wrapper">
            @yield('content') <!-- Page content goes here -->
        </div>


    </div>

    @include('partials.footer')

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap Bundle -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Feather Icons -->
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- ApexCharts -->
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>
    <!-- Simple Calendar -->
    <script src="{{ asset('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ asset('assets/js/calander.js') }}"></script>
    <!-- Circle Progress -->
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
    <!-- Custom Script -->
    <script src="{{ asset('assets/js/script.js') }}"></script>


</body>

</html>
