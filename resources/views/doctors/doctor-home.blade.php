@extends('welcome')

@section('body')
 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info" >
            <div class="panel-heading">
              <h4 class="panel-title"><h2>Dr. {{ $docs->userInfo->fullname() }}</h2></h4>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ "storage/{$docs->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive">
                {!! Form::open(['url' => route('upload.dp'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                  <label>Update Profile Image</label>
                  <input type="file" name="avatar">
                  <input type="submit" class="btn btn-sm btn-primary">
                {!! Form::close() !!}

                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Username:</b> &nbsp &nbsp &nbsp{{ $docs->userInfo->username }}</td>
                        <td><b>Specialization:</b>  &nbsp &nbsp &nbsp{{ $docs->specialization }}</td>
                      </tr>
                      <tr>
                        <td><b>Date of Birth:</b> &nbsp &nbsp &nbsp</td>
                        <td> {{ $docs->userInfo->birthdate }}</td>
                      </tr>
                      <tr>
                        <td><b>Gender</b>&nbsp &nbsp &nbsp{{ $docs->userInfo->sex}} </td>
                        <td>{{ $docs->userInfo->birthdate }}</td>
                      </tr>
                   
                         <tr>
                        <tr>
                        <td>Home Address</td>
                        <td>{{ $docs->userInfo->address }}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>{{ $docs->userInfo->email }}</td>
                      </tr>
                        <td>Phone Number</td>
                        <td>1{{ $docs->userInfo->contact_number }}<br>
                        </td>
                         <tr>
                        <td>Clinic</td>
                        <td>{{ $docs->clinic }}</td>
                      </tr>
                      <tr>
                        <td><b>Clinic Address:</b></td>
                        <td>{{ $docs->clinic_address }}</td>
                      </tr>
                           <tr>
                        <td>Clinic Hours:</td>
                        <td>{{ $docs->clinic_hours }}</td>
                      </tr>
                      </tr>
                     
                    </tbody>
                  </table>
                  
                  
                  <a href="#" class="btn btn-primary pull-right">Consultation Calendar</a>
                  <a href="#" class="btn btn-primary pull-right">Search Patients</a>
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right" style="margin-top: 8px;">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
          </div>
        </div>

@endsection