@extends('welcome')

@section('body')

 <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-9 col-md-offset-1">
    			<div class="panel panel-default">
			    	<div class="panel-heading">
			    		<h4 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Update doctor:  <span class="text-success"> {{ $data->userInfo->fullname() }}</span></h4>
			    	</div>
					<div class="panel-body">
                        {!! Form::open(['url' => route('doctors.update', ['id' => $data->id]), 'method' => 'PUT']) !!}
							{!! Form::hidden('user_id', $data->userInfo->id) !!}
							<div class="row">
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
										<label class="control-label">First Name</label>
                                        {!! Form::text('firstname', $data->userInfo->firstname, ['class' => 'form-control']) !!}
										@if($errors->has('firstname'))
											<span class="help-block">{{ $errors->first('firstname') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
										<label class="control-label">Last Name</label>
										{!! Form::text('lastname', $data->userInfo->lastname, ['class' => 'form-control']) !!}
										@if($errors->has('lastname'))
											<span class="help-block">{{ $errors->first('lastname') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('middle_initial') ? 'has-error' : '' }}">
										<label class="control-label">Middle Initial</label>
										{!! Form::text('middle_initial', $data->userInfo->middle_initial, ['class' => 'form-control']) !!}
										@if($errors->has('middle_initial'))
											<span class="help-block">{{ $errors->first('middle_initial') }}</span>
										@endif
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
										<label class="control-label">Username</label>
                                        {!! Form::text('username', $data->userInfo->username, ['class' => 'form-control']) !!}
										@if($errors->has('username'))
											<span class="help-block">{{ $errors->first('username') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('specialization') ? 'has-error' : '' }}">
										<label class="control-label">Specialization</label>
                                        {!! Form::text('specialization', $data->specialization, ['class' => 'form-control']) !!}
										@if($errors->has('specialization'))
											<span class="help-block">{{ $errors->first('specialization') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('license') ? 'has-error' : '' }}">
										<label class="control-label">License</label>
										{!! Form::text('license', $data->license, ['class' => 'form-control']) !!}
										@if($errors->has('license'))
											<span class="help-block">{{ $errors->first('license') }}</span>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
										<label class="control-label">Contact Number</label>
										{!! Form::text('contact_number', $data->userInfo->contact_number, ['class' => 'form-control']) !!}
										@if($errors->has('contact_number'))
											<span class="help-block">{{ $errors->first('contact_number') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('clinic') ? 'has-error' : '' }}">
										<label class="control-label">Clinic</label>
										{!! Form::text('clinic', $data->clinic, ['class' => 'form-control']) !!}
										@if($errors->has('clinic'))
											<span class="help-block">{{ $errors->first('clinic') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('clinic_address') ? 'has-error' : '' }}">
										<label class="control-label">Clinic Address</label>
										{!! Form::text('clinic_address', $data->clinic_address, ['class' => 'form-control']) !!}
										@if($errors->has('clinic_address'))
											<span class="help-block">{{ $errors->first('clinic_address') }}</span>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('consultation_hours') ? 'has-error' : '' }}">
										<label class="control-label">Consultation hours</label>
										{!! Form::text('consultation_hours', $data->consultation_hours, ['class' => 'form-control']) !!}
										@if($errors->has('consultation_hours'))
											<span class="help-block">{{ $errors->first('consultation_hours') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<label class="control-label">Email</label>
										{!! Form::text('email', $data->userInfo->email, ['class' => 'form-control']) !!}
										@if($errors->has('email'))
											<span class="help-block">{{ $errors->first('email') }}</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
										<label class="control-label">Gender</label>
                                        {!! Form::select('sex', ['FEMALE' => 'Female', 'MALE' => 'Male'], $data->userInfo->sex, ['class' => 'form-control']) !!}
										@if($errors->has('sex'))
											<span class="help-block">{{ $errors->first('sex') }}</span>
										@endif
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('ptrc') ? 'has-error' : '' }}">
										<label class="control-label">PTR #</label>
										{!! Form::text('ptrc', $data->ptrc, ['class' => 'form-control']) !!}
										@if($errors->has('ptrc'))
											<span class="help-block">{{ $errors->first('ptrc') }}</span>
										@endif
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-primary">Update</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection



