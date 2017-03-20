<nav class="navbar navbar-default">
<div onclick="location.href='/patient-home'" class="logo"> </div>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">eMED</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <!-- <li><a href="{{ route('managers.index') }}">Pharmacy Managers</a></li> -->
      </ul>
      <ul class="nav navbar-nav-user">
        <li class="dropdown" style="width: 100%;">
          <a href="{{ url('/patient-home') }}"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/ChangePass') }}">Change Pass<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
             <li class="divider"></li>
            <li><a href="{{ url('patient-home') }}">Profile <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
            <li class="divider"></li>
            <li><a href="{{ url('/logout') }}">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
          </ul>
        </li>
      </ul>

     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 