@extends('welcome')

@section('body')

 <div class="container-fluid ">
 
    	<div class="row-bod ">

    <!-- 	if(Auth() == 'DOCTOR') -->
    		<div class="col-md-6  ">
    			<div class="panel panel-primary "> 
			    	<div class="panel-heading">
			    		<h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Medical Notes</h4>
			    	</div>
					<div class="panel-body  ">
						{!! Form::open(['url' => route('consultations.store', ['patient_id' => request()->input('patient_id')]), 'method' => 'POST']) !!}
													
								
							
<!-- trainging -->
 				
                <div class="row ">
                <div class="col-md-2 ">
                    
                	<img alt="User Pic" src="{{ " /images/rx.png " }}" style="width: 150px; height: 150px;">
                	</div>

                	 <div class="col-md-10">
      
      				<div class="row col-md-offset-1 ">
                    <div class="col-md-10 ">
                        {!! Form::bsText('generic', 'Generic Name') !!}
                    </div>
                    <!--  <div class="col-md-8">
                        {!! Form::bsText('brand', 'Brand Name') !!}
                    </div> -->
</div>

      				<div class="row col-md-offset-1 ">
                    
                     <div class="col-md-10">
                        {!! Form::bsText('brand', 'Brand Name') !!}
                    </div>
</div>
      				<div class="row col-md-offset-1 ">
                    
                    	<div class="col-md-5">
                        {!! Form::bsText('quantity', 'Quantity') !!}
                    </div>
                     <div class="col-md-5  " >
                        {!! Form::bsText('dosage', 'Dosage') !!}
                    </div>
                   

                    </div>

  <div class="row col-md-offset-1 ">
                    	
                    <div class="col-md-10 ">
                        {!! Form::bsText('frequency', 'Frequency') !!}
                    </div>

                    </div>
  <div class="row col-md-offset-1 ">
                   <div class="col-md-5 ">
                                <div class="form-group">
                                    <label class="control-label">Start Date<span style="color: red">*</span></label>
                                    <input maxlength="100" name="start" type="date" class="form-control" style="width: 170px" />
                                </div>
                            </div> 
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label class="control-label">End date <span style="color: red">*</span></label>
                                    <input maxlength="100" name="end" type="date" class="form-control " style="width: 170px" />
                                </div>
                            </div>
        		</div>

</div>

</div>
							</div> <!-- end sa panelbody -->
							


							<button type="submit" class="btn btn-primary">Add</button>
						{!! Form::close() !!}
					</div>
				</div>
				<div class="col-md-6  ">
    			<div class="panel panel-primary "> 
			    	<div class="panel-heading">
			    		<h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Prescriptions</h4>
			    	</div>
			    	Weeds<br>
			    	Flintsones<br>
			    	Adderall<br>
					<div class="panel-body  ">
						{!! Form::open(['url' => route('consultations.store', ['patient_id' => request()->input('patient_id')]), 'method' => 'POST']) !!}
													
								
							
<!-- trainging -->
 


  

                    

							</div> <!-- end sa panelbody -->
							
							<button type="submit" class="btn btn-primary">View All prescription history</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	
 <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('[data-click=new-line]').click(function() {
            var target = $(this).data('target');
            console.log(target)
            var row = $('table[data-tag=' + target + '] tr:first').clone();
            row.find('input').val('');
            row.appendTo('table[data-tag=' + target + '] tbody');
        })

        $('body').on('click', '[data-click=remove-line]', function() {
            var trs = $(this).closest('tbody').find('tr');
            if (trs.length > 1) {
                $(this).closest('tr').remove();
            } else {
                $(this).closest('tr').find('input').val('');
            }
        })
    })


    $(function() {
        $('#groups').on('change', function() {
            var val = $(this).val();
            var sub = $('#sub_groups');
            $('option', sub).filter(function() {
                if (
                    $(this).attr('data-group') === val ||
                    $(this).attr('data-group') === 'SHOW'
                ) {
                    if ($(this).parent('span').length) {
                        $(this).unwrap();
                    }
                } else {
                    if (!$(this).parent('span').length) {
                        $(this).wrap("<span>").parent().hide();
                    }
                }
            });
        });
        $('#groups').trigger('change');
    });

</script>

<style type="text/css">
	
	.row-bod {
    margin-right: -15px;
    margin-left: -85px;
    margin-top: 7%;
}
</style>
@endsection












