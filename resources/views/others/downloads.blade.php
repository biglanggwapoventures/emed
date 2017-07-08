<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    @include('partials.navbar')
<br><br><br><br><br><br>
    <div class="row" style="margin-right: 50px; margin-left: 50px">
         <div class="col-xs-12">
                <div class="box-body table-responsive no-padding">
                        <table id="example1" class="table table-bordered table-striped">

                                <thead>
                                    <th>Download This</th>
                                    <th>Para sa rfid</th>
                                </thead>
                                <td ><a href="/downloadjar" class="btn btn-large pull-left"><i class="icon-download-alt"> </i> Download jar file </a></td>
                                <td>Para sa tanan os windows or mac</td>
                        </table>
                </div>
        </div>
    </div>
</body>

</html>
