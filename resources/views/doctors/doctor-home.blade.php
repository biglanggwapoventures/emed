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
                <!-- {!! Form::open(['url' => route('upload.dp'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                  <label>Update Profile Image</label>
                  <input type="file" name="avatar">
                  <input type="submit" class="btn btn-sm btn-primary">
                {!! Form::close() !!}
 -->

                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information" >
                    <tbody>
                      <tr>
                        <td><b>Username:</b> &nbsp  {{ $docs->userInfo->username }}</td>
                        <td><b>Email:</b>  &nbsp {{$docs->userInfo->email}}</td>
                      </tr>

                      <tr>
                        <td><b>Date of Birth:</b> &nbsp {{ $docs->userInfo->birthdate }}</td>
                        <td> <b>Gender:</b> &nbsp {{ $docs->userInfo->sex }}</td>
                      </tr>
                       <tr>
                        <td><b>Phone Number:</b> &nbsp  {{ $docs->userInfo->contact_number }}</td>
                        <td><b>Specialization:</b>  &nbsp  {{ $docs->specialization }}</td>
                        </td>
                        </tr>
                        <tr>
                        <td><b>Home Address:</b></td>
                      <td>
                        
                        
                                <p><strong>Subspecialty: </strong>
                             
                      </td>
                      
                      
                    </tr>
                      <tr>
                        <td>{{ $docs->userInfo->address }}</td>
                      
                      <td><p><?= implode(',<br> ', json_decode($docs['subspecialty'], true) ?: [])?><br></p></td>
                      </tr>
                   
                      <tr>
                        <td><b>Clinic Address:</b></td>
                        <td>{{ $docs->clinic_address }}</td>
                      </tr>
                      <tr>
                        <td><b>Clinic:</b>{{ $docs->clinic }}</td>
                        <td><b>Clinic Hours:</b>{{ $docs->clinic_hours }}</td>
                      </tr>
                         
                      <!-- medschool -->
                       <tr>
                        <td><b>Med School:</b></td>
                       <td><b>Med School year:</td>
                      </tr>
                      <tr>
                        
                         <td>{{ $docs->med_school }}</td>
                        <td>{{ $docs->med_school_year }}</td>
                      </tr>
                      <tr>
                        <td><b>Residency:</b></td>
                         <td><b>Residency Year:</b></td>
                      </tr>
                           <tr>
                           <td>{{ $docs->residency }}</td>
                       
                        <td>{{ $docs->residency_year }}</td>
                      </tr>
                      <tr>
                        <td><b>Training:</b></td>
                       <td><b>Training Year:</b></td>
                      </tr>
                      <tr>
                        <td>{{ $docs->training }}</td>
                       
                        <td>{{ $docs->training_year }}</td>
                      </tr>
                      <!-- med school end -->

                    
                      <tr>
                      <td>
                        
                        
                                <p><strong>Affiliations and Organizations: </strong>
                             
                      </td>
                      <td>
                        
                        <?= implode(',<br> ', json_decode($docs['affiliations'], true) ?: [])?><br></p>
                      </td>
                    </tr>
                     
                    </tbody>
                  </table>
                  
                  
                  <a href="#" class="btn btn-primary pull-right">Consultation Calendar</a>
                  <a  href="{{ route('patients.index') }}" class="btn btn-primary pull-right">Search Patients</a>
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right" style="margin-top: 8px;">
                            <a href="{{ route('doctors.edit', ['id' => $docs->user_id]) }}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
          </div>
        </div>
         <style type="text/css">
   
   table {
    border-collapse: collapse;
}

/* remove padding */
td, th {
    padding: 0;
}

 </style>

@endsection