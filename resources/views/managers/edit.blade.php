@extends('welcome') @section('body')

<div class="content-wrapper">
    <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url(session('homepage') . '') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('managers.index') }}">Pharmacy Manager List</a>
                </li>
                <li class="breadcrumb-item active">Edit Pharmacy Manager</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                &nbsp;Edit Pharmacy Manager Form
            </span>
        </h1>
    </section>

<!-- 
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->
    <div class="container-fluid"><br><br>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="panel-body">
                        {!! Form::open(['url' => route('managers.update', ['id' => $data->id]), 'method' => 'PUT']) !!} {!! Form::hidden('user_id', $data->userInfo->id) !!}

                        <h4>Personal Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                    <label class="control-label">First Name</label> {!! Form::text('firstname', $data->userInfo->firstname, ['class' => 'form-control']) !!} @if($errors->has('firstname'))
                                    <span class="help-block">{{ $errors->first('firstname') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('middle_initial') ? 'has-error' : '' }}">
                                    <label class="control-label">Middle Initial</label>
                                    <span style="color: red">*</span> {!! Form::text('middle_initial', $data->userInfo->middle_initial, ['class' => 'form-control']) !!} @if($errors->has('middle_initial'))
                                    <span class="help-block">{{ $errors->first('middle_initial') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                    <label class="control-label">Last Name</label>
                                    <span style="color: red">*</span> {!! Form::text('lastname', $data->userInfo->lastname, ['class' => 'form-control']) !!} @if($errors->has('lastname'))
                                    <span class="help-block">{{ $errors->first('lastname') }}<<input type="text" name="lastname" class="form-control"></span> @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::bsSelect('sex', 'Sex', [''  => '', 'Male' => 'Male', 'Female' => 'Female'],$data->userInfo->sex) !!}
                            </div>
                            
                            <div class="col-md-4">
                                {!! Form::bsText('birthdate', 'Birthdate *', $data->userInfo->birthdate, ['class' => 'form-control bsdatepicker']) !!}
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                    <label class="control-label">Contact No.</label> {!! Form::text('contact_number', $data->userInfo->contact_number, ['class' => 'form-control']) !!} @if($errors->has('contact_number'))
                                    <span class="help-block">{{ $errors->first('contact_number') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="control-label">Home Address</label>
                                    <span style="color: red">*</span> {!! Form::text('address', $data->userInfo->address, ['class' => 'form-control']) !!} @if($errors->has('address'))
                                    <span class="help-block">{{ $errors->first('address') }}</span> @endif
                                </div>
                            </div>
                        </div>

                        <h4>Account Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                    <label class="control-label">Username</label> {!! Form::text('username', $data->userInfo->username, ['class' => 'form-control']) !!} @if($errors->has('username'))
                                    <span class="help-block">{{ $errors->first('username') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="control-label">Email</label> {!! Form::text('email', $data->userInfo->email, ['class' => 'form-control']) !!} @if($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
                            </div>
                 
                        @if(Auth::check()) 
                        @if(Auth::user()->user_type === 'PMANAGER')

                        <div class="col-md-4">
                                <div class="form-group {{ $errors->has('license') ? 'has-error' : '' }}">
                                    <label class="control-label">License</label> {!! Form::text('license', $data->license, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('license'))
                                    <span class="help-block">{{ $errors->first('license') }}</span> @endif
                                </div>
                        </div>

                         @elseif(Auth::user()->user_type === 'ADMIN')

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('license') ? 'has-error' : '' }}">
                                    <label class="control-label">License</label> {!! Form::text('license', $data->license, ['class' => 'form-control']) !!} @if($errors->has('license'))
                                    <span class="help-block">{{ $errors->first('license') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif

                       <!--  <h4>Pharmacy Branch</h4>
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
                                    <label class="control-label">Drugstore Branch</label> {!! Form::text('drugstore_branch', $data->drugstore_branch, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('drugstore_branch'))
                                    <span class="help-block">{{ $errors->first('drugstore_branch') }}</span> @endif
                                </div>
                            </div>
                        </div>
               
                        -->
                        <!-- </div> -->
                         @if(Auth::user()->user_type === 'PMANAGER')
                        <h4>Pharmacy Information</h4>
                        <hr class="third">

                        <div class="row">
                       
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore</label> {!! Form::text('drugstore', EMedHelper::retrievePharmacy($data->drugstore)->name,['class' => 'form-control','readonly' => 'true']) !!} 
                                        <input type="hidden" name="drugstore_id" value="{{ $data->drugstore }}">
                                       
                                    @if($errors->has('drugstore'))
                                    <span class="help-block">{{ $errors->first('drugstore') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                 <div class="form-group {{ $errors->has('drugstore_branch') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore Address</label> {!! Form::text('drugstore_branch', EMedHelper::retrievePharmacyBranch($data->drugstore_branch)->name, ['class' => 'form-control','readonly' => 'true']) !!}
                                        <input type="hidden" name="drugstorebranch_id" value="{{ $data->drugstore_branch }}">
                                     @if($errors->has('drugstore_branch'))
                                        }
                                    <span class="help-block">{{ $errors->first('drugstore_branch') }}</span> @endif
                                </div>
                            </div>
                       
                        @else
                        <h4 style="margin-left: 12px;">Pharmacy Information</h4>
                        <hr class="third">
                        
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('drugstore') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore</label> 
                                    {!! Form::text('drugstore_display', EMedHelper::retrievePharmacy($data->drugstore)->name, ['class' => 'form-control','readonly' => 'true']) !!}
                                    <input type="hidden" name="drugstore" value="{{ $data->drugstore }}">@if($errors->has('drugstore'))
                                    <span class="help-block">{{ $errors->first('drugstore') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">

                                 <div class="form-group {{ $errors->has('drugstore_branch') ? 'has-error' : '' }}">
                                    <label class="control-label">Drugstore Address</label> 
                                    {!! Form::text('drugstore_branch_display', EMedHelper::retrievePharmacyBranch($data->drugstore_branch)->name, ['class' => 'form-control','readonly' => 'true']) !!} 
                                    <input type="hidden" name="drugstore_branch" value="{{ $data->drugstore_branch }}">@if($errors->has('drugstore_branch'))
                                    <span class="help-block">{{ $errors->first('drugstore_branch') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        @endif
                      
                            <br>  
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-left">Update</button>
                            </div>
                         {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
