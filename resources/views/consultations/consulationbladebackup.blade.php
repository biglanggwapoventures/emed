@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Consultation Form
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/doctor-home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Consultation</a></li>

        </ol>
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
                                <strong>Diagnosis:</strong> <br>{{ Form::textarea('notes','', ['placeholder'=> 'Notes'])}}
                            </div>


                        </div>

                    </div>
                    <!-- end sa panelbody -->
                    &nbsp &nbsp
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <a href="{{ route('patients.show', ['id' => request()->input('patient_id')]) }}" class="btn btn-success" id="none">Back</a>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>



        <!--/.col (left) -->
    </section>
    <!--/.col (right) -->
</div>
<!-- /.row -->


<style type="text/css">
    .inside {
        padding: 12px;
    }
    
    textarea {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        width: 100%;
    }

</style>


@endsection
