@extends('welcome') @section('body')



<div class="content-wrapper">
<section class="content-header">
        <h1>
           Manage Organization 
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('organizations.index')}}">Organizations</a></li>
            <li><a href="{{ route( 'organizations.create')}} ">Manage Organization</a></li>

        </ol>
    </section>

    <div class="container-fluid">

        <div class="form" style=" margin-top: 62px;">
            @if(session('ACTION_RESULT'))
            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center">
                        {{ session('ACTION_RESULT')['message'] }}
                    </div>
                </div>
            </div>
            @endif {!! Form::open(['url' => route('organizations.update', ['id' => $data->id]), 'method' => 'PUT']) !!} {!! Form::hidden('id', $data->id) !!}

            <div class="row ">

                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('organizations') ? 'has-error' : '' }}">
                        {!! Form::text('organizations', $data->organizations, ['class' => 'form-control']) !!} @if($errors->has('organizations'))
                        <span class="help-block">{{ $errors->first('organizations') }}</span> @endif
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Update</button> {!! Form::close() !!}
        </div>
    </div>

<style type="text/css">
    .alert {
    position:absolute;
    z-index:1;
    margin-bottom: : 30px;
    width: 500px;
}
</style>
    @endsection
