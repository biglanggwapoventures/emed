<header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <b>E</b>MS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <b>eMed</b>Services</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"/>
            <span class="icon-bar"/>
            <span class="icon-bar"/>
        </a>
    </nav>
</header>
<aside class="main-sidebar ">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar ">
        <!-- Sidebar user panel -->
        <!-- <div class="user-panel "><div class="pull-left image "><img src="/dist/img/user2-160x160.jpg " class="img-circle " alt="User Image "></div><div class="pull-left info "></div></div> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu ">
            <li class="header ">MENU</li>

            @if(Session::get('user_type') === 'DOCTOR')
                <li>
                    <a href="{{ url('doctor-home') }} ">
                        <i class="fa fa-user-md "></i>
                        <span>{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
            @elseif(Session::get('user_type') === 'PMANAGER')
                <li>
                    <a href="{{ url('pmanager-home') }} ">
                        <i class="fa fa-user-md "></i>
                        <span>{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
            @elseif(Session::get('user_type') === 'PATIENT')
                <li>
                    <a href="{{ url('patient-home') }} ">
                        <i class="fa fa-user-md "></i>
                        <span>{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
            @elseif(Session::get('user_type') === 'SECRETARY')
                <li>
                    <a href="{{ url('secretary-home') }} ">
                        <i class="fa fa-user-md "></i>
                        <span>{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
            @elseif(Session::get('user_type') === 'PHARMA')
                <li>
                    <a href="{{ url('pharmacists-home') }} ">
                        <i class="fa fa-user-md "></i>
                        <span>{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ url('home', session('user_type_id')) }} ">
                        <i class="fa fa-user-md "></i>
                        <span>{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('admin.index'))
                <li>
                    <a href="{{ route('admin.index') }}">
                        <i class="fa fa-users "/></i>
                        <span>All Users</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('userroles.index'))
                <li>
                    <a href="{{ route('userroles.index') }}">
                        <i class="fa fa-circle-o "/></i>
                        <span>Manage User Roles</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('specialization.index'))
                <li>
                    <a href="{{ route('specialization.index')}} ">
                        <i class="fa fa-circle-o "/></i>
                        <span>Manage Specialization</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('affiliations.index'))
                <li>
                    <a href="{{ route('affiliations.index')}} ">
                        <i class="fa fa-circle-o "/></i>
                        <span>Manage Affiliations</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('organizations.index'))
                <li>
                    <a href="{{ route('organizations.index')}} ">
                        <i class="fa fa-circle-o "/></i>
                        <span>Manage Organizations</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('pharmacy.index'))
                <li>
                    <a href="{{ route('pharmacy.index')}} ">
                        <i class="fa fa-circle-o "/></i>
                        <span>Manage Drugstore</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('pharmacists.index'))
                <li>
                    <a href="{{ route( 'pharmacists.index') }} ">
                        <i class="fa fa-users "></i> 
                        <span>Pharmacists</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('patients.index'))
                <li>
                    <a href="{{ route( 'patients.index') }} ">
                        <i class="fa fa-users "></i> 
                        <span>Patients</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::hasUrlPermission('secretary.index'))
                <li>
                    <a href="{{ route( 'secretary.index') }} ">
                        <i class="fa fa-pencil "></i> 
                        <span>Secretary</span>
                    </a>
                </li>
            @endif



            @if(EMedHelper::hasAddUserPermission() || EMedHelper::hasAddCustomUserPermission())
                <li class="treeview ">
                    <a href="# ">
                        <i class="fa fa-dashboard "/></i>
                        <span>Add Users</span>
                        <span class="pull-right-container ">
                            <i class="fa fa-angle-left pull-right "/></i>
                        </span>
                    </a>

                    <ul class="treeview-menu ">
                        @foreach(EMedHelper::getAddUserPermissions() as $data)
                            @if(EMedHelper::hasUrlPermission($data->route))
                                <li>
                                    <a href="{{ route($data->route) }}">
                                        <i class="fa fa-circle-o "></i> 
                                        {{ $data->display_name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        @foreach(EMedHelper::getAddCustomUserPermissions() as $customdata)
                            @if(EMedHelper::hasPermissionId($customdata->id, session('user_type_id')))
                                <li>
                                    <a href="{{ url('custom-role/create', EMedHelper::retrieveRoleIdByName($customdata->name)) }}">
                                    <!-- <a href="{{-- url('custom-role/create', $customdata->id) --}}"> -->
                                        <i class="fa fa-circle-o "></i> 
                                        {{ $customdata->display_name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif


            <li>
                <a href="{{ url('ChangePass') }}">
                    <i class="fa fa-unlock-alt "></i> 
                    <span>Change Password</span>
                </a>
            </li>
            <li>
                <a href="{{ url('logout') }}" class="btn btn-default btn-flat ">
                    <i class="fa fa-sign-out"></i>
                    <span>Sign out</span>
                </a>
            </li>
        </ul>
        </section>
        <!-- /.sidebar -->
    </aside>