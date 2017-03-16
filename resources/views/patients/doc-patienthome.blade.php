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
            <li class="active"><a data-toggle="tab" href="#profile">Consultation</a></li>
            <li><a data-toggle="tab" href="#menu1">General Info</a></li>
            <li><a data-toggle="tab" href="#menu2">Vitals</a></li>
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
                    <th>Clinic</th>
                    <th>Chief Complaints</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($patients AS $a)
                    <tr>
                      <td>{{ $patients->created_at }}</td>
                      <td>{{ $patients->userInfo->lastname }}</td>
                      <td>{{ $patients->userInfo->firstname }}</td>
                      <td>  
                          <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                          <a href="#" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                          <a href="#" class="btn btn-warning">View </a>
                      </td>
                    </tr>
                    @empty
                        <tr>
                          <td colspan="4" class="text-center">No patients recorded</td>
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
