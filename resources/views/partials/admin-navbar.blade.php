<header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
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
      <!-- <div class="user-panel ">
        <div class="pull-left image ">
          <img src="/dist/img/user2-160x160.jpg " class="img-circle " alt="User Image ">
        </div>
        <div class="pull-left info ">
          
        </div>
      </div> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu ">
        <li class="header ">MENU</li>
        <li><a href="/admin "><i class="fa fa-users "></i> <span>All Users</span></a></li>
         <li><a href="{{ route( 'userroles.index')}} "><i class="fa fa-user "></i> <span>Add Roles</span></a></li>
        <li><a href="{{ route( 'specialization.index')}} "><i class="fa fa-stethoscope "></i> <span>Manage Specialization</span></a></li>
         <li><a href="{{ route( 'affiliations.index')}} "><i class="fa fa-hospital-o "></i> <span>Manage Affiliations</span></a></li>
         <li><a href="{{ route( 'organizations.index')}} "><i class="fa fa-sitemap "></i> <span>Manage Organizations</span></a></li>
         <li><a href="{{ route( 'pharmacy.index')}} "><i class="fa fa-heart "></i> <span>Manage Drugstore</span></a></li>
        <!-- <li><a href="documentation/index.html "><i class="fa fa-user-plus "></i> <span>Add Roles</span></a></li> -->
        <li class="treeview ">
          <a href="# ">
            <i class="fa fa-plus-circle "></i> <span>Add Users</span>
            <span class="pull-right-container ">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li><a href="{{ route( 'doctors.create') }} "><i class="fa fa-circle-o "></i> Add Doctor</a></li>
            <li><a href="{{ route( 'managers.create') }} "><i class="fa fa-circle-o "></i> Add Pharmacy Manager</a></li>
          </ul>
          <li class="list-group-item"></li>
        <li><a href="/logout "><i class="fa fa-sign-out"></i><span>Sign out</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
