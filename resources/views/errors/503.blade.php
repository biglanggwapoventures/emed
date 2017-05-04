<!DOCTYPE html>
<html>

    <head>
        <title>Restricted access.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html,
            body {
                height: 100%;
            }
            
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }
            
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
            
            .content {
                text-align: center;
                display: inline-block;
            }
            
            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }

        </style>
    </head>

    <body>
        <div class="container">
            <div class="content">
                <div class="title" id="homepage" data-url="{{ url(session('homepage') . '') }}">
                    <span style="font-weight:bold;font-size:50% !important">
                        @if(Session::has('503_msg'))
                            {{ session('503_msg') }}
                        @else
                            Either you don't have access rights to this page/action;<br/> or it does not exist in the system.
                        @endif
                    </span>
                </div>
                <!-- <span style="font-size:150% !important">You will be redirected after five (5) seconds.</span> -->
            </div>
        </div>
    </body>
    <script src="{{ asset('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () 
        {   
            window.setTimeout(function () 
            {
                var home = $("#homepage").data('url');
                console.log(home);
                window.location.href = home;
                
            }, 2500);
        });
    </script>

</html>
