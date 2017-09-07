<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
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
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="width: 1px; height: 1px; margin-right: 12px;">
        <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

      </button>
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"/>
            <span class="icon-bar pull-right"/>
            <span class="icon-bar pull-right"/>
        </a>
        
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">
                <li><a href="/" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">HOME</a></li>
                <li><a href="{{ url('aboutus') }}" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">ABOUT US</a></li>
                <li><a href="{{ url('faq') }}" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">FAQ</a></li>
                <li><a href="{{ url('contactus') }}" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">CONTACT US</a></li>
                <li><a href="{{ url('downloads') }}" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">DOWNLOADS</a></li>
                @if(Auth::check()) 
                <li><a href="{{ url('logout') }}" class="btn btn-home btn-2" style="margin-bottom: -20px; color: white;">LOGOUT</a></li>
                @endif
            </ul>
            </div>
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
                        <i class="fa fa-user-circle sidebar-icon"></i>
                        <span class="sidebar-label">{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
                <hr style="margin-top:7px;margin-bottom:7px;">
            @elseif(Session::get('user_type') === 'PMANAGER')
                <li>
                    <a href="{{ url('pmanager-home') }} ">
                        <i class="fa fa-user-circle sidebar-icon"></i>
                        <span class="sidebar-label">{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
                <hr style="margin-top:7px;margin-bottom:7px;">
            @elseif(Session::get('user_type') === 'PATIENT')
                <li>
                    <a href="{{ url('patient-home') }} ">
                        <i class="fa fa-user-circle sidebar-icon"></i>
                        <span class="sidebar-label">{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
                <hr style="margin-top:7px;margin-bottom:7px;">
            @elseif(Session::get('user_type') === 'SECRETARY')
                <li>
                    <a href="{{ url('secretary-home') }} ">
                        <i class="fa fa-user-circle sidebar-icon"></i>
                        <span class="sidebar-label">{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
                <hr style="margin-top:7px;margin-bottom:7px;">
            @elseif(Session::get('user_type') === 'PHARMA')
                <li>
                    <a href="{{ url('pharmacists-home') }} ">
                        <i class="fa fa-user-circle sidebar-icon"></i>
                        <span class="sidebar-label">{{ Auth::user()->fullname() }}</span>
                    </a>
                </li>
                <hr style="margin-top:7px;margin-bottom:7px;">
            @else
                @if(Session::get('user_type') !== 'ADMIN')
                    <li>
                        <a href="{{ url('home', session('user_type_id')) }} ">
                            <i class="fa fa-user-circle sidebar-icon"></i>
                            <span class="sidebar-label">{{ Auth::user()->fullname() }}</span>
                        </a>
                    </li>
                    <hr style="margin-top:7px;margin-bottom:7px;">
                @endif
                    
            @endif

            @if(EMedHelper::hasRoutePermission('admin.index'))
                <li>
                    <a href="{{ route('admin.index') }}">
                        <i class="fa fa-users "/></i>
                        <span>All Users</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::showListOfTarget('SPECIALIZATION'))
                <li>
                    <a href="{{ route('specialization.index')}} ">
                        <i class="fa fa-inbox sidebar-icon"></i>
                        <span class="sidebar-label">Specializations</span>
                    </a>
                </li>
            @endif

            <?php $hasNonUserPermission = false; ?>

            @if(EMedHelper::showListOfTarget('AFFILIATION'))
                <li>
                    <a href="{{ route('affiliations.index')}} ">
                        <i class="fa fa-bandcamp sidebar-icon"/></i>
                        <span class="sidebar-label">Affiliations</span>
                    </a>
                </li>
                <?php $hasNonUserPermission = true; ?>
            @endif

            @if(EMedHelper::showListOfTarget('ORGANIZATION'))
                <li>
                    <a href="{{ route('organizations.index')}} ">
                        <i class="fa fa-hospital-o sidebar-icon"/></i>
                        <span class="sidebar-label">Organizations</span>
                    </a>
                </li>
                <?php $hasNonUserPermission = true; ?>
            @endif

            @if(EMedHelper::showListOfTarget('PHARMACY'))
                <li>
                    <a href="{{ route('pharmacy.index')}} ">
                        <i class="fa fa-medkit sidebar-icon"/></i>
                        <span class="sidebar-label">Pharmacies</span>
                    </a>
                </li>
                <?php $hasNonUserPermission = true; ?>
            @endif

            @if(EMedHelper::hasTargetActionPermission('PMANAGER', 'TRANSACT_HIST'))
                <li>
                    <a href="{{ route('pharmatrans.history')}} ">
                        <i class="fa fa-medkit sidebar-icon"/></i>
                        <span class="sidebar-label">Transaction History</span>
                    </a>
                </li>
                <?php $hasNonUserPermission = true; ?>
            @endif

            @if(EMedHelper::hasTargetActionPermission('PHARMA', 'TRANSACT'))
                <li class="disabled">
                    <a href="{{ url('patient-prescriptions')}} "  class="disabled" >
                        <i class="fa fa-medkit sidebar-icon" style="color:#CED5D3;"/></i>
                        <span class="sidebar-label" style="color:#CED5D3;">Prescription Transaction</span>
                    </a>
                </li>
                <?php $hasNonUserPermission = true; ?>
            @endif

            @if($hasNonUserPermission)
                <hr style="margin-top:7px;margin-bottom:7px;">
            @endif

            @if(EMedHelper::showListOfTarget('ROLE'))
                <li>
                    <a href="{{ route('userroles.index') }}">
                        <i class="fa fa-universal-access sidebar-icon"></i>
                        <span class="sidebar-label">User Roles</span>
                    </a>
                </li>
            @endif

            <?php $hasUserPermission = false; ?>

            @if(EMedHelper::showListOfTarget('DOCTOR'))
                <li>
                    <a href="{{ route( 'doctors.index') }} ">
                        <i class="fa fa-ioxhost sidebar-icon"></i> 
                        <span class="sidebar-label">Doctors</span>
                    </a>
                </li>
                <?php $hasUserPermission = true; ?>
            @endif

            @if(EMedHelper::showListOfTarget('PMANAGER'))
                <li>
                    <a href="{{ route( 'managers.index') }} ">
                        <i class="fa fa-street-view sidebar-icon"></i> 
                        <span class="sidebar-label">Pharmacy Managers</span>
                    </a>
                </li>
            @endif

            @if(EMedHelper::showListOfTarget('SECRETARY'))
                <li>
                    <a href="{{ route( 'secretary.index') }} ">
                        <i class="fa fa-address-book-o sidebar-icon"></i> 
                        <span class="sidebar-label">Secretaries</span>
                    </a>
                </li>
                <?php $hasUserPermission = true; ?>
            @endif

            @if(EMedHelper::showListOfTarget('PHARMA'))
                <li>
                    <a href="{{ route( 'pharmacists.index') }} ">
                        <i class="fa fa-plus-square sidebar-icon"></i> 
                        <span class="sidebar-label">Pharmacists</span>
                    </a>
                </li>
                <?php $hasUserPermission = true; ?>
            @endif
             
            @if(EMedHelper::showListOfTarget('PATIENT'))
            @if(Session::get('user_type') === 'DOCTOR')
                <li class="hovering">
                     <a href="{{ route( 'mypatients.list') }} ">
                        <i class="fa fa-qq sidebar-icon"></i> 
                        <span class="sidebar-label"> My Patients</span>
                    </a>
                </li>
                
                @endif
                <li class="disabled">
                    <a href="{{ route( 'patients.index') }} " class="disabled">
                        <i class="fa fa-users" style="color: #f9fafc"></i> 
                        <span class="sidebar-label" style="color: #f9fafc;">All Patients</span>
                    </a>
                </li>
                <?php $hasUserPermission = true; ?>
            @endif

            @if($hasUserPermission)
                <hr style="margin-top:7px;margin-bottom:7px;">
            @endif

            <!-- Custom users goes here -->
            <?php 
                $customRoles = EMedHelper::getCustomRoles(); 
                $hasCustomUserPermission = false;
            ?>


            @if(!is_null($customRoles) && !empty($customRoles) && count($customRoles) > 0)
                @foreach($customRoles as $customRole)
                    @if(EMedHelper::showListOfTarget($customRole->name))
                        <li>
                            <a href="{{ url('custom-role', $customRole->id) }} ">
                                <i class="fa fa-drupal sidebar-icon"></i> 
                                <span class="sidebar-label">{{ $customRole->display_name }}</span>
                            </a>
                        </li>
                        <?php $hasCustomUserPermission = true; ?>
                    @endif
                @endforeach
            @endif

            @if($hasCustomUserPermission)
                <hr style="margin-top:7px;margin-bottom:7px;">
            @endif

            <li>
                <a href="{{ url('ChangePass') }}">
                    <i class="fa fa-unlock-alt "></i> 
                    <span>Change Password</span>
                </a>
            </li>
        </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <style type="text/css">
        .sidebar-icon {
            font-size:125% !important;
            margin-right:5px !important
        }
        .sidebar-label {
            font-size:97% !important;
        }
        .disabled {
           pointer-events: none;
           cursor: default;
        }
           
        .disabled:hover{
            color:  #f9fafc;
        }
    </style>

 