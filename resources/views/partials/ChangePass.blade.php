@extends('welcome') @section('body')
<div class="content-wrapper">
    <div class="container-fluid">

       
      <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Change Password</strong>

                </div>
                
                <div class="panel-body">
                    {!! Form::open(['url' => route('ChangePass'), 'method' => 'POST', 'enctype' => 'multipart/form-data'] , ['class' => 'form-control'] ,  ['role' => 'form']) !!}

                        <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                            <label for="inputPassword3" class="col-sm-3 control-label">Current</label>
                            <div class="col-sm-9">
                                <input type="password" name="current_password" class="form-control" id="inputPassword3" placeholder="Input Current Password" required="">
                                 @if($errors->has('current_password'))
                            <span class="help-block">{{ $errors->first('current_password') }}</span> @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('new_password') || isset($new_password) ? 'has-error' : '' }}">
                            <label for="inputPassword3" class="col-sm-3 control-label">New</label>
                            <div class="col-sm-9">
                                <input type="password" name="new_password" class="form-control" id="inputPassword3" placeholder="New Password" required="">
                                  @if($errors->has('new_password'))
                            <span class="help-block">{{ $errors->first('new_password') }}</span> @endif @if(isset($new_password))
                            <span class="help-block">{{ $new_password }}</span> @endif
                            <p>Must contain numbers uppercase lowercase symbols and number</p>
                            </div>
                        </div>
                         <div class="form-group {{ $errors->has('new_password_confirmation') || isset($new_password_confirmation) ? 'has-error' : '' }}">
                            <label for="inputPassword3" class="col-sm-3 control-label">Confirm</label>
                            <div class="col-sm-9">
                                <input type="password" name="new_password_confirmation" class="form-control" id="inputPassword3" placeholder="Confirm New Password" required="">
                                @if($errors->has('password'))
                            <span class="help-block">{{ $errors->first('new_password_confirmation') }}</span> @endif @if(isset($new_password_confirmation))
                            <span class="help-block">{{ $new_password_confirmation }}</span> @endif
                            </div>
                        </div>

                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                
                            </div>
                        </div>
                       {!! Form::close() !!}
                </div>
                 
                <div class="panel-footer">Cancel? <a href="{{ url('/doctor-home') }}" class="">Back to profile</a>

                </div>
           
            </div>
        </div>
    </div>

    </div>
</div>
</div>
<style type="text/css">
   /* CSS used here will be applied after bootstrap.css */



.panel-default {
 opacity: 0.9;
 margin-top:30px;
}
.form-group.last {
 margin-bottom:0px;

}
</style>
@endsection
