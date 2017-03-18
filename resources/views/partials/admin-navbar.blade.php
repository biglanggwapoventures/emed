<nav class="navbar navbar-default">
<div onclick="location.href='/admin'" class="logo"> </div>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/admin') }}">eMED</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      

<!-- 
      <ul class="nav navbar-nav">
        <li><a href="{{ route('doctors.index') }}">Doctors</a></li>
        <li><a href="{{ route('managers.index') }}">Pharmacy Managers</a></li>
      </ul> -->
      

     
            <li><a href="{{ url('/logout') }}">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 