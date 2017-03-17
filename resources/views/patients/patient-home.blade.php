@extends('welcome') @section('body')
<div class="container-fluid"><br><br><br>
    <div class="container">

        <!-- @if(Auth::check()) 
            @if(Auth::user()->user_type === 'DOCTOR') -->
               <!--  <h2>Patient: {{ $items->userInfo->fullname() }} </h2>
                @include('patients.doc-patienthome')  -->

            <!-- @elseif(Auth::user()->user_type === 'PATIENT') -->
            <h2>Welcome {{ $items->userInfo->fullname() }} </h2>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
                <li><a data-toggle="tab" href="#menu1">Prescription</a></li>
                <li><a data-toggle="tab" href="#menu2">Doctors</a></li>
                <li><a data-toggle="tab" href="#menu3">Medical Profile</a></li>
            </ul>

            <div class="tab-content">
                <div id="profile" class="tab-pane fade in active">
                    <a href="{{ route('patients.edit', ['id' => $items->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a><br>
                    <hr class="third">

                    <img alt="User Pic" src="{{ " storage/{$items->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"> {!! Form::open(['url' => route('upload.dp'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <!-- <label>Update Profile Image</label> -->
                    <!--  <input type="file" name="avatar">
                      <input type="submit" class="btn btn-sm btn-primary"> -->
                    {!! Form::close() !!}
                    <br><br>
                    <div class="col-md-3 patprof">
                        <b>Fullname:</b> {{ $items->userInfo->fullname() }} <br>
                        <b>Username:</b> {{ $items->userInfo->username }} &nbsp <b>Email Address</b> {{Auth::user()->email}}<br>
                        <b>Contact number</b> {{ $items->userInfo->contact_number}}<br>
                        <b>Gender</b> {{ $items->userInfo->sex }}<br><br><br>

                        <b>Occupation:</b> {{ $items->occupation }} <br>
                    <b>Bloodtype:</b> {{ $items->bloodtype }} <br>  
                    <b>Nationality:</b> {{$items->nationality}}<br>
                    <b>Civil Status:</b> {{ $items->civilstatus}}<br>
                    <b>Emergency Contact:</b> {{ $items->econtact }}<br>
                    <b>Relationship:</b> {{ $items->erelationship }}<br>
                     <b>Contact number:</b> {{ $items->enumber }}<br>
                    </div>

                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3>Menu 1</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <table class="table">
                        <thead>
                            <tr class="active">
                                <th>Name</th>
                                <th>Specialization</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items->doctors AS $item)
                            <tr>
                                <td>{{ $item->userInfo->firstname }}</td>
                                <td>{{ $item->specialization }}</td>
                                <td>{{ $item->clinic_address }}</td>
                                <td>
                                    <button 
                                               type="button" 
                                               class="btn btn-warning btn-default-sm" 
                                               data-toggle="modal" 
                                               data-target="#infoModal_{{ $item->id }}">
                                              <span class="glyphicon glyphicon-info-sign">
                                    </button>
                                    <div class="modal fade" id="infoModal_{{ $item->id }}" 
                                         tabindex="-1" role="dialog" 
                                         aria-labelledby="favoritesModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" 
                                              data-dismiss="modal" 
                                              aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" 
                                            id="favoritesModalLabel">{{ $item->userInfo->fullname() }}, {{ $item->title }}</h4>
                                          </div>
                                          <div class="modal-body">
                                            <table class="table table-user-information">
                                            <center><img alt="User Pic" src="{{ "storage/{$item->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>
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
                <div id="menu3" class="tab-pane fade">
                     <b>Allergy question:</b> {{ $items->allergyquestion }} <br>
                    <b>What:</b> {{ $items->allergyname }} <br>  
                    <b>Disease History:</b> {{$items->past_disease}}<br>
                    <b>Surgery History:</b> {{ $items->past_surgery}}<br>
                    <b>Immunization:</b> {{ $items->immunization }}<br><br><br>
                     <b>Family History:</b> {{ $items->family_history }}<br><br><br>
                </div>
            </div>


        <!-- <div class="row-bod">
    
<div class="col-md-9 col-md-offset-1">
          <div class="panel panel-default"> 
            <div class="panel-heading">
              <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i> Welcome  {{ Auth::user()->fullname() }} </h4>
            </div>
          <div class="panel-body">
          
              <strong>Personal Info</strong><a href="#" class="btn btn-info  pull-right"><span class="glyphicon glyphicon-edit"></a><br>
              <hr class="third">
              <b>Fullname:</b> {{ Auth::user()->fullname() }} <br>
              <b>Username:</b> {{ Auth::user()->username }} &nbsp <b>Email Address</b> {{Auth::user()->email}}<br>
              <b>Contact number</b> {{Auth::user()->contact_number}}<br>

              
    </div>
          </div>
          </div> -->



        <!-- @endif @else @endif -->
        <!-- <p>To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a div element with class .tab-content.</p> -->
    </div>
</div>
@endsection
