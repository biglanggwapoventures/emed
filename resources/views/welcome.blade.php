<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue-light.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"> @stack('styles')

</head>

@if(Auth::check()) 
    <body class="hold-transition skin-blue-light fixed sidebar-mini">
        <div class="wrapper">
            @include('partials.common-navbar') 
@else

    <body>
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
    @endif @yield('body')
        <object id="webcard" type="application/x-webcard" width="0" height="0">
            <param name="onload" value="pluginLoaded" />
        </object>
        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <!-- <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script> -->
        <script src="{{ asset('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/js/app.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/js/demo.js') }}"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").DataTable();
                $("#example2").DataTable();
                $("#example3").DataTable();
                $("#example4").DataTable();
                // $('#example1').DataTable({
                //   "paging": true,
                //   "lengthChange": false,
                //   "searching": true,
                //   "ordering": true,
                //   "info": true,
                //   "autoWidth": false
            });
            $(document).ready(pluginLoaded)
            function pluginLoaded() {
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
                // console.log(window.location)
                var url = window.location.href.replace('http://', '').split('/');
                // console.log(url);
                if (url[1] === 'patients' && url[2] === 'create') {
                    $('#rfid-uid').val(uid)
                } else {
                    scan(uid);
                }
                reader.disconnect();
            }
            function cardRemoved(reader) {
            }
            function scan(uid) {
                $.post('{{ url("/scan") }}', {
                    uid: uid,
                    _token: '{{ csrf_token() }}'
                }).done(function(res) {
                    if (res.result) {
                        window.location.href = res.url;
                    }
                })
            }
        </script>
        @stack('scripts')

    </body>

</html>