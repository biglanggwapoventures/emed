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
            @include('admin.adminhome')
        @elseif(Auth::user()->user_type === 'DOCTOR')   
            @include('partials.doctor-navbar')

        @elseif(Auth::user()->user_type === 'PATIENT')   
            @include('partials.patient-navbar')   

        @elseif(Auth::user()->user_type === 'PMANAGER')   
            @include('partials.manager-navbar')        

        @endif
    @else
    <div class="container-fluid">

     <div class="text-center loginpage">
        <div class="login-logo">login</div>
        <!-- Main Form -->
        <div class="login-form-1">
           <form action="{{ url('/login') }}" method="POST">
                            {{ csrf_field() }}
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                <label class="control-label">Username</label>
                                <input type="text" name="username" class="form-control">
                                @if($errors->has('username'))
                                    <span class="help-block">{{ $errors->first('username') }}</span>
                                @endif
                            </div>
                        <div class="form-group {{ $errors->has('password') || isset($wrongPassword) ? 'has-error' : '' }}">
                                <label class="control-label">Password</label>
                                <input type="password" name="password" class="form-control">
                                @if($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                                @if(isset($wrongPassword))
                                    <span class="help-block">{{ $wrongPassword }}</span>
                                @endif
                            </div>
                        <div class="form-group login-group-checkbox">
                            <input type="checkbox" id="lg_remember" name="lg_remember">
                            <label for="lg_remember">remember</label>
                        </div>
                    </div>
                    <button type="submit" class="login-button"><i class="glyphicon glyphicon-chevron-right"></i></button>
                </div>
                <div class="etc-login-form">
                    <p>forgot your password? <a href="#">click here</a></p>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>
    </div>
    
        @include('partials.navbar')     
    @endif

     


    @yield('body')

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    @stack('scripts')
    
</body>
</html>