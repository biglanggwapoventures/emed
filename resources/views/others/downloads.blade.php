<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    @include('partials.navbar')
<br><br><br><br><br><br>
    <div class="row" style="margin-left: 400px">
         <div class="col-xs-6">
                <div class="box-body table-responsive no-padding">
                        <table id="example1" class="table table-bordered table-striped">

                                <thead>
                                    <th>Download</th>
                                    <th>Specifications</th>
                                    <th></th>
                                </thead>
                                <tr>
                                  <td>JAR File</td> 
                                  <td></td>
                                  <td></td> 
                                </tr>
                                <tr>
                                <td ><a href="/downloadjar" class="btn btn-large pull-left"><i class="fa fa-download" aria-hidden="true"></i> &nbsp Download jar file  (4.55 MB ) </a></td>
                                <td>Windows or Mac</td>
                                <td>Run file to use rfid</td>
                                </tr>
                                <tr>
                                    <td colspan="3"> JRE Downloads:</td>
                                </tr>
                                <tr>
                                <td colspan="3"><a href="http://www.oracle.com/technetwork/java/javase/downloads/jre8-downloads-2133155.html">download here</a></td>
                               </tr>
                               

                        </table>
                </div>
        </div>
    </div>
</body>

</html>
