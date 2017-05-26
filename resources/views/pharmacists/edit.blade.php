@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url(session('homepage') . '') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('pharmacists.index') }}">Pharmacist List</a>
                </li>
                <li class="breadcrumb-item active">Edit Pharmacist</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                &nbsp;Edit Pharmacist Form
            </span>
        </h1>
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

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="inside">
                    {!! Form::open(['url' => route('pharmacists.update', ['id' => $data->id]), 'method' => 'PUT']) !!}
                        {!! Form::hidden('user_id', $data->userInfo->id) !!}

                        <h4>Personal Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::bsText('firstname', 'Firstname', $data->userInfo->firstname) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::bsText('middle_initial', 'Middle Initial', $data->userInfo->middle_initial) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('lastname', 'Lastname', $data->userInfo->lastname) !!}
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <label class="control-label">Gender</label>
                                    <label for="sel1">Select list:</label>
                                    <span style="color: red">*</span>
                                        {!! Form::select('sex', ['Female' => 'Female', 'Male' => 'Male'], $data->userInfo->sex, ['class' => 'form-control']) !!}
                                    @if($errors->has('sex'))
                                    <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Birthdate <span style="color: red">*</span></label>
                                   <input maxlength="100" name="birthdate" type="date" class="form-control" max="9999-12-31" style="width: 275px" value="{{ $data->userInfo->birthdate }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('contact_number', 'Contact Number', $data->userInfo->contact_number) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::bsText('address', 'Address', $data->userInfo->address) !!}
                            </div>
                        </div>
                        <h4>Account Information</h4>
                        <hr class="third">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore</label> {!! Form::text('drugstore', $data->drugstore, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('drugstore'))
                                    <span class="help-block">{{ $errors->first('drugstore') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore_branch') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore Address</label> {!! Form::text('drugstore_branch', $data->drugstore_branch, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('drugstore_branch'))
                                    <span class="help-block">{{ $errors->first('drugstore_branch') }}</span> @endif
                                </div>
                            </div>

                              <div class="col-md-4">
                               
                                    {!! Form::bsText('license', 'License', $data->license, ['class' => 'form-control','readonly' => 'true']) !!}  
                               
                            </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    {!! Form::bsText('username', 'Username', $data->userInfo->username) !!}
                                 </div>
                            <div class="col-md-4">
                                    {!! Form::bsText('email', 'Email', $data->userInfo->email) !!}
                            </div>

                            </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        {!! Form::close() !!}
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
