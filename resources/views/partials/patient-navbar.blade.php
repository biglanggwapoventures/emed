<header class="main-header">
    <!-- Logo -->
    <a href="/patient-home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>E</b>MS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>eMed</b>Services</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
    </nav>
  </header>
   <aside class="main-sidebar ">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar ">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu ">
        <li class="header ">MENU</li>
                <li><a href="{{ url('/patient-home') }}"><i class="fa fa-user"></i> <span>{{ Auth::user()->fullname() }}</span></a></li>
                <li><a href="{{ url('/ChangePass') }}"><i class="fa fa-unlock-alt"></i> <span>Change Password</span></a></li>
                <li class="list-group-item"></li>
                <li><a href="/logout "><i class="fa fa-sign-out"></i><span>Sign out</span></a></li>
                <!-- <li><a href="/admin"><i class="fa fa-circle-o"></i> <span>Add Specialization</span></a></li> -->
                <!-- <li><a href="documentation/index.html"><i class="fa fa-user-plus"></i> <span>Add Roles</span></a></li> -->


            </ul>
            </section>
            <!-- /.sidebar -->
            </aside>
