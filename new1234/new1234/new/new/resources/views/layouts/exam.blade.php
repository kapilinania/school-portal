<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'exam') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/plugins/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/exam.css') }}">
   
    
</head>
<body>
    <div id="app">
        
        
        <main>
            @yield('content')
        </main>
       
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap Bundle -->
    {{-- <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/plugins/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/indexjs/main.js') }}"></script>





</body>
</html>
