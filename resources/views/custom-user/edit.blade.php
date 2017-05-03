@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url(session('homepage') . '') }}">
                        Home
                    </a>
                </li>
                @if(EMedHelper::hasTargetActionPermission(session('custom_role_type'), "LIST"))
                    <li class="breadcrumb-item">
                        <a href="{{ url('custom-role', session('custom_role_id')) }}">{{ session('custom_role') }} List</a>
                    </li>
                @endif
                    
                <li class="breadcrumb-item active">Edit {{ session('custom_role') }}</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-drupal" style="font-size:135%!important"></span>
                &nbsp;Edit {{ session('custom_role') }}
            </span>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="inside">
                        <img alt="User Pic" src="{{ " /storage/avatars/default.jpg " }}" style="width: 150px; height: 150px;" class="img-circle img-responsive">
                        <input type="file" class="upload" name="avatar"> {!! Form::open(['url' => route('patients.update', ['id' => $data->id]), 'method' => 'PUT']) !!} {!! Form::hidden('user_id', $data->id) !!}

                        <h4>Personal Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                    <label class="control-label">First Name</label>
                                    <span style="color: red">*</span> {!! Form::text('firstname', $data->firstname, ['class' => 'form-control']) !!} @if($errors->has('firstname'))
                                    <span class="help-block">{{ $errors->first('firstname') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('middle_initial') ? 'has-error' : '' }}">
                                    <label class="control-label">Middle Name</label>
                                    <span style="color: red">*</span> {!! Form::text('middle_initial', $data->middle_initial, ['class' => 'form-control']) !!} @if($errors->has('middle_initial'))
                                    <span class="help-block">{{ $errors->first('middle_initial') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                    <label class="control-label">Last Name</label>
                                    <span style="color: red">*</span> {!! Form::text('lastname', $data->lastname, ['class' => 'form-control']) !!} @if($errors->has('lastname'))
                                    <span class="help-block">{{ $errors->first('lastname') }}</span> @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Birthdate <span style="color: red">*</span></label> {!! Form::date('birthdate', $data->birthdate, ['class' => 'form-control'], ['maxlength' => 100]) !!} @if($errors->has('birthdate'))
                                    <span class="help-block">{{ $errors->first('birthdate') }}</span> @endif

                                </div>


                            </div>

                            <div class="col-md-4">
                               <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <label class="control-label">Gender</label>
                                    <span style="color: red">*</span> {!! Form::select('sex', ['Female' => 'Female', 'Male' => 'Male'], $data->sex, ['class' => 'form-control']) !!} @if($errors->has('sex'))
                                    <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                    <label class="control-label">Contact Number</label>
                                    <span style="color: red">*</span> {!! Form::text('contact_number', $data->contact_number, ['class' => 'form-control']) !!} @if($errors->has('contact_number'))
                                    <span class="help-block">{{ $errors->first('contact_number') }}</span> @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="control-label">Home Address</label>
                                    <span style="color: red">*</span> {!! Form::text('address', $data->address, ['class' => 'form-control']) !!} @if($errors->has('address'))
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
                                    <span style="color: red">*</span> {!! Form::text('username', $data->username, ['class' => 'form-control']) !!} @if($errors->has('username'))
                                    <span class="help-block">{{ $errors->first('username') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="control-label">Email Address</label>
                                    <span style="color: red">*</span> {!! Form::text('email', $data->email, ['class' => 'form-control']) !!} @if($errors->has('email'))
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
                    <!-- /.box -->

                </div>

            </div>
            <!--/.col (left) -->

            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<style type="text/css">
    .inside {
        padding: 12px;
    }

</style>

@endsection
