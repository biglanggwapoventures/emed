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
                        {!! Form::open(['url' => route('consultations.update', ['id' => $consultation->id]), 'method' => 'PUT']) !!}
                        {!! Form::hidden('patient_id', $consultation->patient->id) !!}
                        {!! Form::hidden('doctor_id', $consultation->doctor->id) !!}

                        <h4>Vitals</h4>
                        <hr class="third">

                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::bsText('weight', 'Weight', $consultation->weight) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::bsText('height', 'Height', $consultation->height) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('bloodpressure', 'Blood Pressure', $consultation->bloodpressure) !!}
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                {!! Form::bsText('temperature', 'Temeperature', $consultation->temperature) !!}
                            </div>

                        </div>
                        <h4>Stuff</h4>
                        <hr class="third">

                        <div class="row">

                            <div class="col-md-4">
                                {!! Form::bsText('pulserate', 'Pulse Rate', $consultation->pulserate) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('resprate', 'Respiratory Rate', $consultation->resprate) !!}
                            </div>

                        </div>



                        <!-- trainging -->



                        <h4>Consultation</h4>
                        <hr class="third">
                        <div class="row">

                            <div class="col-md-8">
                                {!! Form::bsText('chiefcomplaints', 'Chief Complaints', $consultation->chiefcomplaints) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <strong>Diagnosis:</strong> <br>{{ Form::textarea('notes', $consultation->notes)}}
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-8">
                                <strong>Reason for Update:</strong> <br>
                                <input class="form-control" type="text" name="updatereason" required="">
                            </div>
                        </div>

                    </div>
                    <!-- end sa panelbody -->
                    &nbsp; &nbsp;
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ url("/patients/$consultation->patient_id") }}" class="btn btn-success" id="none">Back</a>
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
