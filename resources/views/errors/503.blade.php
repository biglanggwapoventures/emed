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
            <div class="title">
                <span style="font-size:50% !important">
                    Either you don't have access rights to this page/action or it does not exist in the system.
                </span><
            </div>
            <!-- <span style="font-size:150% !important">You will be redirected after five (5) seconds.</span> -->
        </div>
    </div>
</body>
@push('scripts')
    <<!-- script type="text/javascript">
        $(document).ready(function () 
        {
            window.setTimeout(function () 
            {
                window.history.back();
                
            }, 5000);
        });
    </script> -->
@endpush

</html>
