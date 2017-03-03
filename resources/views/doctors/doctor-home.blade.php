@extends('welcome')

@section('body')
 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info" >
            <div class="panel-heading">
              <h4 class="panel-title"><h2>Dr. {{ Auth::user()->fullname() }}</h2></h4>
            </div>
             {{ csrf_field() }}
            <div class="panel-body">
            @forelse($docs AS $d)
            @if($d->userInfo->username === Auth::user()->username)
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Username:</b> &nbsp &nbsp &nbsp{{ $d->userInfo->username }}</td>
                        <td><b>Specialization:</b>  &nbsp &nbsp &nbsp{{ $d->specialization }}</td>
                      </tr>
                      <tr>
                        <td><b>Date of Birth:</b> &nbsp &nbsp &nbsp {{ $d->userInfo->birthdate }}</td>
                        <td>{{ $d->specialization }}</td>
                      </tr>
                      <tr>
                        <td><b>Gender</b>&nbsp &nbsp &nbsp{{ $d->userInfo->sex}} </td>
                        <td>{{ $d->userInfo->birthdate }}</td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Gender</td>
                        <td>{{ $d->userInfo->sex}}</td>
                      </tr>
                        <tr>
                        <td>Home Address</td>
                        <td>{{ $d->userInfo->address }}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>{{ $d->userInfo->email }}</td>
                      </tr>
                        <td>Phone Number</td>
                        <td>1{{ $d->userInfo->contact_number }}<br>
                        </td>
                         <tr>
                        <td>Clinic</td>
                        <td>{{ $d->clinic }}</td>
                      </tr>
                      <tr>
                        <td>Clinic Address:</td>
                        <td>{{ $d->clinic_address }}</td>
                      </tr>
                           <tr>
                        <td>Clinic Hours:</td>
                        <td>{{ $d->clinic_hours }}</td>
                      </tr>
                      </tr>
                     
                    </tbody>
                  </table>
                  
                  
                  <a href="#" class="btn btn-primary pull-right">Secretaries</a>
                  <a href="#" class="btn btn-primary pull-right">Search Patients</a>
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            @endif
					@empty
						<p>There are no users yet!</p>
					@endforelse
          </div>
        </div>

<!-- <div class="container-fluid">
	<div class="row-bod">		
		<div class="col-md-9 col-md-offset-1">
    		<div class="panel panel-default"> 
			   	<div class="panel-heading">
		    		<h4 class="panel-title"><i class="glyphicon glyphicon-user"></i> Welcome Dr. {{ Auth::user()->fullname() }} </h4>
			    </div>
			    {{ csrf_field() }}
			    <div class="panel-body">
			    	@forelse($docs AS $d)
			    		@if($d->userInfo->username === Auth::user()->username)
					    	<h2><strong>{{ $d->userInfo->fullname() }} </h2></strong><br>
					    	<strong>Specialization:</strong>{{ $d->specialization }} <br>
					    	<strong>Clinic:</strong>{{ $d->clinic }} <br>
					    @endif
					@empty
						<p>There are no users yet!</p>
					@endforelse
			    </div>
			</div>
		</div>
	</div>
</div> -->

@endsection