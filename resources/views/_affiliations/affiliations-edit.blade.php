@extends('welcome') @section('body')



<div class="content-wrapper">

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
            @endif {!! Form::open(['url' => route('affiliations.update', ['id' => $data->id]), 'method' => 'PUT']) !!} {!! Form::hidden('id', $data->id) !!}

            <div class="row ">

                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('affiliations') ? 'has-error' : '' }}">
                        {!! Form::text('affiliations', $data->affiliations, ['class' => 'form-control']) !!} @if($errors->has('affiliations'))
                        <span class="help-block">{{ $errors->first('affiliations') }}</span> @endif
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Update</button> {!! Form::close() !!}
        </div>
    </div>

    @endsection
