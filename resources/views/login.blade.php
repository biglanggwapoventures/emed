@extends('welcome') @section('body')
<!-- <div class="container-fluid">
    <div class="text-center loginpage" style="color: #346677;">
        <div class="login-logo">login</div>
        <div class="login-form-1">
            <form action="{{ url('/login') }}" method="POST">
                {{ csrf_field() }}
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label class="control-label">Username</label>
                            <input type="text" name="username" class="form-control"> @if($errors->has('username'))
                            <span class="help-block">{{ $errors->first('username') }}</span> @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') || isset($wrongPassword) ? 'has-error' : '' }}">
                            <label class="control-label">Password</label>
                            <input type="password" name="password" class="form-control"> @if($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span> @endif @if(isset($wrongPassword))
                            <span class="help-block">{{ $wrongPassword }}</span> @endif
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
            </form>
        </div>
    </div>
</div> -->
@endsection
