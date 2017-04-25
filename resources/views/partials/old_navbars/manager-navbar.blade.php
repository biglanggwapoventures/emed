<header class="main-header">
    <!-- Logo -->
    <a href="/pmanager-home" class="logo">
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
      <div class="user-panel ">
        <!-- <div class="pull-left image ">
          <img src="{{ " storage/avatars/{Auth::user()->avatar}" }} " class="img-circle " alt="User Image ">
        </div> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu ">
        <li class="header ">MENU</li>
        <li><a href="/pmanager-home"><i class="fa fa-user "></i> <span>{{ Auth::user()->fullname() }}</span></a></li>
        <li><a href="{{ route( 'pharmacists.index') }} "><i class="fa fa-users "></i> <span>Pharmacists</span></a></li>
        <li><a href="# "><i class="fa fa-pencil "></i> <span>Transaction History</span></a></li>
        <li><a href="/ChangePass "><i class="fa fa-unlock-alt "></i> <span>Change Password</span></a></li>
        <!-- <li><a href="/admin "><i class="fa fa-circle-o "></i> <span>Add Specialization</span></a></li> -->
        <!-- <li><a href="documentation/index.html "><i class="fa fa-user-plus "></i> <span>Add Roles</span></a></li> -->
        <li class="treeview ">
          <a href="# ">
            <i class="fa fa-dashboard "></i> <span>Add Users</span>
            <span class="pull-right-container ">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li><a href="{{ route( 'pharmacists.create') }} "><i class="fa fa-circle-o "></i> Add Pharmacist</a></li>
          </ul>
        <li style="margin-top: 100%;"><a href="{{ url('logout') }}" class="btn btn-default btn-flat "><i class="fa fa-sign-out"></i><span>Sign out</span></a>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>