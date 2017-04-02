@extends('welcome') @section('body')
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
                        <input type="password" name="current_password" class="form-control"> @if($errors->has('current_password'))
                        <span class="help-block">{{ $errors->first('current_password') }}</span> @endif
                    </div>
                    <div class="form-group {{ $errors->has('new_password') || isset($new_password) ? 'has-error' : '' }}">
                        <label class="control-label">new password</label>
                        <input type="password" name="new_password" class="form-control"> @if($errors->has('new_password'))
                        <span class="help-block">{{ $errors->first('new_password') }}</span> @endif @if(isset($new_password))
                        <span class="help-block">{{ $new_password }}</span> @endif
                    </div>
                    <div class="form-group {{ $errors->has('new_password_confirmation') || isset($new_password_confirmation) ? 'has-error' : '' }}">
                        <label class="control-label">password confirmation</label>
                        <input type="password" name="new_password_confirmation" class="form-control"> @if($errors->has('password'))
                        <span class="help-block">{{ $errors->first('new_password_confirmation') }}</span> @endif @if(isset($new_password_confirmation))
                        <span class="help-block">{{ $new_password_confirmation }}</span> @endif
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

</div>
@endsection
