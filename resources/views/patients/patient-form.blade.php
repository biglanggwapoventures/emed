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
                    <a href="{{ route('patients.index') }}">Patient List</a>
                </li>
                <li class="breadcrumb-item active">Add Patient</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                &nbsp;Add Patient Form
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

                        <!-- /.box-header -->
                        <!-- form start -->
                        @if($errors->has('avatar'))
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                              
                                <li>{{ $errors->first('avatar') }}</li>
                            </ul>
                        </div>
                        @endif 
                       <!-- test -->

                        {!! Form::open(['url' => route ('patients.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                      <!--  <div class="booth" style="width: 150px; background-color: #ccc; border: 10px solid #ddd; margin: 0 auto;"> -->
                           
                           <img id="photo" src="{{ "/storage/avatars/default.jpg " }}" alt="photo avatar"  style="width: 150px; height: 150px;" class="img-circle img-responsive" >
                           <input type="file" onchange="readURL(this)" class="upload" name="avatar" accept="photo" />
                          <!--  <button type="button" class="btn btn-warning btn-default-sm" style ="margin-top: 5px;" data-toggle="modal" data-target="#history">
                           <span class="glyphicon glyphicon-camera"></span>  Capture From Camera
                                                </button> -->

                      <!--  </div> -->

                       <!--  <div class="modal fade" id="history" tabindex="-1" role="basic" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content" style="padding:20px 35px 20px 40px;">
                                            <div class="modal-body">
                                                
                                                <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                                                    Capture Image  
                                                </h3>

                                                <hr style="margin-top:-5px;margin-bottom:5px;"/>

                                                <div class="row">
                                                <div class="box-body table-responsive no-padding">
                                                       <video id="video" width="150" height="150"></video>
                                                       <a href="#" id="capture" class="btn btn-primary"> take photo</a>
                                                       <canvas id="canvas" width="150" height="150"></canvas>
                                                       <img id="photo" src="{{ "/storage/avatars/default.jpg " }}" alt="photo avatar"  style="width: 150px; height: 150px;" class="img-circle img-responsive" >
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top:10px;">
                                                    <div class="col-md-12">
                                                        <button style="width:140px;margin-left:5px;" type="button" class="btn btn-primary grey pull-right" data-dismiss="modal">
                                                            Close 
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                         </div> -->
                       <!-- test -->

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
                                {!! Form::bsText('birthdate', 'Birthdate *', null, ['class' => 'form-control bsdatepicker']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsSelect('sex', 'Sex', [''  => '', 'Male' => 'Male', 'Female' => 'Female']) !!}
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
                                            <option>A</option>
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
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label>Email</label>{{Form::email('email',null,['class' => 'form-control'])}}
                                    @if($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
                               
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
                                        <option value="" selected disabled>Select</option>
                                        <option>Mother</option>
                                        <option>Father</option>
                                        <option>Sister</option>
                                        <option>Brother</option>
                                         <option>Child</option>
                                        <option>Cousin</option>
                                        <option>Guardian</option>
                                        <option>Spouse</option>
                                        <option>Others</option>
                                    </select> 
                                    @if($errors->has('erelationship'))
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
                                {!! Form::bsText('uid', 'RFID UID', $predefinedUId, ['readonly' => 'readonly', 'id' => 'rfid-uid']) !!}
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
    
    #canvas {
        display: none;
    }
</style>

<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

@endsection
