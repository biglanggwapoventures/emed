@extends('welcome') @section('body')

<div class="container-fluid ">
    <div class="row-bod ">
        <div class="col-md-6  ">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Medical Notes</h4>
                </div>
                <div class="panel-body ">
                    @if(count($errors->all()))
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() AS $err)
                            <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif {!! Form::open(['url' => route('prescription.store'), 'method' => 'POST']) !!} {!! Form::hidden('patient_id', request()->input('patient_id')) !!} {!! Form::hidden('consultation_id', request()->input('consultation_id')) !!}
                    <div class="row ">
                        <div class="col-md-2 ">
                            <img alt="User Pic" src="{{ " /images/rx.png " }}" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-10">
                            <div class="row col-md-offset-1 ">
                                <div class="col-md-10 ">
                                    {!! Form::bsText('genericname', 'Generic Name', null) !!}
                                </div>
                            </div>
                            <div class="row col-md-offset-1 ">
                                <div class="col-md-10">
                                    {!! Form::bsText('brand', 'Brand Name') !!}
                                </div>
                            </div>
                            <div class="row col-md-offset-1 ">
                                <div class="col-md-5">
                                    {!! Form::bsText('quantity', 'Quantity', null) !!}
                                </div>
                                <div class="col-md-5  ">
                                    {!! Form::bsText('dosage', 'Dosage', null) !!}
                                </div>
                            </div>
                            <div class="row col-md-offset-1 ">
                                <div class="col-md-10 ">
                                    {!! Form::bsText('frequency', 'Frequency', null) !!}
                                </div>
                            </div>
                            <div class="row col-md-offset-1 ">
                                <div class="col-md-5 ">
                                    {!! Form::bsDate('start', 'Start Date', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-md-5">
                                    {!! Form::bsDate('end', 'End Date', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of panelbody -->
                <button type="submit" class="btn btn-primary">Add</button> {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-6  ">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Prescriptions</h4>
                </div>
                Weeds<br> Flintsones
                <br> Adderall
                <br>
                <div class="panel-body  ">
                    {!! Form::open(['url' => route('consultations.store', ['patient_id' => request()->input('patient_id')]), 'method' => 'POST']) !!}
                </div>
                <!-- end of panelbody -->
                <button type="submit" class="btn btn-primary">View All prescription history</button> {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .row-bod {
        margin-right: -15px;
        margin-left: -85px;
        margin-top: 7%;
    }

</style>
@endsection
