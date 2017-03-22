@extends('welcome') @section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Medical Notes</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => route('consultations.store', ['patient_id' => request()->input('patient_id')]), 'method' => 'POST']) !!}
                    <h4>Vitals</h4>
                    <hr class="third">

                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::bsText('weight', 'Weight',null,['placeholder'=> 'kgs']) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('height', 'Height',null,['placeholder'=> 'cm']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('bloodpressure', 'Blood Pressure',null,['placeholder'=> 'mmHg']) !!}
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            {!! Form::bsText('temperature', 'Temeperature',null,['placeholder'=> '°C']) !!}
                        </div>

                    </div>
                    <h4>Stuff</h4>
                    <hr class="third">

                    <div class="row">

                        <div class="col-md-4">
                            {!! Form::bsText('pulserate', 'Pulse Rate',null,['placeholder'=> 'BPM']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('resprate', 'Respiratory Rate',null,['placeholder'=> 'CPM']) !!}
                        </div>

                    </div>



                    <!-- trainging -->



                    <h4>Consultation</h4>
                    <hr class="third">
                    <div class="row">

                        <div class="col-md-8">
                            {!! Form::bsText('chiefcomplaints', 'Chief Complaints') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <strong>Notes:</strong> {{ Form::textarea('notes', null, ['size' => '80x7'])}}
                        </div>


                    </div>

                </div>
                <!-- end sa panelbody -->
                &nbsp &nbsp
                <button type="submit" class="btn btn-primary">Submit</button> {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
</div>





@endsection
