@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pharmacist Form
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Pharmacist</a></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="inside">

                        {!! Form::open(['url' => route ('pharmacists.store'), 'method' => 'POST']) !!}

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
                                <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                                    <label class="control-label">Birthdate <span style="color: red">*</span></label>
                                    <input maxlength="100" name="birthdate" type="date" class="form-control" style="width: 275px" />
                                 @if($errors->has('birthdate'))
                                    <span class="help-block">{{ $errors->first('birthdate') }}</span> @endif
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
                                <label>Email</label>{{Form::email('email',null,['class' => 'form-control'])}}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('license', 'License') !!}
                            </div>


                        </div>

                        <h4>Account Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore</label> {!! Form::text('drugstore', $pman->drugstore, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('drugstore'))
                                    <span class="help-block">{{ $errors->first('drugstore') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore_branch') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore Address</label> {!! Form::text('drugstore_branch', $pman->drugstore_branch, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('drugstore_branch'))
                                    <span class="help-block">{{ $errors->first('drugstore_branch') }}</span> @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
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
