@extends('welcome') 
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div style="margin-top:10px">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Patients List</li>
                </ol>
            </div>
            <h1>
                <span style="font-size:80% !important;">
                    <span class="fa fa-qq" style="font-size:135%!important"></span>
                    &nbsp;List of Patients
                </span>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @if(EMedHelper::hasRoutePermission('patients.create'))
                        <a href="{{ route('patients.create') }}" class="btn btn-info btn-md add-button">
                            <span class="fa fa-plus" style="margin-right:5px;font-size:110%"></span>
                            Add Patient
                        </a>
                    @endif
                </div>
                <div class="hidden-xl hidden-lg hidden-md hidden-sm">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="active" style="height: 50px">
                                    <th class="align-th">Last Name</th>
                                    <th class="align-th">First Name</th>
                                    <th class="align-th">Gender</th>
                                    <th class="align-th">Contact No.</th>
                                    <th class="align-th">Email</th>
                                    @if(Auth::user()->user_type != 'ADMIN')
                                    <th class="align-th text-center">Status</th>
                                    @endif
                                    <th class="text-center"><span class="fa fa-ellipsis-h"></span></th>
                                </tr>
                            </thead>
                            <tbody id="userdata">
                                @forelse($patients AS $patient)
                                    <tr name="patient{{ $patient->id }}" data-user-info="{{ json_encode($patient->userInfo) }}">
                                        <td class="align-pt">
                                            {{ $patient->userInfo->lastname }}
                                        </td>
                                        <td class="align-pt">
                                            {{ $patient->userInfo->firstname }}
                                        </td>
                                        <td class="align-pt">
                                            {{ $patient->userInfo->sex }}
                                        </td>
                                        <td class="align-pt">
                                            {{ $patient->userInfo->contact_number }}
                                        </td>
                                        <td class="align-pt">
                                            {{ $patient->userInfo->email }}
                                        </td>
                                        @if(Auth::user()->user_type != 'ADMIN')
                                        <td class="align-pt text-center">
                                            @if(EMedHelper::hasDoctorAttachment($patient->id))
                                                <label class="attached-label">&nbsp;&nbsp;ATTACHED&nbsp;&nbsp;</label>
                                            @else
                                                <label class="detached-label">&nbsp;&nbsp;DETACHED&nbsp;&nbsp;</label>
                                            @endif
                                        </td>
                                        @endif
                                        <td class="text-center">
                                            <form action="{{ route('users.destroy', ['id' => $patient->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
                                                {{ csrf_field() }} 
                                                {{ method_field('DELETE') }}
                                                @if(Auth::user()->user_type === 'ADMIN')
                                                    <button type="submit" class="btn btn-danger" {{ EMedHelper::hasTargetActionPermission("PATIENT", "DELETE") ? "" : "disabled='disabled';style='opacity:0.30'" }}>
                                                        <span class="glyphicon glyphicon-trash action-icon"></span>
                                                    </button>
                                                @endif
                                                @if(EMedHelper::hasTargetActionPermission("PATIENT", "EDIT"))
                                                    <a href="{{ route('patients.edit', ['id' => $patient->id]) }}" class="btn btn-info {{ EMedHelper::hasDoctorAttachment($patient->id) ? '' : 'disabled' }}">
                                                        <span class="glyphicon glyphicon-edit action-icon"></span>
                                                    </a>
                                                @else
                                                    <a href="#" class="btn btn-info" disabled='disabled' style='opacity:0.50'>
                                                        <span class="glyphicon glyphicon-edit action-icon"></span>
                                                    </a>
                                                @endif
                                                <a name="viewInfo" data-id="{{ $patient->id }}" href="#" class="btn btn-warning">
                                                    <span class="fa fa-info-circle"></span>
                                                </a>

                                                @if(EMedHelper::hasTargetActionPermission("PATIENT", "PROFILE_BASIC"))
                                                    <a href="{{ route('patients.show', ['id' => $patient->id]) }}" class="btn btn-default" style="background-color:#999;color:#FFF;margin-left:15px">
                                                        <span class="fa fa-bars action-icon"></span>
                                                    </a>
                                                @elseif(EMedHelper::hasTargetActionPermission("PATIENT", "PROFILE_FULL"))
                                                    <a href="{{ route('patients.show', ['id' => $patient->id]) }}" class="btn btn-default" style="background-color:#999;color:#FFF;margin-left:15px">
                                                        <span class="fa fa-bars action-icon"></span>
                                                    </a>
                                                @endif
                                                
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No patients found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="viewUserInfo" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="padding:20px 40px 20px 60px;">
                <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                    <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                        <span id="mdl_userName"></span><br/>
                        <small class="sbold" style="margin-left:3px;">Basic information</small>
                    </h3>

                    <hr style="margin-top:-5px;margin-bottom:5px;"/>

                    <div class="row">
                        <div class="form-body">
                            <h4 class="form-section" style="padding-left:10px;">User Information</h4>
                        </div>
                        
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Username</h5>
                                <div id="mdl_user_name" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Email Address</h5>
                                <div id="mdl_email" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                    </div>

                    <hr style="margin-top:5px;" />

                    <div class="row" style="margin-top:-20px">
                        <div class="form-body">
                            <h4 class="form-section" style="padding-left:10px;">Personal Information</h4>
                        </div>
                        
                        <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Gender</h5>
                            </div>
                        </div>
                        <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <div id="mdl_gender" style="margin-top:-8px;"></div>  
                            </div>
                        </div>

                        <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-18px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Address</h5>
                            </div>
                        </div>
                        <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <div id="mdl_address" style="margin-top:-8px;"></div>  
                            </div>
                        </div>

                        <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-18px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Contact No.</h5>
                            </div>
                        </div>
                        <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <div id="mdl_contactno" style="margin-top:-8px;"></div>  
                            </div>
                        </div>

                        <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-18px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Birthdate</h5>
                            </div>
                        </div>
                        <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <div id="mdl_birthdate" style="margin-top:-8px;"></div>  
                            </div>
                        </div>

                    </div>

                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-12">
                            <button style="width:140px;margin-left:5px;" type="button" class="btn btn-primary grey pull-right" data-dismiss="modal">
                                Close 
                            </button>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style type="text/css">
        .align-th {
            font-size:98% !important;
        }
        .align-pt {
            font-size:98% !important;
            padding-top:15px !important;
        }
        .add-button {
            width:140px !important;
            height:40px !important;
            padding-top:10px !important
        }
        .action-icon {
            font-size: 85% !important;
        }
        .attached-label {
            background-color:#18e801;
            padding:5px;
            font-size:87%;
            margin-top:-10px!important;
            color:#FFF;
            border-radius: 15px;
        }
        .detached-label {
            background-color:#eb3f00;
            padding:5px;
            font-size:87%;
            margin-top:-10px!important;
            color:#FFF;
            border-radius: 15px;
        }
    </style>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $("a[name=viewInfo]").click(function()
                {
                    var userid = $(this).data('id');
                    var userdata = $("tr[name=patient" + userid + "]").data('user-info');
                    var fname, lastname, sex, username, email, username, address, contactno, birthdate;

                    fname = userdata.firstname;
                    lastname = userdata.lastname;
                    sex = userdata.sex;
                    username = userdata.username;
                    email = userdata.email;
                    address = userdata.address;
                    contactno = userdata.contact_number;
                    birthdate = userdata.birthdate;

                    $("#mdl_userName").text(lastname + ", " + fname);
                    $("#mdl_user_name").text(username);
                    $("#mdl_email").text(email);
                    $("#mdl_gender").text(sex);
                    $("#mdl_address").text(address);
                    $("#mdl_contactno").text(contactno);
                    $("#mdl_birthdate").text(birthdate);

                    $("#viewUserInfo").modal();
                });
            });
        </script>
    @endpush
@endsection
