@extends('welcome') @section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Specialization</h4>
                </div>
                <div class="panel-body">
                {!! Form::open(['url' => route ('specialization.store'), 'method' => 'POST']) !!}
                	<div class="row">
                        <div class="col-md-4">
                            {!! Form::bsText('specialization', 'Specialization') !!}
                        </div>
                    </div>
                 	<button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
                <br>
                {!! Form::open(['url' => route ('sub_specialization.store'), 'method' => 'POST']) !!}
                	<div class="row">
                        <div class="col-md-4">
                            {!! Form::bsText('sub_specialization', 'Sub-specialization') !!}
                        </div>
                    </div>
                 	<button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
@push('scripts')
@endpush
