<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title1 ?? '' }} | Laravel Role</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}" type="text/css"> --}}
    {{-- <script src="{{ asset('libraries/fontawesome/js/all.js') }}" defer></script> --}}
    <script type="text/javascript">
        (
            function() { 
                var css = document.createElement('link'); 
                css.href = 'https://use.fontawesome.com/releases/v6.2.0/css/all.css'; 
                // css.href = '{{ asset('libraries/fontawesome/css/all.css') }}'; 
                css.rel = 'stylesheet'; css.type = 'text/css'; 
                document.getElementsByTagName('head')[0].appendChild(css); 
            }
        )(); 
    </script>
    {{-- <style>
        html {
            background: url("{{ asset('images/bg1.jpg') }}") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style> --}}
    @stack('css')
</head>

<body class="sb-nav-fixed {{ $sidebar_toggle ?? '' }}">
    @include('layouts.header')
    <div id="layoutSidenav">
        @yield('sidebar')
        <div id="layoutSidenav_content">
            @yield('content')
            @include('layouts.footer')
        </div>
    </div>

    @yield('libraries')
    @stack('js')

</body>

</html>