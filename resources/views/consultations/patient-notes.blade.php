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
						<form action="{{route ('doctors.store')}}" method=POST>
							{{ csrf_field() }}
							<h4>Vitals</h4>
							<hr class="third">
							
							<div class="row">
							  <div class="col-md-4">
									<div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
										<label class="control-label">Weight</label>
										<span style="color: red">*</span>

										<input type="text" name="weight" class="form-control">
										@if($errors->has('weight'))
											<span class="help-block">{{ $errors->first('weight') }}</span>
										@endif
									</div>
								</div>
								
                                 <div class="col-md-4">
									<div class="form-group {{ $errors->has('height') ? 'has-error' : '' }}">
										<label class="control-label">Height</label>
										<span style="color: red">*</span>

										<input type="text" name="height" class="form-control">
										@if($errors->has('height'))
											<span class="help-block">{{ $errors->first('height') }}</span>
										@endif
									</div>
								</div>
									<div class="col-md-4">
									<div class="form-group {{ $errors->has('bloodpressure') ? 'has-error' : '' }}">
										<label class="control-label">Bloodpressure</label>
										<span style="color: red">*</span>

										<input type="text" name="bloodpressure" class="form-control">
										@if($errors->has('bloodpressure'))
											<span class="help-block">{{ $errors->first('bloodpressure') }}</span>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('temperature') ? 'has-error' : '' }}">
										<label class="control-label"> Temperature</label>
										<span style="color: red">*</span>
										<input type="text" name="temperature" class="form-control">
										@if($errors->has('temperature'))
											<span class="help-block">{{ $errors->first('temperaturee') }}</span>
										@endif
									</div>
								</div>

							</div>
							<h4>Stuff</h4>
							<hr class="third">
							
							<div class="row">

								<div class="col-md-4">
									<div class="form-group {{ $errors->has('pulserate') ? 'has-error' : '' }}">
										<label class="control-label">Pulserate</label>
										<span style="color: red">*</span>
										<input type="text" name="pulserate" class="form-control">
										@if($errors->has('pulserate'))
											<span class="help-block">{{ $errors->first('pulserate') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('resprate') ? 'has-error' : '' }}">
										<label class="control-label">Respiratory Rate</label>
										<span style="color: red">*</span>
										<input type="text" name="resprate" class="form-control">
										@if($errors->has('resprate'))
											<span class="help-block">{{ $errors->first('resprate') }}</span>
										@endif
									</div>
								</div>
								</div>
								
								<div class="row">

								<div class="col-md-4">
									<div class="form-group {{ $errors->has('patientnote') ? 'has-error' : '' }}">
										<label class="control-label">patientnote</label>
										<span style="color: red">*</span>
										<input type="text" name="patientnote" class="form-control">
										@if($errors->has('patientnote'))
											<span class="help-block">{{ $errors->first('patientnote') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('allergyname') ? 'has-error' : '' }}">
										<label class="control-label">allergyname</label>
										<span style="color: red">*</span>
										<input type="text" name="allergyname" class="form-control">
										@if($errors->has('allergyname'))
											<span class="help-block">{{ $errors->first('allergyname') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('allergyquestion') ? 'has-error' : '' }}">
										<label class="control-label">allergyquestion</label>
										<input type="text" name="allergyquestion" class="form-control">
										@if($errors->has('allergyquestion'))
											<span class="help-block">{{ $errors->first('allergyquestion') }}</span>
										@endif
									</div>
								</div>
							</div>

						
							<h4>Consultation</h4>
							<hr class="third">
							<div class="row">
							<div class="col-md-4">
									<div class="form-group {{ $errors->has('pastsakit') ? 'has-error' : '' }}">
										<label class="control-label">pastsakit</label>
										<span style="color: red">*</span>
										<input type="text" name="pastsakit" class="form-control">
										@if($errors->has('pastsakit'))
											<span class="help-block">{{ $errors->first('pastsakit') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('immunization') ? 'has-error' : '' }}">
										<label class="control-label">immunization</label>
										<input type="text" name="immunization" class="form-control">
										@if($errors->has('immunization'))
											<span class="help-block">{{ $errors->first('immunization') }}</span>
										@endif
									</div>
								</div>
							
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('surgeryprocedure') ? 'has-error' : '' }}">
										<label class="control-label">surgeryprocedure</label>
										<input type="text" name="surgeryprocedure" class="form-control">

										@if($errors->has('surgeryprocedure'))
											<span class="help-block">{{ $errors->first('surgeryprocedure') }}</span>
										@endif
									</div>
								</div>
							</div>
<!-- trainging -->



                 <h4>Others</h4>
                    <hr class="third">
                    <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label">notes</label>
                            <input  maxlength="100" type="text" name="notes"  class="form-control"/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">chiefcomplaints</label>
                            <input  maxlength="100" type="text" name="chiefcomplaints"  class="form-control"/>
                        </div>
                    </div>
                </div>
              

                <div class="row">
                
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label">medications</label>
                            <input  maxlength="100" type="text" name="medications"  class="form-control"/>
                        </div>
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












