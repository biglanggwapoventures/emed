@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secretary Form
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Secretary</a></li>

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

                        <form action="{{route ('secretary.store')}}" method=POST>
                            {{ csrf_field() }}

                            <h4>Personal Information</h4>
                            <hr class="third">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                        <label class="control-label">First Name</label>
                                        <input type="text" name="firstname" class="form-control"> @if($errors->has('firstname'))
                                        <span class="help-block">{{ $errors->first('firstname') }}</span> @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('middle_initial') ? 'has-error' : '' }}">
                                        <label class="control-label">Middle Initial</label>
                                        <span style="color: red">*</span>
                                        <input type="text" name="middle_initial" class="form-control"> @if($errors->has('middle_initial'))
                                        <span class="help-block">{{ $errors->first('middle_initial') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                        <label class="control-label">Last Name</label>
                                        <span style="color: red">*</span>
                                        <input type="text" name="lastname" class="form-control"> @if($errors->has('lastname'))
                                        <span class="help-block">{{ $errors->first('lastname') }}</span> @endif
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
                                        <input maxlength="100" name="birthdate" type="date" max="9999-12-31" class="form-control" style="width: 275px" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                        <label class="control-label">Contact No.</label>
                                        <input type="text" name="contact_number" class="form-control"> @if($errors->has('contact_number'))
                                        <span class="help-block">{{ $errors->first('contact_number') }}</span> @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                        <label class="control-label">Home Address</label>
                                        <span style="color: red">*</span>
                                        <input type="text" name="address" class="form-control"> @if($errors->has('address'))
                                        <span class="help-block">{{ $errors->first('address') }}</span> @endif
                                    </div>
                                </div>
                            </div>
                            <h4>Account Information</h4>
                            <hr class="third">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control"> @if($errors->has('username'))
                                        <span class="help-block">{{ $errors->first('username') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label class="control-label">Email</label>
                                        <input type="text" name="email" class="form-control"> @if($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                    </div>
                                </div>



                            </div>

                            <h4>About</h4>
                            <hr class="third">
                            <div class="row">



                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('attainment') ? 'has-error' : '' }}">
                                        <label class="control-label">Attainment</label>
                                        <input type="text" name="attainment" class="form-control"> @if($errors->has('attainment'))
                                        <span class="help-block">{{ $errors->first('attainment') }}</span> @endif
                                    </div>
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
