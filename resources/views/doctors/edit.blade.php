@extends('welcome') @section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
            <a href="{{ url('/doctor-home') }}"  class="btn btn-sm btn-primary pull-right">&nbsp Back to Profile<span class="glyphicon glyphicon-arrow-left pull-left"></span></a>
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Update doctor: <span class="text-success"> {{ $data->userInfo->fullname() }} </span></h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-9" style="margin-left: 40%">
                        <img alt="User Pic" src="{{ "/storage/{$data->userInfo->avatar}" }}" style="width: 150px; height: 150px" class="img-circle img-responsive"> 
                            {!! Form::open(['url' => route('upload.dp'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} {!! Form::hidden('id', $data->userInfo->id) !!}
                        <input type="file" name="avatar" >
                        <input type="submit" class="btn btn-sm btn-primary">
                         
                        {!! Form::close() !!}
                    </div>
                    
                        {!! Form::open(['url' => route('doctors.update', ['id' => $data->id]), 'method' => 'PUT']) !!}
                            {!! Form::hidden('user_id', $data->userInfo->id) !!}
                            <div class="row ">
                                <div class="col-md-4 ">
                                    <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                        <label class="control-label">First Name</label>
                                        <span style="color: red">*</span> {!! Form::text('firstname', $data->userInfo->firstname, ['class' => 'form-control']) !!} @if($errors->has('firstname'))
                                        <span class="help-block">{{ $errors->first('firstname') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('middle_initial') ? 'has-error' : '' }}">
                                        <label class="control-label">Middle Initial</label>
                                        <span style="color: red">*</span> {!! Form::text('middle_initial', $data->userInfo->middle_initial, ['class' => 'form-control']) !!} @if($errors->has('middle_initial'))
                                        <span class="help-block">{{ $errors->first('middle_initial') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                        <label class="control-label">Last Name</label>
                                        <span style="color: red">*</span> {!! Form::text('lastname', $data->userInfo->lastname, ['class' => 'form-control']) !!} @if($errors->has('lastname'))
                                        <span class="help-block">{{ $errors->first('lastname') }}</span> @endif
                                    </div>
                                </div>
                            </div>
                         
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}"">
                                        <label class="control-label">Birthdate <span style="color: red">*</span></label> {!! Form::date('birthdate', $data->userInfo->birthdate, ['class' => 'form-control'], ['maxlength' => 100]) !!} @if($errors->has('birthdate'))
                                        <span class="help-block">{{ $errors->first('birthdate') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                        <label class="control-label">Gender</label>
                                        <span style="color: red">*</span>
                                        <select class="form-control" name="sex">
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                        <!-- {!! Form::text('sex', $data->userInfo->sex, ['class' => 'form-control']) !!} -->
                                        @if($errors->has('sex'))
                                        <span class="help-block">{{ $errors->first('sex') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                        <label class="control-label">Contact Number</label>
                                        <span style="color: red">*</span> {!! Form::text('contact_number', $data->userInfo->contact_number, ['class' => 'form-control']) !!} @if($errors->has('contact_number'))
                                        <span class="help-block">{{ $errors->first('contact_number') }}</span> @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                        <label class="control-label">Home Address</label>
                                        <span style="color: red">*</span> {!! Form::text('address', $data->userInfo->address, ['class' => 'form-control']) !!} @if($errors->has('address'))
                                        <span class="help-block">{{ $errors->first('address') }}</span> @endif
                                    </div>
                                </div>
                            </div>
                            <h4>Account Information</h4>
                            <hr class="third">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                        <label class="control-label">Username</label>
                                        <span style="color: red">*</span> {!! Form::text('username', $data->userInfo->username, ['class' => 'form-control']) !!} @if($errors->has('username'))
                                        <span class="help-block">{{ $errors->first('username') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label class="control-label">Email Address</label>
                                        <span style="color: red">*</span> {!! Form::text('email', $data->userInfo->email, ['class' => 'form-control']) !!} @if($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <h4>Specialty</h4>
                    <hr class="third">
                    <div class="row">
                      <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label class="control-label">Title</label>
                                        <span style="color: red">*</span> {!! Form::text('title', $data->title, ['class' => 'form-control']) !!} @if($errors->has('title'))
                                        <span class="help-block">{{ $errors->first('title') }}</span> @endif
                                    </div>
                                </div>
                        <div class="col-md-4">
                             <div class="form-group {{ $errors->has('specialization') ? 'has-error' : '' }}">
                                        <label class="control-label">Specialization</label>
                                <span style="color: red">*</span>
                                <select class="form-control" name="specialization" id='groups'>
                                            <option value="" selected disabled>Please select</option>
                                            <option>Internal Medicine</option>
                                            <option>Pediatrics</option>
                                            <option>ENT</option>
                                        </select> @if($errors->has('specialization'))
                                <span class="help-block">{{ $errors->first('specialization') }}</span> @endif
                            </div>
                        </div>
 
                        <!-- test json -->

                        <div class="col-md-4">
                            <label class="control-label">Subspecialty</label>
                            <table  class="table table-condensed" data-tag="subspec">
                                <tbody>
                                   @foreach($data->subspecialty AS $fa)
                                    <tr>
                                        <td>
                                            <select class="form-control" name="subspecialty[]" value="{{ $fa }}" id='sub_groups'>
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
                                    @endforeach
                                </tbody>

                            </table>
                            <button data-target="subspec" data-click="new-line" type="button" class="btn btn-sm btn-primary btn-create" style="margin-top: 10px"><em class="glyphicon glyphicon-plus" style="margin-right: 5px"></em>Add new line</button>
                        </div>
                    </div>

                            <h4>Clinic Information</h4>
                            <hr class="third">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('clinic') ? 'has-error' : '' }}">
                                        <label class="control-label">Clinic</label>
                                        <span style="color: red">*</span> {!! Form::text('clinic', $data->clinic, ['class' => 'form-control']) !!} @if($errors->has('clinic'))
                                        <span class="help-block">{{ $errors->first('clinic') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('clinic_address') ? 'has-error' : '' }}">
                                        <label class="control-label">Clinic Address</label> {!! Form::text('clinic_address', $data->clinic_address, ['class' => 'form-control']) !!} @if($errors->has('clinic_address'))
                                        <span class="help-block">{{ $errors->first('clinic_address') }}</span> @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('clinic_hours') ? 'has-error' : '' }}">
                                        <label class="control-label">Clinic hours</label> {!! Form::text('clinic_hours', $data->clinic_hours, ['class' => 'form-control']) !!} @if($errors->has('clinic_hours'))
                                             <span class="help-block">{{ $errors->first('clinic_hours') }}</span>  @endif
                                    </div>
                                </div>
                            </div>
                            @if(Auth::check()) 
                                @if(Auth::user()->user_type === 'ADMIN')
                                <h4>Licenses</h4>
                                <hr class="third">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('prc') ? 'has-error' : '' }}">
                                            <label class="control-label">PRC License Number</label>
                                            <span style="color: red">*</span> {!! Form::text('prc', $data->prc, ['class' => 'form-control']) !!} @if($errors->has('prc'))
                                            <span class="help-block">{{ $errors->first('prc') }}</span> @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('ptr') ? 'has-error' : '' }}">
                                            <label class="control-label">PTR Number</label>
                                            <span style="color: red">*</span> {!! Form::text('ptr', $data->ptr, ['class' => 'form-control']) !!} @if($errors->has('ptr'))
                                            <span class="help-block">{{ $errors->first('ptr') }}</span> @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('s2') ? 'has-error' : '' }}">
                                            <label class="control-label">S2 Number</label> {!! Form::text('s2', $data->s2, ['class' => 'form-control']) !!} @if($errors->has('s2'))
                                            <span class="help-block">{{ $errors->first('s2') }}</span> @endif
                                        </div>
                                    </div>
                                    </div>

                                    <h4>Education and Training</h4>
                                      <hr class="third">
                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::bsText('med_school', 'Medical School', $data->med_school) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('med_school_year', 'Year Completed', $data->med_school_year) !!}
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-8">
                            {!! Form::bsText('residency', 'Residency', $data->residency) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('residency_year', 'Year Completed', $data->residency_year) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::bsText('training', 'Fellowship Training', $data->training) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('training_year', 'Year completed', $data->training_year) !!}
                        </div>
                    </div>
                    <!-- Closing div for Education and Training -->
                    <!-- end -->

                    <h4>Affiliations and Medical Organizations</h4>
                    <hr class="third">

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('affiliations') ? 'has-error' : '' }}">
                            <table data-tag="affil" class="table table-condensed">
                                <tbody>
                                @foreach($data->affiliations AS $af)
                                    <tr>
                                        <td>
                                            <input type="text" name="affiliations[]" value="{{ $af }}" class="form-control">
                                        </td>
                                        <td>
                                            <a data-click="remove-line" style="margin-bottom: 10px" class="btn btn-danger btn-sm"><em class="glyphicon glyphicon-remove"></em></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button data-target="affil" data-click="new-line" type="button" class="btn btn-sm btn-primary btn-create" style="margin-top: 10px"><em class="glyphicon glyphicon-plus" style="margin-right: 5px"></em>Add new line</button>
                        </div>
                    </div>
                                </div>
                                @elseif(Auth::user()->user_type === 'DOCTOR')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('prc') ? 'has-error' : '' }}">
                                            <label class="control-label">PRC License Number</label>
                                            <span style="color: red">*</span>
                                             {!! Form::text('prc', $data->prc, ['class' => 'form-control','readonly' => 'true']) !!} 
                                             @if($errors->has('prc'))
                                                <span class="help-block">{{ $errors->first('prc') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('ptr') ? 'has-error' : '' }}">
                                            <label class="control-label">PTR Number</label>
                                            <span style="color: red">*</span> {!! Form::text('ptr', $data->ptr, ['class' => 'form-control', 'readonly' => 'true']) !!} @if($errors->has('ptr'))
                                            <span class="help-block">{{ $errors->first('ptr') }}</span> @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('s2') ? 'has-error' : '' }}">
                                            <label class="control-label">S2 Number</label> {!! Form::text('s2', $data->s2, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('s2'))
                                            <span class="help-block">{{ $errors->first('s2') }}</span> @endif
                                        </div>
                                    </div>

                                </div>
                                <h4>Education Information</h4>
                                    <hr class="third">
                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::bsText('med_school', 'Medical School', $data->med_school) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('med_school_year', 'Year Completed', $data->med_school_year) !!}
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-8">
                            {!! Form::bsText('residency', 'Residency', $data->residency) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('residency_year', 'Year Completed', $data->residency_year) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::bsText('training', 'Fellowship Training', $data->training) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::bsText('training_year', 'Year completed', $data->training_year) !!}
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
                                    @foreach($data->affiliations AS $af)
                                    <tr>
                                        <td>
                                            <input type="text" name="affiliations[]" value="{{ $af }}" class="form-control">
                                        </td>
                                        <td>
                                            <a data-click="remove-line" style="margin-bottom: 10px" class="btn btn-danger btn-sm"><em class="glyphicon glyphicon-remove"></em></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button data-target="affil" data-click="new-line" type="button" class="btn btn-sm btn-primary btn-create" style="margin-top: 10px"><em class="glyphicon glyphicon-plus" style="margin-right: 5px"></em>Add new line</button>
                        </div>
                    </div>
                   

                                </div>


                                @endif 
                            @endif
                        <button type="submit" class="btn btn-primary">Update</button> 
                        {!! Form::close() !!}
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
