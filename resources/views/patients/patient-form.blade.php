@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Patient Form
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Patient</a></li>

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

                        <!-- /.box-header -->
                        <!-- form start -->
                        @if($errors->has('avatar'))
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                              
                                <li>{{ $errors->first('avatar') }}</li>
                            </ul>
                        </div>
                        @endif {!! Form::open(['url' => route ('patients.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        <img alt="User Pic" src="{{ "/storage/avatars/default.jpg " }}" style="width: 150px; height: 150px;" class="img-circle img-responsive" id="dp">
                        <input type="file" onchange="readURL(this)" class="upload" name="avatar" />

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
                                <div class="form-group">
                                    <label class="control-label">Birthdate</label>
                                    <!-- <span style="color: red">*</span> -->
                                    <input maxlength="100" name="birthdate" type="date" class="form-control" style="width: 275px" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <label class="control-label">Gender</label>
                                    <!-- <span style="color: red">*</span> -->
                                    <select class="form-control" name="sex">
                                        <option value="" selected disabled>Select</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select> @if($errors->has('sex'))
                                    <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('contact_number', 'Contact Number') !!}
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                {!! Form::bsText('address', 'Home Address') !!}
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('civilstatus') ? 'has-error' : '' }}">
                                    <label class="control-label">Civil Status</label>
                                    <!-- <span style="color: red">*</span> -->
                                    <select class="form-control" name="civilstatus">
                                        <option value="" selected disabled>Select</option>
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
                                    <label class="control-label">Bloodtype</label>
                                    <!-- <span style="color: red">*</span> -->
                                    <select class="form-control" name="bloodtype">
                                        <option value="" selected disabled>Select</option>
                                            <option>A+</option>
                                            <option>A-</option>
                                            <option>B+</option>
                                            <option>B-</option>
                                            <option>AB+</option>
                                            <option>A-</option>
                                            <option>O+</option>
                                            <option>O-</option>
                                            <option>Unknown</option>
                                        </select> @if($errors->has('bloodtype'))
                                    <span class="help-block">{{ $errors->first('bloodtype') }}</span> @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::bsText('nationality', 'Nationality') !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('occupation', 'Occupation') !!}
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
                        </div>
                        <h4>Emergency Contact</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::bsText('econtact', 'Emergency Contact') !!}
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('erelationship') ? 'has-error' : '' }}">
                                    <label class="control-label">Relationship</label>
                                    <!-- <span style="color: red">*</span> -->
                                    <select class="form-control" name="erelationship">
                                            <option>Mother</option>
                                            <option>Father</option>
                                            <option>Sister</option>
                                            <option>Brother</option>
                                            <option>Cousin</option>
                                            <option>Guardian</option>
                                            <option>Spouse</option>
                                            <option>Others</option>
                                        </select> @if($errors->has('erelationship'))
                                    <span class="help-block">{{ $errors->first('erelationship') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('enumber', 'Contact Number') !!}
                            </div>
                        </div>
                        <h4>RFID</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::bsText('uid', 'RFID UID', null, ['readonly' => 'readonly', 'id' => 'rfid-uid']) !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
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

<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#dp').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

@endsection
