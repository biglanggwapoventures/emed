@extends('welcome') @section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Drugstore</h4>
                </div>
                    <div class="panel-body">
                    {!! Form::open(['url' => route ('drugstore.store'), 'method' => 'POST']) !!}

                        <div class="col-md-4">
                            {!! Form::bsText('drugstore', 'Drugstore') !!}
                        </div>

                    <button type="submit" class="btn btn-primary">Add Drugstore</button>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
