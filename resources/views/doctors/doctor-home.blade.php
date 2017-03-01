@extends('welcome')

@section('body')
<div class="container-fluid">
	<div class="row-bod">	
		<div class="col-md-9 col-md-offset-1">
    		<div class="panel panel-default"> 
			   	<div class="panel-heading">
			   		<h4 class="panel-title"><i class="glyphicon glyphicon-user"></i> Welcome Dr. {{ Auth::user()->fullname() }} </h4>
			   	</div>
				<div class="panel-body">
					<strong>Personal Info</strong><a href="#" class="btn btn-info  pull-right"><span class="glyphicon glyphicon-edit"></a><br>
					<hr class="third">
					<b>Fullname:</b> {{ Auth::user()->fullname() }} <br>
					<b>Username:</b> {{ Auth::user()->username }} &nbsp <b>Email Address</b> {{Auth::user()->email}}<br>
					<b>Contact number:</b> {{ Auth::user()->contact_number }}<br>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection