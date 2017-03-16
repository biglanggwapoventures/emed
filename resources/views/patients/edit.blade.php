@extends('welcome') @section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Edit Patient</h4>
                </div>
                <div class="panel-body">
                    <label>Update Profile Image </label> @if(Auth::check()) @if(Auth::user()->user_type === 'DOCTOR')
                    <img alt="User Pic" src="{{ " /storage/{$data->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"> {!! Form::open(['url' => route('upload.dp'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} {!! Form::hidden('id', $data->userInfo->id) !!}
                    <input type="file" name="avatar">
                    <input type="submit" class="btn btn-sm btn-primary"> @elseif(Auth::user()->user_type === 'PATIENT')
                    @elseif(Auth::user()->user_type === 'SECRETARY')
                    <img alt="User Pic" src="{{ " /storage/{$data->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"> @endif @endif {!! Form::close() !!} {!! Form::open(['url' => route('patients.update', ['id' => $data->id]), 'method' => 'PUT']) !!} {!! Form::hidden('user_id', $data->userInfo->id) !!}
                    <h4>Personal Information</h4>
                    <hr class="third">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                <label class="control-label">First Name</label>
                                <span style="color: red">*</span> {!! Form::text('firstname', $data->userInfo->firstname, ['class' => 'form-control']) !!} @if($errors->has('firstname'))
                                <span class="help-block">{{ $errors->first('firstname') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('middle_initial') ? 'has-error' : '' }}">
                                <label class="control-label">Middle Name</label>
                                <span style="color: red">*</span> {!! Form::text('middle_initial', $data->userInfo->middle_initial, ['class' => 'form-control']) !!} @if($errors->has('middle_initial'))
                                <span class="help-block">{{ $errors->first('middle_initial') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                <label class="control-label">Last Name</label>
                                <span style="color: red">*</span> {!! Form::text('lastname', $data->userInfo->lastname, ['class' => 'form-control']) !!} @if($errors->has('lastname'))
                                <span class="help-block">{{ $errors->first('lastname') }}</span> @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Birthdate <span style="color: red">*</span></label> {!! Form::date('birthdate', $data->userInfo->birthdate, ['class' => 'form-control'], ['maxlength' => 100]) !!} @if($errors->has('birthdate'))
                                <span class="help-block">{{ $errors->first('birthdate') }}</span> @endif

                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                <label class="control-label">Gender</label>
                                <span style="color: red">*</span>
                                <select class="form-control" name="sex">
											<option>Male</option>
											<option>Female</option>
										</select> @if($errors->has('sex'))
                                <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                <label class="control-label">Contact Number</label>
                                <span style="color: red">*</span> {!! Form::text('contact_number', $data->userInfo->contact_number, ['class' => 'form-control']) !!} @if($errors->has('contact_number'))
                                <span class="help-block">{{ $errors->first('contact_number') }}</span> @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label class="control-label">Home Address</label>
                                <span style="color: red">*</span> {!! Form::text('address', $data->userInfo->address, ['class' => 'form-control']) !!} @if($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('civilstatus') ? 'has-error' : '' }}">
                                <label class="control-label">Civil Status</label>
                                <span style="color: red">*</span>
                                <select class="form-control" name="civilstatus">
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
                                <label class="control-label">Blood type</label>
                                <span style="color: red">*</span> {!! Form::text('bloodtype', $data->bloodtype, ['class' => 'form-control']) !!} @if($errors->has('bloodtype'))
                                <span class="help-block">{{ $errors->first('bloodtype') }}</span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                                <label class="control-label">Nationality</label> {!! Form::text('nationality', $data->nationality, ['class' => 'form-control']) !!} @if($errors->has('nationality'))
                                <span class="help-block">{{ $errors->first('nationality') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('occupation') ? 'has-error' : '' }}">
                                <label class="control-label">occupation</label> {!! Form::text('occupation', $data->occupation, ['class' => 'form-control']) !!} @if($errors->has('occupation'))
                                <span class="help-block">{{ $errors->first('occupation') }}</span> @endif
                            </div>
                        </div>

                    </div>
                    <h4>Account Information</h4>
                    <hr class="third">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                <label class="control-label">Username</label>
                                <span style="color: red">*</span> {!! Form::text('username', $data->userInfo->username, ['class' => 'form-control']) !!} @if($errors->has('username'))
                                <span class="help-block">{{ $errors->first('username') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label class="control-label">Email Address</label>
                                <span style="color: red">*</span> {!! Form::text('email', $data->userInfo->email, ['class' => 'form-control']) !!} @if($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span> @endif
                            </div>
                        </div>
                    </div>
                    <h4>Emergency Contact</h4>
                    <hr class="third">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('econtact') ? 'has-error' : '' }}">
                                <label class="control-label">Name</label>
                                <span style="color: red">*</span> {!! Form::text('econtact', $data->econtact, ['class' => 'form-control']) !!} @if($errors->has('econtact'))
                                <span class="help-block">{{ $errors->first('econtact') }}</span> @endif
                            </div>
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
											<option>Others</option>
										</select> @if($errors->has('erelationship'))
                                <span class="help-block">{{ $errors->first('erelationship') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('enumber') ? 'has-error' : '' }}">
                                <label class="control-label">Contact Number</label>
                                <span style="color: red">*</span> {!! Form::text('enumber', $data->enumber, ['class' => 'form-control']) !!} @if($errors->has('enumber'))
                                <span class="help-block">{{ $errors->first('enumber') }}</span> @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button> {!! Form::close() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
