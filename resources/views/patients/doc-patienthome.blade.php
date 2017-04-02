@extends('welcome') @section('body')
<div class="content-wrapper">
    @if(session('ACTION_RESULT'))
    <div class="row">

        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center">
                {{ session('ACTION_RESULT')['message'] }}
            </div>
        </div>
    </div>
    @endif
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="/doctor-home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('patients.index') }}">Patients</a></li>
            <li class="active">{{ $patients->userInfo->fullname() }} </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ " /storage/{$patients->userInfo->avatar}" }}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{ $patients->userInfo->fullname() }} </h3>

                        <p class="text-muted text-center">Patient</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <b>{{$patients->userInfo->email}}</b>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-home" aria-hidden="true"></i><b>{{ $patients->userInfo->address }}</b>
                                <li class="list-group-item">

                                </li>
                        </ul>
                        @can('detach-patient', $patients) {!! Form::open(['url' => url('/detach-patient', ['patientId' => $patients->id]), 'method' => 'POST', 'onsubmit' => 'return confirm("Are you sure?")']) !!}
                        <button class="btn btn-danger btn-block" type="submit">Remove patient</button> {!! Form::close() !!} @endcan @can('attach-patient', $patients) {!! Form::open(['url' => url('/attach-patient', ['patientId' => $patients->id]), 'method' => 'POST', 'onsubmit' => 'return confirm("Are you sure?")']) !!}
                        <button class="btn btn-primary btn-block" type="submit">Attach patient</button> {!! Form::close() !!} @endcan

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
                        <li><a href="#timeline" data-toggle="tab">Medical profile</a></li>
                        <li><a href="#settings" data-toggle="tab">Prescriptions</a></li>
                        <li><a href="#doctor" data-toggle="tab">Doctor</a></li>
                        <li><a href="#consultation" data-toggle="tab">Consultations</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- tab start -->
                        <div class="active tab-pane" id="activity">
                            <table class="table table-user-information">
                                <tbody>

                                    <tr>
                                        @if(session('ACTION_RESULT'))
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center">
                                                    {{ session('ACTION_RESULT')['message'] }}

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </tr>
                                    <tr><b><h3>Personal information</h3></tr></b></tr>
                                    <tr>
                                        <td><span class="glyphicon glyphicon-user"></span> &nbsp<b>Username</b> <br> {{ $patients->userInfo->username }} </td>
                                        <td><span class="glyphicon glyphicon-envelope"></span> <b>Email</b> <br> {{$patients->userInfo->email}}</td>
                                        <td><span class="glyphicon glyphicon-baby-formula"></span> <b>Date of Birth</b><br> {{ $patients->userInfo->birthdate }}</td>
                                    </tr>

                                    <tr>
                                        <td><span class="glyphicon glyphicon-tint"></span> <b>Bloodtype</b> <br> {{ $patients->bloodtype }}</td>
                                        <td><i class="fa fa-venus-mars" aria-hidden="true"></i> &nbsp <b>Gender</b> <br>{{ $patients->userInfo->sex }}</td>
                                        <td><span class="glyphicon glyphicon-phone"></span> <b>Phone Number</b> <br> {{ $patients->userInfo->contact_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-gavel" aria-hidden="true"></i><b>Civil Status</b> <br> {{ $patients->civilstatus }}</td>
                                        <td><span class="glyphicon glyphicon-briefcase"></span> <b>Occuptation</b><br>{{ $patients->occupation }}</td>
                                        <td><span class="glyphicon glyphicon-flag"></span> <b>Nationality</b><br>{{ $patients->nationality }}</td>
                                    </tr>



                                </tbody>
                            </table>

                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <table class="table table-user-information">
                                <a href="{{ route('patients.edit', ['id' => $patients->id]) }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-edit"></a>
                                <tbody>

                                    <tr>
                                        <td>
                                            <h3 class="pull-left">Medical Info</h3>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-question" aria-hidden="true"></i> <b>Do you have allergies? Y/N :</b><br>&nbsp {{ $patients->allergyquestion }} </td>
                                        <td><i class="fa fa-bug" aria-hidden="true"></i> <b>Allergic to:</b> <br>{{ $patients->allergyname }} </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-wheelchair" aria-hidden="true"></i> <b>Past Diseases :</b><br>&nbsp {{$patients->past_disease}} </td>
                                        <td><i class="fa fa-heart" aria-hidden="true"></i> <b>Past Surgeries:</b> <br> {{ $patients->past_surgery}} </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-plus-square" aria-hidden="true"></i> <b>Immunizations :</b><br>&nbsp{{ $patients->immunization }}</td>
                                        <td><i class="fa fa-user-circle-o" aria-hidden="true"></i> <b>Family History:</b> <br>{{ $patients->family_history }} </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="pull-left">Incase of Emergency</h3>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><span class="glyphicon glyphicon-user"></span> <b>Contact</b> <br> {{ $patients->econtact }}</td>
                                        <td><i class="fa fa-phone" aria-hidden="true"></i> <b>Contact Number</b><br>{{ $patients->enumber }}</td>
                                        <td><i class="fa fa-gratipay" aria-hidden="true"></i></span> <b>Relationship</b><br>{{ $patients->erelationship }}</td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Prescriptions</h4>
                            <div class="box-body table-responsive no-padding">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="active">
                                            <th>Generic Name</th>
                                            <th>Brand name</th>
                                            <th>Dosage</th>
                                            <th>Frequency</th>
                                            <th>Available</th>
                                            <th>Start</th>
                                            <th>end</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patients->prescriptions AS $consultation)
                                        <tr>
                                            <td>{{ $consultation->genericname }}</td>
                                            <td>{{ $consultation->brand }}</td>
                                            <td>{{ $consultation->dosage }}</td>
                                            <td>{{ $consultation->frequency }}</td>
                                            <td>{{ $consultation->quantity }}</td>
                                            <td>{{ $consultation->start }}</td>
                                            <td>{{ $consultation->end }}</td>
                                        </tr>
                                        @empty @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="doctor">
                            <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Prescriptions</h4>
                            <div class="box-body table-responsive no-padding">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="active">
                                            <th>Name</th>
                                            <th>Specialization</th>
                                            <th>Address</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patients->doctors AS $item)
                                        <tr>
                                            <td>{{ $item->userInfo->fullname() }}</td>
                                            <td>{{ $item->specialization }}</td>
                                            <td>{{ $item->clinic_address }}</td>

                                            <td>
                                                <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#infoModal_{{ $item->id }}">
                                              <span class="glyphicon glyphicon-info-sign">
                                    </button>
                                                <div class="modal fade" id="infoModal_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="favoritesModalLabel">{{ $item->userInfo->fullname() }}, {{ $item->title }}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-user-information">
                                                                    <center><img alt="User Pic" src="{{ " /storage/{$item->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><b>Clinic:</b>&#09;{{ $item->clinic }}, {{ $item->clinic_address }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Gender:</b>&#09;{{ $item->userInfo->sex}} </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <tr>
                                                                                <td><b>Clinic Hours:</b>&#09;{{ $item->clinic_hours }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Email:</b>&#09;{{ $item->userInfo->email }}</td>
                                                                            </tr>
                                                                            <td><b>Phone Number:</b>&#09;{{ $item->userInfo->contact_number }}<br>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>PRC License:</b>&#09;{{ $item->prc }}<br>
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No doctors recorded</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- tab -->
                        <div class="tab-pane" id="consultation">
                            <div class="box-body table-responsive no-padding">
                                <table>
                                    <thead>
                                        <th> <a href="{{ route('consultations.index', ['patient_id' =>  $patients->id]) }}" class="btn btn-info pull-left"><span class="glyphicon glyphicon-plus"></span> Consultation</a></th>
                                    </thead>
                                </table><br>
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="active">
                                            <th>Consultation Date</th>
                                            <th>Doctor</th>
                                            <th>Clinic</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patients->consultations AS $a)
                                        <tr>
                                            <td>{{ $a->created_at }}</td>
                                            <td>{{ $a->doctor->userInfo->fullname() }}</td>
                                            <td>{{ $a->doctor->clinic_address }}</td>
                                            <td>

                                                <form action="{{ route('consultations.destroy', ['patient_id' => $patients->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                                </form>

                                                <a href="{{ route('prescription.index', ['patient_id' => $patients->id, 'consultation_id' => $a->id]) }}" class="btn btn-info" style=""><b>P</b></a>


                                                <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#infoModal_{{ $a->id }}">
                          <span class="glyphicon glyphicon-info-sign">
                          </button>

                                                <div class="modal fade" id="infoModal_{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="favoritesModalLabel">{{ $patients->userInfo->fullname() }}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-user-information">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><b>Weight:</b>&#09;{{ $a->weight }} kgs</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Height:</b>&#09;{{ $a->height }} cm</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Blood Pressure:</b>&#09;{{ $a->bloodpressure}} mmHg</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <tr>
                                                                                <td><b>Temperature:</b>&#09;{{ $a->temperature }} C</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Pulse Rate:</b>&#09;{{ $a->pulserate }} bpm</td>
                                                                            </tr>
                                                                            <td><b>Respiratory Rate:</b>&#09;{{ $a->resprate }} cpm<br>
                                                                            </td>
                                                                            <tr>
                                                                                <td><b>Chief Complaints:</b>&#09;<br>{{ $a->chiefcomplaints }}</td>
                                                                            </tr>
                                                                            <td><b>Diagnosis:</b><br>{{ $a->notes }}</td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                                <div class="box-body table-responsive no-padding">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <span class="pull-right">
                            <button type="button" 
                             class="btn btn-default" 
                             data-dismiss="modal">Close</button>
                            </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No consultations recorded</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                </div>
                            </div>
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




    @endsection
