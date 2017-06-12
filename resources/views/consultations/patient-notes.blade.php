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
     <!--this was made my Agil Asadi. You are free to delete this comment line and use it as you wish-->   

<div class="row col-md-8 col-md-offset-2 registeration">
    
<div class="registerInner">

        <div class="col-md-12 col-md-12 col-xs-12  signUp" >
            <h3 class="headerSign">Consultation Notes</h3>
            <br>
            {!! Form::open(['url' => route('consultations.store', ['patient_id' => request()->input('patient_id')]), 'method' => 'POST']) !!}

                <div class="row">
                            <div class="col-md-6">
                             <label>Weight:</label>
                                    {!! Form::bsText('weight', '',null,['placeholder'=> 'kgs', 'class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-6">
                            <label>Height:</label>
                                     {!! Form::bsText('height','',null,['placeholder'=> 'cm', 'class' => 'form-control']) !!}
                            </div>        
                 </div>
                

                <div class="row">
                            <div class="col-md-6">
                             <label>Bloodpressure:</label>
                                    {!! Form::bsText('bloodpressure', '',null,['placeholder'=> 'mmHg', 'class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-6">
                             <label>Temperature:</label>
                                     {!! Form::bsText('temperature','',null,['placeholder'=> '°C', 'class' => 'form-control']) !!}
                            </div>        
                 </div>
                <div class="row">
                            <div class="col-md-6">
                             <label>Pulse rate:</label>
                                    {!! Form::bsText('pulserate','',null,['placeholder'=> 'bpm', 'class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-6">
                             <label>Respiratory rate:</label>
                                     {!! Form::bsText('resprate','',null,['placeholder'=> 'cpm', 'class' => 'form-control']) !!}
                            </div>        
                 </div>
                
                 <div class="row">
                            <div class="col-md-12">
                            <label>Chief Complaints:</label>
                                    {!! Form::bsText('chiefcomplaints','',null,['placeholder'=> 'complaints', 'class' => 'form-control']) !!}
                            </div>    
                 </div>
                
                <div class="row">
                            <div class="col-md-12">
                            <label>Diagnosis:</label>
                                    {!! Form::bsText('notes', '',null,['placeholder'=> 'results', 'class' => 'form-control']) !!}
                            </div>    
                 </div>
                 <br>

               <button type="submit" class="btn btn-primary">Submit</button> 
                    <a href="{{ route('patients.show', ['id' => request()->input('patient_id')]) }}" class="btn btn-success" id="none">Back</a>
                    {!! Form::close() !!}
                        <br>
        </div>

             
             
       
             
</div>
        
</div>
    <!--/.col (right) -->
</div>
<!-- /.row -->


<style type="text/css">
    *{
    border-radius: 0 !important;
}

html,body{

}

.registeration{
    border-top: 5px solid #2196f3;
    -webkit-box-shadow: 0px 5px 21px -2px rgba(0,0,0,0.47);
    -moz-box-shadow: 0px 5px 21px -2px rgba(0,0,0,0.47);
    box-shadow: 0px 5px 21px -2px rgba(0,0,0,0.47);
    margin-top: 48px;
  background-color: #ffffff;
}

.registerInner{
 margin: 15px;
  background-color: #ffffff;
}




.form-group{
    width: 100%;
    line-height: 50px;   
}

.signbuttons{
    margin-bottom: 35px;
    background: #2196f3;
    border: none;
}

input{
    border-top: none !important;
    border-right: none !important;
    border-left: none !important;
    border-bottom: 1px dotted #2196f3 !important;
    box-shadow: none !important;
    -webkit-box-shadow: none !important;
    -moz-box-shadow: none !important;
    -moz-transition: none !important;
    -webkit-transition: none !important;
}

.headerSign{
    color: #2196f3;
    margin-bottom: 20px;
    text-align: center;
}

.darktext{
    color: #2196f3;
}
.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    /*background-color: #ecf0f5;*/
    background-color: #ffffff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    margin-top: 1px;
}


.col-md-offset-2 {
    margin-left: 20.666667%;
}

.col-md-8 {
    width: 50.666667%;
}

</style>


@endsection
