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
                <li class="breadcrumb-item active">Add Pharmacist</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                &nbsp;Add Pharmacist Form
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
                                {!! Form::bsSelect('sex', 'Sex', [''  => '', 'Male' => 'Male', 'Female' => 'Female']) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::bsText('birthdate', 'Birthdate *', null, ['class' => 'form-control bsdatepicker']) !!}
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
                                <!-- <label>Email</label>{{Form::email('email',null,['class' => 'form-control'])}} -->
                                 {!! Form::bsText('email', 'Email',null,['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('license', 'License') !!}
                            </div>
                           

                        </div>

                        <h4>Pharmacy Information</h4>
                        @php
                            $pharmacy = EMedHelper::retrievePharmacy($pman->drugstore);
                            $pharmacyBranch = EMedHelper::retrievePharmacyBranch($pman->drugstore_branch);
                        @endphp
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Drugstore</label>
                                    <p class="form-control-static">{{ $pharmacy->name }}</p>
                                    {!! Form::hidden('drugstore', $pharmacy->id) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore_branch') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore Address</label>
                                    <p class="form-control-static">{{ $pharmacyBranch->name }}</p>
                                    {!! Form::hidden('drugstore_branch', $pharmacyBranch->id) !!}
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
