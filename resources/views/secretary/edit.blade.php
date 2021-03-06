@extends('welcome') @section('body')
<div class="content-wrapper">

    <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url(session('homepage') . '') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('secretary.index') }}">Secretary List</a>
                </li>
                <li class="breadcrumb-item active">Edit Secretary</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                &nbsp;Edit Secretary Form
            </span>
        </h1>
    </section>

                      
    <div class="container-fluid">
        <div class="row-bod">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Update Secretary</h4>
                    </div>
                    <div class="panel-body">


                        @if(session('ACTION_RESULT'))
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                                        {{ session('ACTION_RESULT')['message'] }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        {!! Form::open(['url' => route('secretary.update', ['id' => $data->id]), 'method' => 'PUT']) !!} {!! Form::hidden('user_id', $data->userInfo->id) !!} {{ csrf_field() }}


                        <h4>Personal Information</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                    <label class="control-label">First Name</label> <span style="color: red">*</span> {!! Form::text('firstname', $data->userInfo->firstname, ['class' => 'form-control']) !!} @if($errors->has('firstname'))
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
                                    <span class="help-block">{{ $errors->first('lastname') }}</span> @endif
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
                                    <label class="control-label">Username</label><span style="color: red">*</span>  {!! Form::text('username', $data->userInfo->username, ['class' => 'form-control']) !!} @if($errors->has('username'))
                                    <span class="help-block">{{ $errors->first('username') }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="control-label">Email</label><span style="color: red">*</span>  {!! Form::text('email', $data->userInfo->email, ['class' => 'form-control']) !!} @if($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
                            </div>
                        </div>

                        <h4>About</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('attainment') ? 'has-error' : '' }}">
                                    <label class="control-label">Educational Attainment</label> {!! Form::text('attainment', $data->attainment, ['class' => 'form-control']) !!} @if($errors->has('attainment'))
                                    <span class="help-block">{{ $errors->first('attainment') }}</span> @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button> {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);
</script>

<style type="text/css">
    .alert {
    position:absolute;
    z-index:1;
    margin-bottom: : 30px;
    width: 500px;

}
</style>


@endsection
