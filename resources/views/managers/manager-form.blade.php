@extends('welcome') @section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Pharmacy Registration</h4>
                </div>
                <div class="panel-body">
                 {!! Form::open(['url' => route ('managers.store'), 'method' => 'POST']) !!}

                        <h4>Personal Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                 {!! Form::bsText('firstname', 'Firstname') !!}
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
                                <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <label class="control-label">Gender</label>
                                    <label for="sel1">Select list:</label>
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
                                <div class="form-group">
                                    <label class="control-label">Birthdate <span style="color: red">*</span></label>
                                    <input maxlength="100" name="birthdate" type="date" class="form-control" style="width: 275px" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                 {!! Form::bsText('contact_number', 'Contact Number') !!}
                            </div>

                            <div class="col-md-4">
                                 {!! Form::bsText('address', 'Address') !!}
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
                            <div class="col-md-4">
                                {!! Form::bsText('license', 'License') !!}
                            </div>


                        </div>

                        <h4>Account Information</h4>
                        <hr class="third">
                        <div class="row">



                            <div class="col-md-4">
                                 {!! Form::bsText('drugstore', 'Drugstore') !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::bsText('drugstore_address', 'Address') !!}
                            </div>
                        </div>




                        <!--<div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
			    				<label class="control-label">Birthdate</label>
			    				<input type="text" name="birthdate" class="form-control">
			    				@if($errors->has('birthdate'))
			    					<span class="help-block">{{ $errors->first('birthdate') }}</span>
			    				@endif
			    				</div>-->

                        <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


@endsection
