@extends('welcome')

@section('body')
    <div class="container-fluid">

     <div class="text-center loginpage" style="color: #346677;">
        <div class="login-logo">ChangePassword</div>
        <!-- Main Form -->
        <div class="login-form-1">
           {!! Form::open(['url' => route('ChangePass'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
			    				<label class="control-label">current password</label>
			    				<input type="password" name="current_password" class="form-control">
			    				@if($errors->has('current_password'))
			    					<span class="help-block">{{ $errors->first('current_password') }}</span>
			    				@endif
			    			</div>
                        <div class="form-group {{ $errors->has('new_password') || isset($new_password) ? 'has-error' : '' }}">
			    				<label class="control-label">new password</label>
			    				<input type="password" name="new_password" class="form-control">
			    				@if($errors->has('new_password'))
			    					<span class="help-block">{{ $errors->first('new_password') }}</span>
			    				@endif
			    				@if(isset($new_password))
			    					<span class="help-block">{{ $new_password }}</span>
			    				@endif
			    			</div>
			    			   <div class="form-group {{ $errors->has('new_password_confirmation') || isset($new_password_confirmation) ? 'has-error' : '' }}">
			    				<label class="control-label">password confirmation</label>
			    				<input type="password" name="new_password_confirmation" class="form-control">
			    				@if($errors->has('password'))
			    					<span class="help-block">{{ $errors->first('new_password_confirmation') }}</span>
			    				@endif
			    				@if(isset($new_password_confirmation))
			    					<span class="help-block">{{ $new_password_confirmation }}</span>
			    				@endif
			    			</div>
                        <div class="form-group login-group-checkbox">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">remember</label>
                        </div>
                    </div>
                    <button type="submit" class="login-button"><i class="glyphicon glyphicon-chevron-right"></i></button>
                </div>
                <div class="etc-login-form">
                    <p>forgot your password? <a href="#">click here</a></p>
                </div>
             {!! Form::close() !!}
        </div>
        <!-- end:Main Form -->
    </div>
    	<!-- <div class="row">
    		<div class="col-md-4 col-md-offset-4">
    			<div class="panel panel-default">
			    	<div class="panel-heading">
			    		<h4 class="panel-title"><i class="glyphicon glyphicon-lock"></i> Login</h4>
			    	</div>
			    	<div class="panel-body">
			    		<form action="{{ url('/login') }}" method="POST">
			    			{{ csrf_field() }}
			    			<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
			    				<label class="control-label">Enter your username</label>
			    				<input type="text" name="username" class="form-control">
			    				@if($errors->has('username'))
			    					<span class="help-block">{{ $errors->first('username') }}</span>
			    				@endif
			    			</div>
			    			<div class="form-group {{ $errors->has('password') || isset($wrongPassword) ? 'has-error' : '' }}">
			    				<label class="control-label">Enter your password</label>
			    				<input type="password" name="password" class="form-control">
			    				@if($errors->has('password'))
			    					<span class="help-block">{{ $errors->first('password') }}</span>
			    				@endif
			    				@if(isset($wrongPassword))
			    					<span class="help-block">{{ $wrongPassword }}</span>
			    				@endif
			    			</div>
			    			<button type="submit" class="btn btn-primary btn-block">Login</button>
			    		</form>
			    	</div>
			    </div>
    		</div>
    	</div> -->
    </div>
@endsection