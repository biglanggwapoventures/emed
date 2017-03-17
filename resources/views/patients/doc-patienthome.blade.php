@extends('welcome') @section('body')

<div class="container-fluid"><br><br><br>
  @if(session('ACTION_RESULT'))
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center">
          {{ session('ACTION_RESULT')['message'] }}
        </div>
      </div>
    </div>
  @endif
  
  <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#profile">General Info</a></li>
            <li><a data-toggle="tab" href="#menu1">Medical Profile</a></li>
            <li><a data-toggle="tab" href="#menu2">Consultations</a></li>
            <li><a data-toggle="tab" href="#menu3">Prescriptions</a></li>
        </ul>

        <div class="tab-content">
            <div id="profile" class="tab-pane fade in active">
                <a href="{{ route('patients.edit', ['id' => $patients->id]) }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-edit"></a><br>
                <hr class="third">

                <img alt="User Pic" src="{{ " /storage/{$patients->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive">
                <br><br>
                <div class="col-md-3 patprof">
                    <b>Fullname:</b> {{ $patients->userInfo->fullname() }} <br>
                    <b>Username:</b> {{ $patients->userInfo->username }} <br>  
                    <b>Email Address:</b> {{$patients->userInfo->email}}<br>
                    <b>Contact number:</b> {{ $patients->userInfo->contact_number}}<br>
                    <b>Gender:</b> {{ $patients->userInfo->sex }}<br><br><br>
                </div>

            </div>
    
            <div id="menu1" class="tab-pane fade">
              <h3>Headache and shit stuff lyk dat</h3>
               <p>Mother fuvkcing peacce of shit fvk y u no commit.</p>
            </div>
   
            <div id="menu2" class="tab-pane fade">
              <h3>Consultation</h3>
               <a href="{{ route('consultations.index', ['patient_id' =>  $patients->id]) }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus"></span> Consultation</a><br>
              <table class="table">
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
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                          </form>

                              <a href="{{ route('prescription.index', ['patient_id' => $patients->id]) }}"  class="btn btn-info"><span class="glyphicon glyphicon-plus">prescription</a>

                          <button 
                          type="button" 
                          class="btn btn-warning btn-default-sm" 
                          data-toggle="modal" 
                          data-target="#infoModal_{{ $a->id }}">
                          <span class="glyphicon glyphicon-info-sign">
                          </button>

                          <div class="modal fade" id="infoModal_{{ $a->id }}" 
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
                                  id="favoritesModalLabel">{{ $patients->userInfo->fullname() }}</h4>
                                </div>
                            <div class="modal-body">
                              <table class="table table-user-information">
                                <tbody>
                                  <tr>
                                    <td><b>Weight:</b>&#09;{{ $a->weight }}</td>
                                  </tr>
                                  <tr>
                                    <td><b>Height:</b>&#09;{{ $a->height }}</td>
                                  </tr>
                                  <tr>
                                    <td><b>Blood Pressure:</b>&#09;{{ $a->bloodpressure}} </td>
                                  </tr>
                               
                                     <tr>
                                    <tr>
                                    <td><b>Temperature:</b>&#09;{{ $a->temperature }}</td>
                                  </tr>
                                  <tr>
                                    <td><b>Pulse Rate:</b>&#09;{{ $a->pulserate }}</td>
                                  </tr>
                                    <td><b>Respiratory Rate:</b>&#09;{{ $a->resprate }}<br>
                                    </td>
                                     <tr>
                                    <td><b>Chief Complaints:</b>&#09;{{ $a->chiefcomplaints }}</td>
                                  </tr>
                                    <td><b>Notes:</b>&#09;{{ $a->notes }}</td>
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

            <div id="menu3" class="tab-pane fade">
              <h3>Weed and other drugs</h3>
              <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
          </div>
    </div>
  </div>
</div>

@endsection
