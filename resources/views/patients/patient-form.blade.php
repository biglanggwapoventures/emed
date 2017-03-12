@extends('welcome') @section('body')


<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Patient Registration</h4>
                </div>
                <div class="panel-body">
                	@if(count($errors->all()))
                		<div class="alert alert-danger">
                			<ul class="list-unstyled">                				
		                		@foreach($errors->all() AS $err)
		                			<li>{{ $err }}</li>
		                		@endforeach	
                			</ul>
                		</div>
                	@endif
                 {!! Form::open(['url' => route ('patients.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    
                        <img alt="User Pic" src="{{ " /storage/default.jpg " }}" style="width: 150px; height: 150px;" class="img-circle img-responsive">
                        <input type="file" class="upload" name="avatar"> 
                        <h4>Personal Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::bsText('firstname', ' Firstname') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('middle_initial', 'Middle Initial') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('lastname', 'Lastname') !!}
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Birthdate <span style="color: red">*</span></label>
                                    <input maxlength="100" name="birthdate" type="date" class="form-control" style="width: 275px" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <label class="control-label">Gender</label>
                                    <span style="color: red">*</span>
                                    <select class="form-control" name="sex">
										<option value="" selected disabled>Select</option>
											<option>Male</option>
											<option>Female</option>
										</select> @if($errors->has('sex'))
                                    <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('contact_number', 'Contact Number') !!}
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                {!! Form::bsText('address', 'Home Address') !!}
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('civilstatus') ? 'has-error' : '' }}">
                                    <label class="control-label">Civil Status</label>
                                    <span style="color: red">*</span>
                                    <select class="form-control" name="civilstatus">
										<option value="" selected disabled>Select</option>
											<option>Single</option>
											<option>Married</option>
											<option>Widowed</option>
											<option>Separated</option>
										</select> @if($errors->has('civilstatus'))
                                    <span class="help-block">{{ $errors->first('civilstatus') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('bloodtype') ? 'has-error' : '' }}">
                                    <label class="control-label">Bloodtype</label>
                                    <span style="color: red">*</span>
                                    <select class="form-control" name="bloodtype">
										<option value="" selected disabled>Select</option>
											<option>A+</option>
											<option>A-</option>
											<option>B+</option>
											<option>B-</option>
											<option>AB+</option>
											<option>A-</option>
											<option>O+</option>
											<option>O-</option>
											<option>Unknown</option>
										</select> @if($errors->has('bloodtype'))
                                    <span class="help-block">{{ $errors->first('bloodtype') }}</span> @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                 {!! Form::bsText('nationality', 'Nationality') !!}
                            </div>
                            <div class="col-md-4">
                                 {!! Form::bsText('occupation', 'Occupation') !!}
                            </div>

                        </div>

                        <h4>Account Information</h4>
                        <hr class="third">

                        <div class="row">

                            <div class="col-md-4">
                                 {!! Form::bsText('username', 'Username') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('email', 'Email') !!}
                            </div>
                        </div>
                        <h4>Emergency Contact</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::bsText('econtact', 'Emergency Contact') !!}
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('erelationship') ? 'has-error' : '' }}">
                                    <label class="control-label">Relationship</label>
                                    <span style="color: red">*</span>
                                    <select class="form-control" name="erelationship">
											<option>Mother</option>
											<option>Father</option>
											<option>Sister</option>
											<option>Brother</option>
											<option>Cousin</option>
											<option>Guardian</option>
											<option>Spouse</option>
											<option>Others</option>
										</select> @if($errors->has('erelationship'))
                                    <span class="help-block">{{ $errors->first('erelationship') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('enumber', 'Contact Number') !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
