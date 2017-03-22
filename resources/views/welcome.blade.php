<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>
    <link href=' https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'  type='text/css'>
   
</head>
<body>
    @if(Auth::check())
        @if(Auth::user()->user_type === 'ADMIN')
            @include('partials.admin-navbar')  
           
        @elseif(Auth::user()->user_type === 'DOCTOR')   
            @include('partials.doctor-navbar')

        @elseif(Auth::user()->user_type === 'PATIENT')   
            @include('partials.patient-navbar')   

        @elseif(Auth::user()->user_type === 'PMANAGER')   
            @include('partials.manager-navbar') 

         @elseif(Auth::user()->user_type === 'SECRETARY')   
            @include('partials.secretary-navbar')   

         @elseif(Auth::user()->user_type === 'PHARMA')   
            @include('partials.pharma-navbar')   

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
                    <p>forgot your password? <a href="#">Click here</a></p>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>
    </div>
    
        @include('partials.navbar')     
    @endif

     


    @yield('body')
    <object id="webcard" type="application/x-webcard" width="0" height="0">
        <param name="onload" value="pluginLoaded" />
    </object>
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(pluginLoaded)
        function pluginLoaded() {
            console.log("asdasd")
            window.webcard = document.getElementById("webcard");
            if (webcard.attachEvent) {
                webcard.attachEvent("oncardpresent", cardPresent);
                webcard.attachEvent("oncardremoved", cardRemoved);
            } else { 
                webcard.addEventListener("cardpresent", cardPresent, false);
                webcard.addEventListener("cardremoved", cardRemoved, false);
            }
        }

        function cardPresent(reader) {
            reader.connect(2); // 1-Exclusive, 2-Shared
            var apdu = "FFCA000000";
            var uid = reader.transcieve(apdu);
            console.log(uid);
            scan(uid);
            reader.disconnect();
        }

        function cardRemoved(reader) {

        }

        function scan(uid){
            $.post('{{ url("/scan") }}', {
                uid: uid,
                _token: '{{ csrf_token() }}'
            }).done(function(res){
                if(res.result){
                    window.location.href = res.url;
                }
            })
        }
    </script>
    @stack('scripts')
    
</body>
</html>