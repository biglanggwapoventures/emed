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
<table>
    <thead>
        <th>Download This</th>
        <th>Para sa rfid</th>
    </thead>
    <td><a href="/downloadjar" class="btn btn-large pull-right"><i class="icon-download-alt"> </i> Download jar file </a></td>
    <td>Para sa tanan os windows or mac</td>
</table>
 
</body>

</html>
