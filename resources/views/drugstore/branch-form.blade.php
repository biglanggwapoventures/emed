@extends('welcome') @section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Drugstore Branch</h4>
                </div>
                    <div class="panel-body">

                        <div class="col-md-4">
                            {!! Form::bsText('branch', 'Drugstore Branch') !!}
                        </div>

                    <button type="submit" class="btn btn-primary">Add Drugstore Branch</button>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection