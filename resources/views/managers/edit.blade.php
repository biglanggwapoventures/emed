@extends('welcome') @section('body')

<div class="content-wrapper">
<section class="content-header">
        <h1>
            Manager Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/pmanager-home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Edit Manager</a></li>

        </ol>
    </section>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container-fluid"><br><br>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="panel-body">
                        {!! Form::open(['url' => route('managers.update', ['id' => $data->id]), 'method' => 'PUT']) !!} {!! Form::hidden('user_id', $data->userInfo->id) !!}

                        <h4>Personal Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                    <label class="control-label">First Name</label> {!! Form::text('firstname', $data->userInfo->firstname, ['class' => 'form-control']) !!} @if($errors->has('firstname'))
                                    <span class="help-block">{{ $errors->first('firstname') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('middle_initial') ? 'has-error' : '' }}">
                                    <label class="control-label">Middle Initial</label>
                                    <span style="color: red">*</span> {!! Form::text('middle_initial', $data->userInfo->middle_initial, ['class' => 'form-control']) !!} @if($errors->has('middle_initial'))
                                    <span class="help-block">{{ $errors->first('middle_initial') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                    <label class="control-label">Last Name</label>
                                    <span style="color: red">*</span> {!! Form::text('lastname', $data->userInfo->lastname, ['class' => 'form-control']) !!} @if($errors->has('lastname'))
                                    <span class="help-block">{{ $errors->first('lastname') }}<<input type="text" name="lastname" class="form-control"></span> @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <label class="control-label">Gender</label>
                                    <label for="sel1">Select list:</label>
                                    <span style="color: red">*</span>
                                    <select class="form-control" name="sex">
								   		<option>Male</option>
								    	<option>Female</option>
								  </select> @if($errors->has('sex'))
                                    <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Birthdate <span style="color: red">*</span></label> <input maxlength="100" name="birthdate" type="date" class="form-control" max="9999-12-31" style="width: 275px" value="{{ $data->userInfo->birthdate }}" /> @if($errors->has('Birthdate'))
                                    <span class="help-block">{{ $errors->first('birthdate') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                    <label class="control-label">Contact No.</label> {!! Form::text('contact_number', $data->userInfo->contact_number, ['class' => 'form-control']) !!} @if($errors->has('contact_number'))
                                    <span class="help-block">{{ $errors->first('contact_number') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="control-label">Home Address</label>
                                    <span style="color: red">*</span> {!! Form::text('address', $data->userInfo->address, ['class' => 'form-control']) !!} @if($errors->has('address'))
                                    <span class="help-block">{{ $errors->first('address') }}</span> @endif
                                </div>
                            </div>
                        </div>

                        <h4>Account Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                    <label class="control-label">Username</label> {!! Form::text('username', $data->userInfo->username, ['class' => 'form-control']) !!} @if($errors->has('username'))
                                    <span class="help-block">{{ $errors->first('username') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="control-label">Email</label> {!! Form::text('email', $data->userInfo->email, ['class' => 'form-control']) !!} @if($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
                            </div>
                 
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('license') ? 'has-error' : '' }}">
                                    <label class="control-label">License</label> {!! Form::text('license', $data->license, ['class' => 'form-control']) !!} @if($errors->has('license'))
                                    <span class="help-block">{{ $errors->first('license') }}</span> @endif
                                </div>
                            </div>
                        </div>

                        <h4>Drugstore Branch</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore</label> {!! Form::text('drugstore', $data->drugstore, ['class' => 'form-control']) !!} @if($errors->has('drugstore'))
                                    <span class="help-block">{{ $errors->first('drugstore') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore_branch') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore Branch</label> {!! Form::text('drugstore_branch', $data->drugstore_branch, ['class' => 'form-control']) !!} @if($errors->has('drugstore_branch'))
                                    <span class="help-block">{{ $errors->first('drugstore_branch') }}</span> @endif
                                </div>
                            </div>
                        </div>
               

                        @if(Auth::check()) @if(Auth::user()->user_type === 'PMANAGER')
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('license') ? 'has-error' : '' }}">
                                    <label class="control-label">License</label> {!! Form::text('license', $data->license, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('license'))
                                    <span class="help-block">{{ $errors->first('license') }}</span> @endif
                                </div>
                            </div>
                        </div>

                        <h4>Pharmacy Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore</label> {!! Form::text('drugstore', EMedHelper::retrievePharmacy($data->drugstore)->name, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('drugstore'))
                                    <span class="help-block">{{ $errors->first('drugstore') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                 <div class="form-group {{ $errors->has('drugstore_branch') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore Address</label> {!! Form::text('drugstore_branch', $data->drugstore_branch, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('drugstore_branch'))
                                    <span class="help-block">{{ $errors->first('drugstore_branch') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif

                        <button type="submit" class="btn btn-primary">Update</button> {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
