@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Profile
            <small></small>
        </h1>

                       

        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('patients.show', ['id' => $data->id]) }}"><i class="fa fa-user"></i> {{ $data->userInfo->fullname() }}'s Profile</a></li>
            <li><a href="#">Edit Patient</a></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">



            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                
                    
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">User Profile</a></li>
              <li><a href="#settings" data-toggle="tab">Medical History</a></li>
              <li><a href="#info" data-toggle="tab">Account Information</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                {!! Form::open(['url' => route('patients.update', ['id' => $data->id]), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!} {!! Form::hidden('user_id', $data->userInfo->id) !!}


                        @if(session('ACTION_RESULT'))
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                                        {{ session('ACTION_RESULT')['message'] }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <img alt="User Pic" src="{{ " /storage/{$data->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive" id="dp">

                       @if(Auth::check()) @if(Auth::user()->user_type != 'PATIENT' )
                        <input type="file" onchange="readURL(this)" class="upload" name="avatar">
                        @endif
                     @endif
                <h4>Personal Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                    <label class="control-label">First Name</label>
                                    <span style="color: red">*</span> {!! Form::text('firstname', $data->userInfo->firstname, ['class' => 'form-control']) !!} @if($errors->has('firstname'))
                                    <span class="help-block">{{ $errors->first('firstname') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('middle_initial') ? 'has-error' : '' }}">
                                    <label class="control-label">Middle Name</label>
                                    <span style="color: red">*</span> {!! Form::text('middle_initial', $data->userInfo->middle_initial, ['class' => 'form-control']) !!} @if($errors->has('middle_initial'))
                                    <span class="help-block">{{ $errors->first('middle_initial') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                    <label class="control-label">Last Name</label>
                                    <span style="color: red">*</span> {!! Form::text('lastname', $data->userInfo->lastname, ['class' => 'form-control']) !!} @if($errors->has('lastname'))
                                    <span class="help-block">{{ $errors->first('lastname') }}</span> @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                               {!! Form::bsText('birthdate', 'Birthdate *', $data->userInfo->birthdate, ['class' => 'form-control bsdatepicker']) !!}
                            </div>

                            <div class="col-md-4">
                               {!! Form::bsSelect('sex', 'Sex', [''  => '', 'Male' => 'Male', 'Female' => 'Female'],$data->userInfo->sex) !!}
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                    <label class="control-label">Contact Number</label>
                                    <span style="color: red">*</span> {!! Form::text('contact_number', $data->userInfo->contact_number, ['class' => 'form-control']) !!} @if($errors->has('contact_number'))
                                    <span class="help-block">{{ $errors->first('contact_number') }}</span> @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="control-label">Home Address</label>
                                    <span style="color: red">*</span> {!! Form::text('address', $data->userInfo->address, ['class' => 'form-control']) !!} @if($errors->has('address'))
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
                       
                          
              </div>
              <!-- /.tab-pane -->
              
              <div class="tab-pane" id="info">
                 <h4>Account Information</h4>
                        <hr class="third">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                    <label class="control-label">Username</label>
                                    <span style="color: red">*</span> {!! Form::text('username', $data->userInfo->username, ['class' => 'form-control']) !!} @if($errors->has('username'))
                                    <span class="help-block">{{ $errors->first('username') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="control-label">Email Address</label>
                                    <span style="color: red">*</span> {!! Form::text('email', $data->userInfo->email, ['class' => 'form-control']) !!} @if($errors->has('email'))
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
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <h4>Medical Profile</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('allergy_question') ? 'has-error' : '' }}">
                                    Do you have allergies? 
                                    @if($data->allergyquestion==='Y')
                                        {{ Form::radio('allergyquestion', 'Y', true) }} Yes {{ Form::radio('allergyquestion', 'N',false) }} No 
                                    @else
                                        {{ Form::radio('allergyquestion', 'Y', false) }} Yes {{ Form::radio('allergyquestion', 'N', true) }} No 
                                    @endif
                                    @if($errors->has('allergyquestion'))
                                    <span class="help-block">{{ $errors->first('allergyquestion') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('allergyname') ? 'has-error' : '' }}">
                                    <label class="control-label">If yes, what?</label>
                                    <span style="color: red">*</span>
                                    @if($data->allergyquestion==='N')
                                        {!! Form::text('allergyname', NULL, ['class' => 'form-control']) !!} 
                                    @else
                                        {!! Form::text('allergyname', $data->allergyname, ['class' => 'form-control']) !!} 
                                    @endif
                                    @if($errors->has('allergyname'))
                                    <span class="help-block">{{ $errors->first('allergyname') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('past_disease') ? 'has-error' : '' }}">
                                    <label class="control-label">Disease History</label>
                                    <span style="color: red">*</span> {!! Form::text('past_disease', $data->past_disease, ['class' => 'form-control']) !!} @if($errors->has('past_disease'))
                                    <span class="help-block">{{ $errors->first('past_disease') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('past_surgery') ? 'has-error' : '' }}">
                                    <label class="control-label">Surgery History</label>
                                    <span style="color: red">*</span> {!! Form::text('past_surgery', $data->past_surgery, ['class' => 'form-control']) !!} @if($errors->has('past_surgery'))
                                    <span class="help-block">{{ $errors->first('past_surgery') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('immunization') ? 'has-error' : '' }}">
                                    <label class="control-label">Immunizations</label>
                                    <span style="color: red">*</span> {!! Form::text('immunization', $data->immunization, ['class' => 'form-control']) !!} @if($errors->has('immunization'))
                                    <span class="help-block">{{ $errors->first('immunization') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('family_history') ? 'has-error' : '' }}">
                                    <label class="control-label">Family History</label>
                                    <span style="color: red">*</span> {!! Form::text('family_history', $data->family_history, ['class' => 'form-control']) !!} @if($errors->has('family_history'))
                                    <span class="help-block">{{ $errors->first('family_history') }}</span> @endif
                                </div>
                            </div>
                        </div>
                   
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

                            <button type="submit" class="btn btn-primary"  style="margin-right: 10px;">Update</button> {!! Form::close() !!}
                                <a href="{{ route('patients.show', ['id' => $data->id]) }}" class="btn btn-warning">Cancel</a>
          <!-- /.nav-tabs-custom -->
        </div>

                
  <!--/.col (right) -->
               <div class="col-md-3 ">

          <!-- Profile Image --><!-- 
          <div class="box box-primary" style="height: 170px">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center">Edit Profile</h3>

             <a href="#activity" data-toggle="tab"><i class="fa fa-stethoscope "></i>&nbsp &nbspUser Profile </a><br>
              <a href="#settings" data-toggle="tab"><i class="fa fa-hospital-o "></i> &nbsp  &nbspMedical History</a><br>
              <a href="#info" data-toggle="tab"><i class="fa fa-sitemap "></i>&nbsp  &nbspAccount Information </a>

            </div>
            <center><button type="submit" class="btn btn-primary"  style="margin-right: 10px;">Update</button> {!! Form::close() !!}
            <a href="{{ route('patients.show', ['id' => $data->id]) }}" class="btn btn-success">Patient's Profile</a></center>
          </div> -->
        </div>
            </div>
            <!--/.col (left) -->

          
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<style type="text/css">
    .inside {
        padding: 12px;
    }
    .nav-tabs-custom {
    margin-bottom: 20px;
    background: #fff;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 3px;
    margin-top: 11px;
}
.col-md-3 {
    width: 25%;
    margin-top: 12px;
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
