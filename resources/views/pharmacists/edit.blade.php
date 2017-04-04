@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">edit Manager</a></li>

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
                                   {!! Form::date('birthdate', $data->userInfo->birthdate, ['class' => 'form-control'], ['maxlength' => 100]) !!}
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
                                
                            </div>

                            <div class="col-md-4">
                              
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
