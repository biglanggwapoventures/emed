<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
</head>
<body>
    @if(Auth::check())
        @if(Auth::user()->user_type === 'ADMIN')
            @include('partials.admin-navbar')  

        @elseif(Auth::user()->user_type === 'DOCTOR')   
            @include('partials.doctor-navbar')

        @elseif(Auth::user()->user_type === 'PATIENT')   
            @include('partials.patient-navbar')        

        @endif
    @else
        @include('partials.navbar')     
    @endif

     @yield('body')

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    @stack('scripts')
    
</body>
</html>