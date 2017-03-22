<nav class="navbar navbar-default">
    <div onclick="location.href='/pmanager-home'" class="logo"> </div>
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
            <a class="navbar-brand" href="{{ url('/pmanager-home') }}">eMED</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav-user">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary"><a href="/pmanager-home" style="color: white; text-decoration: none;"> {{ Auth::user()->fullname() }}</a></button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/pharmacists')}}">View Pharmacists<span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">Transactions<span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    </ul>
                </div>
            </ul>


        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
