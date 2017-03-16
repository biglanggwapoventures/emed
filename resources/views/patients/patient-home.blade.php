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
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items AS $item)
                            <tr>
                                <td>{{ $items->firstname }}</td>
                                <td>{{ $items->userInfo->firstname }}</td>
                                <td>{{ $items->bloodtype }}</td>
                                <td>
                                    <form action="{{ route('users.destroy', ['id' => $items->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                        <a href="{{ route('patients.edit', ['id' => $items->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                                        <a href="{{ route('patients.show', ['id' => $items->id]) }}" class="btn btn-warning">View Patient</a>
                                    </form>
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
                    <h3>Menu 3</h3>
                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <p>{{ $items->age }} years</p>
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
