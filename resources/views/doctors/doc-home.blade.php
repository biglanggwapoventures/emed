@extends('welcome') @section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
        <h1>
           User Profile
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/patient-home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/doctor-home"><i class="fa fa-user"></i> Dr. {{ $doctors->userInfo->fullname() }}</a></li>
           

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <center>
                            <img alt="User Pic" src="{{ " storage/{$doctors->userInfo->avatar}" }}"style="width: 150px; height: 150px" class="img-circle img-responsive" ><br>
                        </center>

                        <h3 class="profile-username text-center">Dr. {{ $doctors->userInfo->fullname() }} </h3>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <!-- <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
                    </ul> -->
                    <div class="tab-content">
                        <!-- tab start -->
                        <div class="active tab-pane" id="activity">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        @if(session('ACTION_RESULT'))
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                 <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                                                    {{ session('ACTION_RESULT')['message'] }}

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </tr>
                                    <tr><b><h3>Personal information</h3></tr></b></tr>
                                    <tr>
                                        <td><span class="glyphicon glyphicon-user"></span> &nbsp<b>Username</b> <br> {{ $doctors->userInfo->username }}</td>
                                        <td><span class="glyphicon glyphicon-envelope"></span> <b>Email</b> <br> {{$doctors->userInfo->email}}</td>
                                    </tr>

                                    <tr>
                                        <td><span class="glyphicon glyphicon-baby-formula"></span> <b>Date of Birth</b><br> {{ $doctors->userInfo->birthdate }}</td>
                                        <td><i class="fa fa-fw fa-venus-mars" aria-hidden="true"></i> &nbsp <b>Gender</b> <br>{{ $doctors->userInfo->sex }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="glyphicon glyphicon-phone"></span> <b>Phone Number</b> <br> {{ $doctors->userInfo->contact_number }}</td>
                                        <td><i class="fa fa-fw fa-user-md" aria-hidden="true"></i></span> <b>Specialization</b> <br> {{ $doctors->specialization->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;"><span class="glyphicon glyphicon-home"></span> <b>Home Address</b><br>{{ $doctors->userInfo->address }}</td>
                                        <td>
                                            <i class="fa fa-fw fa-stethoscope" aria-hidden="true"></i> <b>Subspecialty </b><br>
                                            
                                                <li>{!! implode('</li>
                                                <li>', $doctors->subspecializations->pluck('name')->toArray()) !!}</li>
                                                <br>
                                        </td>
                                    </tr>
                                    <tr>
                            <td><b><h3>Clinic Information</h3></td>
                            <td></td>
                            </tr>  
                                <tr>
                                    <td colspan="3">
                                        <table class="table">
                                            <thead><tr><th>Clinic</th><th>Branch</th><th>Clinic Hours</th></tr></thead>
                                            <tbody>
                                                @forelse($doctors->affiliations AS $aff)
                                                    <?php
                                                        $start = $aff->pivot->clinic_start;
                                                        $end =  $aff->pivot->clinic_end;
                                                        $start_time = date("g:i A", strtotime("$start"));
                                                        $end_time = date("g:i A", strtotime("$end"));
                                                    ?>
                                                    <tr>
                                                        <td>{{ $aff->name }}</td>
                                                        <td>{{ EMedHelper::retrieveAffiliationBranch($aff->pivot->affiliation_branch_id)->name }}</td>
                                                        <td>{{ $start_time }} - {{ $end_time }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">No affiliations recorded</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <tr>
                                <td>
                                    <b><h3>Educational Background</h3></td>
                            <td></td>
                            </tr>                            
                            <tr>
                                <td><span class="glyphicon glyphicon-education"></span> <b>Med School</b><br>{{ $doctors->med_school }}</td>
                                        <td><i class="fa fa-fw fa-calendar" aria-hidden="true"></i> <b>Med School year</b><br>{{ $doctors->med_school_year }}</td>
                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-fw fa-building" aria-hidden="true"></i><b>Residency</b><br>{{ $doctors->residency }}</td>
                                        <td><b><i class="fa fa-fw fa-calendar" aria-hidden="true"></i> Residency Year</b><br>{{ $doctors->residency_year }}</td>
                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-fw fa-leanpub" aria-hidden="true"></i> <b>Training</b><br>{{ $doctors->training }}</td>
                                        <td><i class="fa fa-fw fa-calendar" aria-hidden="true"></i> <b>Training Year</b><br>{{$doctors->training_year }}</td>
                                    </tr>

                                    <!-- med school end -->
                                    <tr>
                                         <td>
                                            <i class="fa fa-fw fa-stethoscope" aria-hidden="true"></i> <b>Affiliations and Organizations </b><br>
                                            
                                                <li>{!! implode('</li>
                                                <li>', $doctors->organizations->pluck('organizations')->toArray()) !!}</li>
                                                <br>
                                        </td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>




                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

    </section>
    <!-- /.content -->
    </div>


<script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);
</script>

    @endsection
