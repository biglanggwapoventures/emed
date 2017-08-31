<!DOCTYPE html>
<html>

<head>
    <title>eMed</title>
    <link rel="icon" href="https://1001freedownloads.s3.amazonaws.com/icon/thumb/340535/Health-Sign-blue-icon.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> -->
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
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bsdatepicker/css/bootstrap-datepicker3.standalone.min.css') }}">

     @stack('styles')

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
                                <!-- <div class="form-group login-group-checkbox">
                                    <input type="checkbox" id="lg_remember" name="lg_remember">
                                    <label for="lg_remember">remember</label>
                                </div> -->
                            </div>
                            <button type="submit" class="login-button"><i class="glyphicon glyphicon-chevron-right"></i></button>
                        </div>
                        <div class="etc-login-form">
                            {{ csrf_field() }}

                            <p>forgot your password? <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">Click here</a></p>


                                <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="basic" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content" style="padding:20px 35px 20px 40px; background-color: #ddd;">
                                            <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                                                <h3 class="page-title text-info sbold" style="margin-left:-7px; text-align: left;">
                                                    FORGOT PASSWORD<br>
                                                    <small class="sbold" style="margin-left:3px;">E-MAIL ADDRESS</small>
                                                </h3>
                                                <div class="row">

                                                <div id="resetError" style="display:none" class="alert alert-danger alert-dismissible" role="alert" style="font-size:90%;">
                                                    <a class="close" onclick="$('.alert').hide()">&times;</a>
                                                    <i class="fa fa-info-circle pull-left"></i>
                                                    <p>&nbsp; <span id="errData"></span>.</p>
                                                </div>

                                                <div id="resetInfo" style="display:none" class="alert alert-info alert-dismissible" role="alert" style="font-size:90%;">
                                                    <a class="close" onclick="$('.alert').hide()">&times;</a>
                                                    <i class="fa fa-info-circle pull-left"></i>
                                                    <p>&nbsp; <span id="infoData"></span>.</p>
                                                </div>

                                                <div class="form-body">
                                                        {{Form::email('email',null,['class' => 'form-control', 'id' => 'emailId'])}}
                                                </div>
                                                </div>                                                

                                                <div class="row" style="margin-top:10px;">
                                                    <div class="col-md-12">
                                                        <button style="width:140px;margin-left:5px;" type="button" class="btn btn-primary grey pull-right" data-dismiss="modal">
                                                            Close 
                                                        </button>
                                                        <a id="resetPassword" data-loading-text="Sending email... &nbsp;<i class='fa fa-spinner fa-spin'></i>" class="btn btn-info grey pull-right" style="width: 140px;margin-left: 5px; color: white;">
                                                        Submit 
                                                        </a>
                                                    </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script type="text/javascript" src="{{ asset('plugins/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
     <!--    <script type="text/javascript" src="{{ asset('dist/js/demo.js') }}"></script>
          <script type="text/javascript" src="{{ asset('js/photo.js') }}"></script>
 -->

        <script type="text/javascript">
            $(function() {
                $(".bsdatepicker").datepicker({
                    format:'yyyy-mm-dd'
                });
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

            $("#resetPassword").click(function() 
            {
                if($("#emailId").val().trim() == "")
                    return;

                var $btn = $(this).button('loading');
                var email = {'address':$("#emailId").val()};

                email = JSON.stringify(email);
                sendPasswordResetEmail(email, $btn);
            });

            function sendPasswordResetEmail(email, $btn) 
            {
                var postRequest = $.post('forgotpassword', {'email':email, '_token':$("input[name=_token]").val()});
                postRequest.done(function(data) 
                {
                    data = jQuery.parseJSON(data);
                    console.log(data);
                    if(data.success) 
                    {
                        console.log('success');
                        $("#infoData").text(data.message);
                        $("#resetInfo").show();

                        // $("#emailId").val("");
                        
                        $btn.button('reset');
                    }
                    else 
                    {
                        console.log('fail');
                        $("#errData").text(data.message);
                        $("#resetError").show();
                        
                        // $("#emailId").val("");

                        $btn.button('reset');
                    }
                });

                // postRequest.fail(function(xhr, textStatus, error) {
                //     if(xhr.status == "500") {
                //         $("#ID_ajaxerr500").show();
                //         // $("#ID_successrequest").show();
                //         $("#forgotPasswordModal").modal("hide");
                //         $btn.button('reset');
                //     }
                // });
            }
        </script>
        @stack('scripts')

    </body>
    <style type="text/css">
@media only screen and (max-width: 375px) {
    .loginpage {
    padding: 12px 0px;
    height: 48%;
    width: 79%;
    position: absolute;
    background-color: whitesmoke;
    margin-top: 163px;
    margin-left: 7%;
    border-radius: 20px;
    /* opacity: 0.8; */
    }
}
    @media only screen and (max-width: 414px) {
    .loginpage {
    padding: 12px 0px;
    height: 48%;
    width: 79%;
    position: absolute;
    background-color: whitesmoke;
    margin-top: 163px;
    margin-left: 7%;
    border-radius: 20px;
    /* opacity: 0.8; */
    }
}
 @media only screen and (width: 768px) {
.loginpage {
    padding: 12px 0px;
    height: 31%;
    width: 40%;
    position: absolute;
    background-color: whitesmoke;
    margin-top: 253px;
    margin-left: 29%;
    border-radius: 20px;
    /* opacity: 0.8; */
}
}
</style>
</html>