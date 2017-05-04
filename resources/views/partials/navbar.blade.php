
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
<nav class="navbar navbar-default" style="background-color: #3c8dbc;">
    <div onclick="location.href='/'" class="logo"> </div>
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
            <a class="navbar-brand" style ="color: white;" href="{{ url('/') }}">eMED</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">
                <li><a href="/" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">HOME</a></li>
                <li><a href="/aboutus" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">ABOUT US</a></li>
                <li><a href="/faq" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">FAQ</a></li>
                <li><a href="/contactus" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">CONTACT US</a></li>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
