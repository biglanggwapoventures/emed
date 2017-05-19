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
                    <a href="{{ route('secretary.index') }}">Secretary List</a>
                </li>
                <li class="breadcrumb-item active">Add Secretary</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                &nbsp;Add Secretary Form
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

                        <form action="{{route ('secretary.store')}}" method=POST>
                            {{ csrf_field() }}

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
                                   <input maxlength="100" name="birthdate" type="date" class="form-control" max="9999-12-31" style="width: 275px" /> @if($errors->has('sex'))
                                    <span class="help-block">{{ $errors->first('birthdate') }}</span> @endif
                                </div>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::bsText('contact_number', 'Contact Number') !!}
                                </div>

                                <div class="col-md-4">
                                    {!! Form::bsText('address', 'Home Address') !!}
                                </div>
                            </div>
                            <h4>Account Information</h4>
                            <hr class="third">
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::bsText('username', 'Username') !!}
                                </div>
                                <div class="col-md-4">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label>Email</label>{{Form::email('email',null,['class' => 'form-control'])}}
                                    @if($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
                                </div>



                            </div>

                            <h4>About</h4>
                            <hr class="third">
                            <div class="row">



                                <div class="col-md-4">
                                    {!! Form::bsText('attainment', 'Educational Attainment') !!}
                                </div>

                                <!-- <div class="col-md-4">
                                <div class="form-group {{ $errors->has('license') ? 'has-error' : '' }}">
                                    <label class="control-label">License</label>
                                    <input type="text" name="license" class="form-control"> @if($errors->has('license'))
                                    <span class="help-block">{{ $errors->first('license') }}</span> @endif
                                </div>
                            </div> -->
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
