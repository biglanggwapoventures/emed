@extends('welcome') @section('body')
<div class="content-wrapper">
    @if(session('ACTION_RESULT'))
    <div class="row">

        <div class="col-md-6 col-md-offset-3">
           <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                {{ session('ACTION_RESULT')['message'] }}
            </div>
        </div>
    </div>
    @endif
    <!-- Content Header (Page header) -->
   <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                   <a href="{{ url(session('homepage') . '') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">{{ $items->userInfo->fullname()}}</li>
            </ol>
        </div>
        <h1>
           User Profile
            <small></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <center><img alt="User Pic" src="{{ "/storage/{$items->userInfo->avatar}" }}" style="width: 150px; height: 150px" class="img-circle img-responsive" ><center>

                        <h3 class="profile-username text-center"> </h3>

                        <p class="text-muted text-center">{{ $items->userInfo->fullname() }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <b>{{ $items->userInfo->email }}</b>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-home" aria-hidden="true"></i><b>{{ $items->userInfo->address }}</b>
                                <li class="list-group-item">
                                    <center><a href="{{ route( 'patients.edit', [ 'id'=> $items->id]) }}" class= "btn btn-info"><i class="fa fa-pencil" ></i> <span>Edit Profile</span></a></center>
                
                                </li>
                        </ul>

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
                        <!-- <li><a href="#consultation" data-toggle="tab">Consultations</a></li> -->
                    </ul>
                    <div class="tab-content">
                        <!-- tab start -->
                        <div class="active tab-pane" id="activity">
                            <table class="table table-user-information">
                                <tbody>


                                    <tr>
                                        <td><span class="glyphicon glyphicon-user"></span> &nbsp<b>Username</b> <br>{{ $items->userInfo->username }}</td>
                                        <td><span class="glyphicon glyphicon-envelope"></span> <b>Email</b> <br>{{$items->userInfo->email}}</td>
                                        <td><span class="glyphicon glyphicon-baby-formula"></span> <b>Date of Birth</b><br>{{ $items->userInfo->birthdate }}</td>
                                    </tr>

                                    <tr>
                                        <td><span class="glyphicon glyphicon-tint"></span> <b>Bloodtype</b> <br>{{ $items->bloodtype }}</td>
                                        <td><i class="fa fa-venus-mars" aria-hidden="true"></i> &nbsp <b>Gender</b> <br>{{ $items->userInfo->sex }}</td>
                                        <td><span class="glyphicon glyphicon-phone"></span> <b>Phone Number</b> <br>{{ $items->userInfo->contact_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-gavel" aria-hidden="true"></i><b>Civil Status</b> <br>{{ $items->civilstatus }}</td>
                                        <td><span class="glyphicon glyphicon-briefcase"></span> <b>Occuptation</b><br>{{ $items->occupation }}</td>
                                        <td><span class="glyphicon glyphicon-flag"></span> <b>Nationality</b><br>{{ $items->nationality }}</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <table class="table table-user-information">
                                <tbody>

                                    <tr>
                                        <td>
                                            <h3 class="pull-left">Medical Info</h3>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-question" aria-hidden="true"></i> <b>Do you have allergies? Y/N :</b><br>&nbsp {{ $items->allergyquestion }}</td>
                                        <td><i class="fa fa-bug" aria-hidden="true"></i> <b>Allergic to:</b> <br>
                                        @if($items->allergyquestion==='Y')
                                            {{ $items->allergyname }}
                                        @endif
                                        </td> 
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-wheelchair" aria-hidden="true"></i> <b>Past Diseases :</b><br>&nbsp {{$items->past_disease}}</td>
                                        <td><i class="fa fa-heart" aria-hidden="true"></i> <b>Past Surgeries:</b> <br>{{ $items->past_surgery}}</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-plus-square" aria-hidden="true"></i> <b>Immunizations :</b><br>&nbsp {{ $items->immunization }}</td>
                                        <td><i class="fa fa-user-circle-o" aria-hidden="true"></i> <b>Family History:</b> <br>{{ $items->family_history }}</td>
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
                                        <td><span class="glyphicon glyphicon-user"></span> <b>Contact</b> <br>{{ $items->econtact }}</td>
                                        <td><i class="fa fa-phone" aria-hidden="true"></i> <b>Contact Number</b><br>{{ $items->enumber }}</td>
                                        <td><i class="fa fa-gratipay" aria-hidden="true"></i></span> <b>Relationship</b><br>{{ $items->erelationship }}</td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <div class="box-body table-responsive no-padding">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="active">
                                        <!-- <th>Doctor</th> -->
                                        <th>Generic Name</th>
                                        <th>Brand name</th>
                                        <!-- <th>Dosage</th> -->
                                        <th>Frequency</th>
                                      <th>Info</th>
                                        <!-- <th>Available</th> -->
                                        <!-- <th>Start</th> -->
                                        <!-- <th>end</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $today = date('Y-m-d'); ?>
                                    @forelse($items->prescriptions AS $consultation)
                                        @if($consultation->end >= $today || $consultation->quantity > 0)

                                    
                                            <tr>
                                                <!-- <td>Dr. {{ $consultation->doctor->userInfo->fullname() }}</td> -->
                                                <td>{{ $consultation->genericname }}</td>
                                                <td>{{ $consultation->brand }}</td>
                                                <!-- <td>{{ $consultation->dosage }}</td> -->
                                                <td>{{ $consultation->frequency }}</td>
                                                <!-- <td>{{ $consultation->quantity }}</td> -->
                                                <!-- <td>{{ $consultation->start }}</td> -->
                                                <!-- <td>{{ $consultation->end }}</td> -->
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#notes">
                                                        <span class="glyphicon glyphicon-eye-open"></span>  Details
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                        @empty
                                     @endforelse
                                    </tbody>
                                </table>
                            </div>
                             <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#history">
                                                    <i class="fa fa-history" aria-hidden="true"></i>History
                                                </button>
                                                      <!-- notes -->
                                @forelse($items->prescriptions AS $consultation)
                                 <div class="modal fade" id="notes" tabindex="-1" role="basic" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content" style="padding:20px 35px 20px 40px;">
                                            <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                                                
                                                <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                                                    Prescription Details of {{ $items->userInfo->fullname()}}
                                                </h3>

                                                <hr style="margin-top:-5px;margin-bottom:5px;"/>
                                                 <p>{{$consultation->created_at}} </p>
                                                <div class="row">
                                                    <table style="padding-left:10px">
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                    
                                                     <table class="table" style="padding-left:10px">
                                                      <div class="form-body" style="padding-left:10px;margin-bottom:13px;background-color: whitesmoke">
                                                           <tr>
                                                           <td>
                                                            <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                                <label>Genericname</label><br/>
                                                                <span> {{ $consultation->genericname  }}</span>
                                                            </div>
                                                            </td>
                                                            <td>
                                                            <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                                <label>Brandname</label><br/>
                                                                <span>{{ $consultation->brand }}</span>
                                                            </div>
                                                            </td>
                                                            </tr>
                                                    </div>
                                                    </table>
                                                       
                                                     <table class="table" style="padding-left:10px">
                                                        <div class="form-body" style="padding-left:10px;margin-bottom:13px;background-color: whitesmoke">
                                                        
                                                           <tr>
                                                               <td>
                                                                    <label>Notes</label><br/>
                                                                  <span> {{ $consultation->notes }}</span>
                                                               </td>
                                                           </tr>
                                                           </div>
                                                     </table>
                                                 
                                                    
                                                    <table class="table" style="padding-left:10px">
                                                   <tr>
                                                   <td>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Frequency</label><br/>
                                                        <span> {{ $consultation->frequency  }}</span>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Dosage</label><br/>
                                                        <span>{{ $consultation->dosage  }} {{ $consultation->weight_type  }}</span>
                                                    </div>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Start</label><br/>
                                                        <span>{{ $consultation->start  }}</span>
                                                    </div></td>
                                                        <td><div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>End</label><br/>
                                                        <span>{{ $consultation->end  }}</span>
                                                    </div></td>
                                                    </tr>
                                                   <tr>
                                                       <td><div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Quantity</label><br/>
                                                        <span> {{ $consultation->quantity  }}</span>
                                                    </div></td>
                                                       <td><div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Prescribed by:</label><br/>
                                                        <span>{{ $consultation->doctor->userInfo->fullname() }}</span>
                                                    </div></td>
                                                   </tr> 
                                                
                                                    </table>
                                                        
                                                   
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
                                @empty
                                @endforelse
               <!-- notes -->
                                                <div class="modal fade" id="history" tabindex="-1" role="basic" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content" style="padding:20px 35px 20px 40px;">
                                            <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                                                
                                                <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                                                    Prescription History of {{ $items->userInfo->fullname() }} 
                                                </h3>

                                                <hr style="margin-top:-5px;margin-bottom:5px;"/>

                                                <div class="row">
                                                <div class="box-body table-responsive no-padding">
                                                   <table id="example4" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr class="active">
                                                            <th>Doctor</th>
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
                                                        @forelse($items->prescriptions AS $consultation)
                                                        <tr>
                                    <td style="{{ strtotime($consultation->end) < strtotime($today) ? 'color:red' : '' }}">{{ $consultation->doctor->userInfo->fullname() }}</td>
                                    <td style="{{ strtotime($consultation->end) < strtotime($today) ? 'color:red' : '' }}">{{ $consultation->genericname }}</td>
                                    <td style="{{ strtotime($consultation->end) < strtotime($today) ? 'color:red' : '' }}">{{ $consultation->brand }}</td>
                                    <td style="{{ strtotime($consultation->end) < strtotime($today) ? 'color:red' : '' }}">{{ $consultation->dosage }} {{ $consultation->weight_type  }}</td>
                                    <td style="{{ strtotime($consultation->end) < strtotime($today) ? 'color:red' : '' }}">{{ $consultation->frequency }}</td>
                                    <td style="{{ strtotime($consultation->end) < strtotime($today) ? 'color:red' : '' }}">{{ $consultation->quantity }}</td>
                                    <td style="{{ strtotime($consultation->end) < strtotime($today) ? 'color:red' : '' }}">{{ $consultation->start }}</td>
                                    <td style="{{ strtotime($consultation->end) < strtotime($today) ? 'color:red' : '' }}">{{ $consultation->end }}</td>
                                                        </tr>
                                                            @empty @endforelse
                                                        </tbody>
                                                    </table>
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
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="doctor">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="active">
                                        <th>Name</th>
                                        <th>Specialization</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items->doctors AS $item)
                                    <tr>
                                        <td>{{ $item->userInfo->fullname()}}</td>
                                        <td> <li>{!! $item->specializations->implode('name', '</li><li>') !!}</li> </td>

                                        <td>
                                            <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#infoModal_{{ $item->id }}">
                                                <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" id="myTooltip" title="View Details">
                                            </button>
                                            <a href="{{ route('doctors.show', ['id' => $item->id]) }}"><button type="button" class="btn btn-info btn-default-sm">
                                                <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" id="myTooltip" title="View Profile">
                                            </button></a>

                            <div class="modal fade" id="infoModal_{{ $item->id }}" tabindex="-1" role="basic" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content" style="padding:20px 35px 20px 40px;">
                                            <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                                                <center><img alt="User Pic" src="{{ "/storage/{$item->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>
                                                <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                                                    {{ $item->userInfo->fullname() }}
                                                </h3>

                                                <hr style="margin-top:-5px;margin-bottom:5px;"/>

                                                <div class="row">
                                                    <div class="form-body">
                                                        <h4 class="form-section" style="padding-left:10px;">User Information</h4>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Date of Birth</label><br/>
                                                        <span> {{ $item->userInfo->birthdate }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Gender</label><br/>
                                                        <span> {{ $item->userInfo->sex }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Home Address</label><br/>
                                                        <span>{{ $item->userInfo->address }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Email</label><br/>
                                                        <span>{{ $item->userInfo->email }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Phone Number</label><br/>
                                                        <span> {{ $item->userInfo->contact_number }}</span>
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
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td></td><td></td>
                                        <td colspan="4" class="text-center">No doctors recorded</td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        <!-- tab -->
                 <!--        <div class="tab-pane" id="consultation">
                            <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Consultations</h4>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="active">
                                        <th>Consultation Date</th>
                                        <th>Doctor</th>
                                        <th>Specialization</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items->consultations AS $a)
                                    <tr>
                                        <td>{{ $a->created_at }}</td>
                                        <td>{{ $a->doctor->userInfo->fullname() }}</td>
                                        <td><li>{!! $a->doctor->specializations->implode('name', '</li><li>') !!}</li></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#infoModals_{{ $a->id }}">
                              <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" id="myTooltip" title="View Details">
                            </button>

                                            <div class="modal fade" id="infoModals_{{ $a->id }}" tabindex="-1" role="basic" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content" style="padding:20px 35px 20px 40px;">
                                            <div class="modal-body">
                                            <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                                                    Consultation Summary
                                                </h3>
                                                <hr style="margin-top:-5px;margin-bottom:5px;"/>

                                                <div class="row">
                                                    <div class="form-body">
                                                    <table style="padding-left:10px;">
                                                        <tr>
                                                          <h4 class="form-section" style="padding-left:10px;">{{ $items->userInfo->fullname()}} <p style="padding-left:10px" class="pull-right">{{ $a->created_at  }}</p> </h4>
                                                         
                                                        </tr>
                                                    </table>
                                                        
                                                    </div>
                                                    <table class="table" style="padding-left:10px">
                                                        <tr>
                                                            <td><div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                             <label>Weight</label><br/>
                                                                 <span> {{ $a->weight  }} kgs</span>
                                                            </div>
                                                            </td>
                                                             <td>
                                                            <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                            <label>Height</label><br/>
                                                            <span> {{ $a->height }} ft.</span>
                                                            </div>
                                                            </td>
                                                            </tr>
                                                         <tr>
                                                             <td><div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                                <label>Blood Pressure</label><br/>
                                                                <span>{{ $a->bloodpressure }}</span>
                                                            </div></td>
                                                             <td><div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                                <label>Temperature</label><br/>
                                                                <span>{{ $a->temperature }} °C</span>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                            <td><div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                                 <label>Respiratory Rate</label><br/>
                                                                <span> {{ $a->resprate }} cpm</span>
                                                                </div></td>
                                                            <td><div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                                  <label>Pulse Rate</label><br/>
                                                                <span> {{ $a->pulserate }} bpm</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                                <div class="form-body" style="padding-left:10px;margin-bottom:13px;background-color: whitesmoke">
                                                                <label>Chief Complaints</label><br/>
                                                                <span> {{ $a->chiefcomplaints }}</span>
                                                                 </div>
                                                                <div class="form-body" style="padding-left:10px;margin-bottom:13px; background-color: whitesmoke">
                                                                <label>Diagnosis</label><br/>
                                                                <span> {{ $a->notes }}</span>
                                                                 </div>
                                                    </table>                                                     
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
                                            <div class="modal fade" id="infoModals_{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="favoritesModalLabel">{{ $items->userInfo->fullname() }}</h4>
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
                                            </div> -->

                                <!--         </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td></td><td></td><td></td>
                                        <td colspan="4" class="text-center">No consultations recorded</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> -->
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
<style type="text/css">
    .img-circle {
    border-radius: 50%;
    margin-left: 39px;
}
</style>
@endsection
