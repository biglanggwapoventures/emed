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

        <div class="navbar-custom-menu" style="background-color: transparent;">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu" style="background-color: transparent;" ">
            <a href="# " class="dropdown-toggle " data-toggle="dropdown ">
              <!-- <img src="{{ "/storage/avatars/{Auth::user()->avatar}" }} " class="user-image " alt="User Image "> -->
              <span class="hidden-xs ">{{ Auth::user()->fullname() }}</span>
            </a>
            <ul class="dropdown-menu ">
              <!-- User image -->
              <!-- <li class="user-header ">
                <img src="{{ " storage/avatars/{Auth::user()->avatar}" }} " class="img-circle " alt="User Image ">

                <p>
                  {{ Auth::user()->fullname() }}
                </p>
              </li> -->
              
              <!-- Menu Footer-->
              <li class="user-footer ">
                <div class="pull-right ">
                  <a href="/logout " class="btn btn-default btn-flat ">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
          </li>
        </ul>
      </div>
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
        <div class="pull-left ">
          <a href="/patient-home " class="fa fa-user-md ">
            <!-- <span class="logo-mini "><b>E</b>MS</span> -->
            <span><b></b>{{ Auth::user()->fullname() }}</span>
          </a>
          <!-- <p><br><h4><a href="/doctor-home ">Dr. {{ Auth::user()->fullname() }}</a></h4></p> -->
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu ">
        <li class="header ">MENU</li>
                <li><a href="{{ url('/ChangePass') }}"><i class="fa fa-unlock-alt"></i> <span>Change Password</span></a></li>
                <li><a href="/logout"><i class="fa fa-circle-o"></i> <span>Log-out</span></a></li>
                <!-- <li><a href="/admin"><i class="fa fa-circle-o"></i> <span>Add Specialization</span></a></li> -->
                <!-- <li><a href="documentation/index.html"><i class="fa fa-user-plus"></i> <span>Add Roles</span></a></li> -->


            </ul>
            </section>
            <!-- /.sidebar -->
            </aside>
