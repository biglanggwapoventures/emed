<nav class="navbar navbar-default">
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
      <a class="navbar-brand" href="{{ url('/') }}">eMED</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav-user">
        <li class="dropdown">
          <a href="{{ url('/pmanager-home') }}">{{ Auth::user()->username }}<span class="glyphicon glyphicon-user pull-right"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
            <li class="divider"></li>
            <li><a href="#">Profile<span class="glyphicon glyphicon-stats pull-right"></span></a></li>
            <li class="divider"></li>
            <li><a href="{{ route('pharmacists.create') }}">Add Pharmacists<span class="badge pull-right"> 42 </span></a></li>
            <li class="divider"></li>
            <li><a href="#">Transactions<span class="glyphicon glyphicon-heart pull-right"></span></a></li>
            <li class="divider"></li>
            <li><a href="{{ url('/logout') }}">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
          </ul>
        </li>
      </ul>

     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 