@extends('welcome')

@section('body')

 <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-9">
    			<div class="panel panel-default">
			    	<div class="panel-heading">
			    		<h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Register</h4>
			    	</div>
			    		<div class="panel-body">
			    			<form action="{{route ('managers.store')}}" method=POST>
			    				{{ csrf_field() }}

			    				<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
			    				<label class="control-label">First Name</label>
			    				<input type="text" name="firstname" class="form-control">
			    				@if($errors->has('firstname'))
			    					<span class="help-block">{{ $errors->first('firstname') }}</span>
			    				@endif
			    				</div>

			    				<div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
			    				<label class="control-label">Last Name</label>
			    				<input type="text" name="lastname" class="form-control">
			    				@if($errors->has('lastname'))
			    					<span class="help-block">{{ $errors->first('lastname') }}</span>
			    				@endif
			    				</div>

			    				<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
			    				<label class="control-label">Username</label>
			    				<input type="text" name="username" class="form-control">
			    				@if($errors->has('username'))
			    					<span class="help-block">{{ $errors->first('username') }}</span>
			    				@endif
			    				</div>

			    				<div class="form-group {{ $errors->has('drugstore') ? 'has-error' : '' }}">
			    				<label class="control-label">Drugstore</label>
			    				<input type="text" name="drugstore" class="form-control">
			    				@if($errors->has('drugstore'))
			    					<span class="help-block">{{ $errors->first('drugstore') }}</span>
			    				@endif
			    				</div>

			    				
								<button type="submit" class="btn btn-primary">Register</button>
			    				</div>
			    		</div>
			    </div>
    		</div>
    	</div>

   </div>


@endsection



