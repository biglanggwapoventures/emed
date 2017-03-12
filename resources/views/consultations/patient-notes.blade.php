@extends('welcome')

@section('body')

 <div class="container-fluid">
    	<div class="row-bod">
    		<div class="col-md-9 col-md-offset-1">
    			<div class="panel panel-default"> 
			    	<div class="panel-heading">
			    		<h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Medical Notes</h4>
			    	</div>
					<div class="panel-body">
						{!! Form::open(['url' => route ('consultations.store'), 'method' => 'POST']) !!}
							<h4>Vitals</h4>
							<hr class="third">
							
							<div class="row">
							  <div class="col-md-4">
							  		{!! Form::bsText('weight', 'Weight') !!}
								</div>
								
                                 <div class="col-md-4">
									{!! Form::bsText('weight', 'Height') !!}
								</div>
								 <div class="col-md-4">
									{!! Form::bsText('bloodpressure', 'Bloodpressure') !!}
								</div>
							</div>

							<div class="row">
								
								<div class="col-md-6">
									{!! Form::bsText('temperature', 'Temeprature') !!}
								</div>

							</div>
							<h4>Stuff</h4>
							<hr class="third">
							
							<div class="row">

								<div class="col-md-4">
									{!! Form::bsText('pulserate', 'Pulserate') !!}
								</div>
								<div class="col-md-4">
									{!! Form::bsText('resprate', 'Respiratory rate') !!}
								</div>
								</div>
								
								<div class="row">

								<div class="col-md-4">
									{!! Form::bsText('patientnote', 'Patient Note') !!}
								</div>
								<div class="col-md-4">
									{!! Form::bsText('allergyname', 'Allergyname') !!}
								</div>
								<div class="col-md-4">
									{!! Form::bsText('allergyquestion', 'Do you have allergies?') !!}
								</div>
							</div>

						
							<h4>Consultation</h4>
							<hr class="third">
							<div class="row">
							<div class="col-md-4">
									{!! Form::bsText('pastsakit', 'Past disease') !!}
								</div>
								<div class="col-md-4">
									{!! Form::bsText('immunization', 'Immunizations') !!}
								</div>
							
								<div class="col-md-4">
									{!! Form::bsText('surgeryprocedure', 'Surgeries or Procedures') !!}
								</div>
							</div>
<!-- trainging -->



                 <h4>Others</h4>
                    <hr class="third">
                    <div class="row">
                    <div class="col-md-8">
                       {!! Form::bsText('notes', 'Notes') !!}
                    </div>

                    <div class="col-md-4">
                        {!! Form::bsText('chiefcomplaints', 'Chief Complaints') !!}
                    </div>
                </div>
              

                <div class="row">
                
                    <div class="col-md-8">
                        {!! Form::bsText('medications', 'Medications') !!}
                    </div>

                   
        

							</div> <!-- end sa panelbody -->
							
							<button type="submit" class="btn btn-primary">Register</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

 



@endsection












