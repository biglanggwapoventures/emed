@extends('welcome') @section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Doctor Registration </h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => route ('doctors.store'), 'method' => 'POST']) !!}
                    <h4>Personal Information</h4>
                    <hr class="third">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::bsText('firstname', 'Firstname') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('middle_initial', 'Middle Initial') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('lastname', 'Lastname') !!}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                                <label class="control-label">Birthdate <span style="color: red">*</span></label>
                                <input maxlength="100" name="birthdate" type="date" class="form-control" style="width: 275px" /> @if($errors->has('sex'))
                                <span class="help-block">{{ $errors->first('patients') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                <label class="control-label">Gender</label>
                                <span style="color: red">*</span>
                                <select class="form-control" name="sex">
										<option value="" selected disabled>Select</option>
											<option>Male</option>
											<option>Female</option>
										</select> @if($errors->has('sex'))
                                <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('contact_number', 'Contact Number') !!}
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            {!! Form::bsText('address', 'Home Address') !!}
                        </div>

                    </div>
                    <h4>Account Information</h4>
                    <hr class="third">

                    <div class="row">

                        <div class="col-md-4">
                            {!! Form::bsText('username', 'Username') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('email', 'Email') !!}
                        </div>
                    </div>
                    <h4>Licenses</h4>
                    <hr class="third">
                    <div class="row">

                        <div class="col-md-4">
                            {!! Form::bsText('prc', 'PRC license Number') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('ptr', 'PTR Number') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('s2', 'S2 Number') !!}
                        </div>
                    </div>

                    <h4>Specialty</h4>
                    <hr class="third">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('specialization') ? 'has-error' : '' }}">
                                <label class="control-label">Specialization</label>
                                <span style="color: red">*</span>
                                <select class="form-control" name="specialization" id='groups'>
											<option value="" selected disabled>Please select</option>
											<option>Internal Medicine</option>
											<option>Pediatrics</option>
											<option>ENT</option>
										</select> @if($errors->has('sex'))
                                <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label class="control-label">Title</label>
                                <span style="color: red">*</span>
                                <input type="text" name="title" class="form-control" placeholder="eg. MD, MS, GP, OB/GYN"> @if($errors->has('title'))
                                <span class="help-block">{{ $errors->first('title') }}</span> @endif
                            </div>
                        </div>

                        <!-- test json -->

                        <div class="col-md-4">
                            <label class="control-label">Subspecialty</label>
                            <table data-tag="subspec">
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" name="subspecialty[]" id='sub_groups'>
											  <option data-group='SHOW' value='0'>-- Select Specialty first--</option>
											  <option data-group='Internal Medicine' selected disabled>IM Subs</option>
											<option data-group='Internal Medicine'>Adolescent medicine</option>
											<option data-group='Internal Medicine'>Allergy, Asthma and Immunology</option>
											<option data-group='Internal Medicine'>Cardiology</option>
											<option data-group='Internal Medicine'>Clinical cardiac electrophysiology</option>
											<option data-group='Internal Medicine'>Critical care medicine</option>
											<option data-group='Internal Medicine'>Endocrinology</option>
											<option data-group='Internal Medicine'>Gastroenterology</option>
											<option data-group='Internal Medicine'>Geriatric medicine</option>
											<option data-group='Internal Medicine'>Hematology</option>
											<option data-group='Internal Medicine'>Hospital medicine</option>
											<option data-group='Internal Medicine'>Infectious disease</option>
											<option data-group='Internal Medicine'>Interventional cardiology</option>
											<option data-group='Internal Medicine'>Medical oncology</option>
											<option data-group='Internal Medicine'>Nephrology</option>
											<option data-group='Internal Medicine'>Pulmonology</option>
											<option data-group='Internal Medicine'>Rheumatology</option>
											<option data-group='Internal Medicine'>Sleep medicine</option>
											<option data-group='Internal Medicine'>Sports medicine</option>
											<option data-group='Internal Medicine'>Transplant hepatology</option>
											<option data-group='ENT' selected disabled>ENT Subs</option>
											<option data-group='ENT'>Head and Neck Surgery</option>
											<option data-group='ENT'>Otology</option>
											<option data-group='ENT'>Neurotology</option>
											<option data-group='ENT'>Thyroid and Parathoid Surgery</option>
											<option data-group='ENT'>Rhinology</option>
											<option data-group='ENT'>Facial Plastic Surgery</option>
											<option data-group='ENT'>Paediatrics</option>
											<option data-group='ENT'>Laryngology</option>
											<option data-group='Pediatrics' selected disabled>Pediatric Subs</option>
											<option data-group='Pediatrics'>Academic Generalist</option>
											<option data-group='Pediatrics'>Adolescent Medicine</option>
											<option data-group='Pediatrics'>Allergy and Immunology</option>
 											<option data-group='Pediatrics'>Child Abuse</option>
											<option data-group='Pediatrics'>Critical Care</option>
											<option data-group='Pediatrics'>Dermatology</option>
											<option data-group='Pediatrics'>Developmental and Behavioral</option>
											<option data-group='Pediatrics'>Emergency Medicine</option><option>Endocrinology</option>
											<option data-group='Pediatrics'>Gastroenterology</option>
											<option data-group='Pediatrics'>Hematology-Oncology</option>
											<option data-group='Pediatrics'>Hospitalist</option>
											<option data-group='Pediatrics'>Infectious Diseases</option>
											<option data-group='Pediatrics'>Neonatology</option>
											<option data-group='Pediatrics'>Nephrology</option>
											<option data-group='Pediatrics'>Neurology</option>
											<option data-group='Pediatrics'>Pulmonary Medicine</option>
											<option data-group='Pediatrics'>Rheumatology</option>
										</select>
                                        </td>
                                        <td><a data-click="remove-line" style="margin-bottom: 10px" class="btn btn-danger btn-sm"><em class="glyphicon glyphicon-remove"></em></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button data-target="subspec" data-click="new-line" type="button" class="btn btn-sm btn-primary btn-create" style="margin-top: 10px"><em class="glyphicon glyphicon-plus" style="margin-right: 5px"></em>Add new line</button>
                        </div>
                    </div>


                    <h4>Consultation</h4>
                    <hr class="third">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::bsText('clinic', 'Clinic') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::bsText('clinic_address', 'Clinic Address:') !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('clinic_hours', 'Clinic Hours:') !!}
                        </div>
                    </div>
                    <!-- trainging -->



                    <h4>Education and Training</h4>
                    <hr class="third">
                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::bsText('med_school', 'Medical School') !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('med_school_year', 'Year Completed') !!}
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-8">
                            {!! Form::bsText('residency', 'Residency') !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('residency_year', 'Year Completed') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::bsText('training', 'Fellowship Training') !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('training_year', 'Year completed') !!}
                        </div>
                    </div>
                    <!-- Closing div for Education and Training -->
                    <!-- end -->

                    <h4>Affiliations and Medical Organizations</h4>
                    <hr class="third">

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('affiliations') ? 'has-error' : '' }}">
                            <table data-tag="affil">
                                <tbody>
                                    <tr>
                                        <td><input maxlength="100" type="text" name="affiliations[]" class="form-control" style="width: 375px; margin-right: 10px; margin-bottom: 10px" /></td>
                                        <td><a data-click="remove-line" style="margin-bottom: 10px" class="btn btn-danger btn-sm"><em class="glyphicon glyphicon-remove"></em></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button data-target="affil" data-click="new-line" type="button" class="btn btn-sm btn-primary btn-create" style="margin-top: 10px"><em class="glyphicon glyphicon-plus" style="margin-right: 5px"></em>Add new line</button>
                        </div>
                    </div>
                </div>
                <!-- end sa panelbody -->

                <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>>
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



@endsection










<!-- <div class="row">
								

								<div class="col-md-4">
									<div class="form-group {{ $errors->has('specialization') ? 'has-error' : '' }}">
										<label class="control-label">Specialization</label>
										<span style="color: red">*</span>
										<input type="text" name="specialization" class="form-control">
										@if($errors->has('specialization'))
											<span class="help-block">{{ $errors->first('specialization') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
										<label class="control-label">Title</label>
										<span style="color: red">*</span>
										<input type="text" name="title" class="form-control" placeholder="eg. MD, MS, GP, OB/GYN">
										@if($errors->has('title'))
											<span class="help-block">{{ $errors->first('title') }}</span>
										@endif
									</div>
								</div>
								
							</div>
							<div class="row">
								
							<div class="col-md-8">
                    <label class="control-label">Subspecialty</label>
                        <table data-tag="subspec">
                            <tbody>
                                <tr>
                                    <td><input  maxlength="100" type="text" name="subspecialty[]"  class="form-control" style="width: 563px; margin-right: 10px; margin-bottom: 10px" /></td>
                                    <td><a  data-click="remove-line" style="margin-bottom: 10px" class="btn btn-danger btn-sm"><em class="glyphicon glyphicon-remove"></em></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <button data-target="subspec" data-click="new-line" type="button" class="btn btn-sm btn-primary btn-create" style="margin-top: 10px"><em class="glyphicon glyphicon-plus" style="margin-right: 5px"></em>Add new line</button>
                    </div>

                </div> -->
<!-- //</div> -->
