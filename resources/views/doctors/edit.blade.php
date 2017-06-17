@extends('welcome') @section('body')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
@endpush

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url(session('homepage') . '') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('doctors.index') }}">Doctor List</a>
                </li>
                <li class="breadcrumb-item active">Edit Doctor</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                &nbsp;Edit Doctor Form
            </span>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
                <div class="col-md-12">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#pic" data-toggle="tab">Profile Picture</a></li>
                      <li ><a href="#profile" data-toggle="tab">User Profile</a></li>
                      <li><a href="#settings" data-toggle="tab">Background and Credentials</a></li>
                      <li><a href="#info" data-toggle="tab">Affiliated Clinic</a></li>                     
                    </ul>
                    <div class="tab-content">
                    <!--  -->
                    <div class="active tab-pane" id="pic" style="height: 300px">
                        @if(session('ACTION_RESULT'))
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                                        {{ session('ACTION_RESULT')['message'] }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-9" style="margin-left: 3%; margin-top:2% ">
                            <img alt="User Pic" src="{{ " /storage/{$data->userInfo->avatar}" }}" style="width: 150px; height: 150px" class="img-circle img-responsive" id="dp"> 
                            {!! Form::open(['url' => route('upload.dp'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} {!! Form::hidden('id', $data->userInfo->id) !!}
                                <!-- {{Form::file('avatar')}} -->
                            <input type="file" onchange="readURL(this)" class="upload" name="avatar" style="margin-top: 3%" />
                            <p>Image must not exceed 2048</p>
                            <input type="submit" class="btn btn-sm btn-primary">
                            {!! Form::close() !!}
                        </div>
                        {!! Form::open(['url' => route('doctors.update', ['id' => $data->id]), 'method' => 'PUT', 'id' => 'doc']) !!} {!! Form::hidden('user_id', $data->userInfo->id) !!}    
                    </div>
                    <!--  -->
                    <div class="tab-pane" id="settings" >
                        <h4>Specialty</h4>
                        <hr class="third">
                         <table class="table">

                            <thead>
                                <tr>
                                    <th>Specialization</th>
                                    <th>SubSubspecialization(s)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if(Auth::user()->user_type === 'ADMIN')
                            <tbody>
                                @foreach($data->specializations AS  $index=> $row)
                                <tr>

                                    <td>
                                      
                                        {!! Form::bsSpecializationDropdown("spec[{$index}][name]", '', $row->id, 'spec[idx][name]', $row->id) !!}
                                        
                                    
                                        
                                    </td>

                                    <td>
                                    {!! Form::select("spec[{$index}][subs][]", [], null, ['class' => 'select2 form-control subspecialization', 'data-name' => 'spec[idx][subs][]', 'multiple' => 'multiple', 'data-values' => $row->pivot->subspecialization_ids]) !!}
                                    </td>

                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-default add-spec"><span class="glyphicon glyphicon-plus"></span> Add new line</a>
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            </tfoot>
                            @elseif(Auth::user()->user_type === 'DOCTOR')
                            <tbody style="pointer-events: none;">
                                @foreach($data->specializations AS  $index=> $row)
                                <tr>

                                    <td>
                                      
                                        {!! Form::bsSpecializationDropdown("spec[{$index}][name]", '', $row->id, 'spec[idx][name]', $row->id) !!}
                                        
                                    
                                        
                                    </td>

                                    <td>
                                    {!! Form::select("spec[{$index}][subs][]", [], null, ['class' => 'select2 form-control subspecialization', 'data-name' => 'spec[idx][subs][]', 'multiple' => 'multiple', 'data-values' => $row->pivot->subspecialization_ids]) !!}
                                    </td>

                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                            @endif

                            
                        </table>
                       
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
                        @else
                            <h4>Licenses</h4>
                            <hr class="third">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('prc') ? 'has-error' : '' }}">
                                        <label class="control-label">PRC License Number</label>
                                        <span style="color: red">*</span> {!! Form::text('prc', $data->prc, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('prc'))
                                        <span class="help-block">{{ $errors->first('prc') }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('ptr') ? 'has-error' : '' }}">
                                        <label class="control-label">PTR Number</label>
                                        <span style="color: red">*</span> {!! Form::text('ptr', $data->ptr, ['class' => 'form-control','readonly' => 'true']) !!} @if($errors->has('ptr'))
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
                        @endif
                        <h4>Medical Organizations</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{ $errors->has('affiliations') ? 'has-error' : '' }}">
                                    <table class="table" id="aff">
                                        <tbody>
                                            @foreach($data->organizations AS $o)
                                            <tr>
                                                <td>{!! Form::select('organizations[]', $orgs, $o->id, ['class' => 'form-control org', 'placeholder' => 'Select organization']) !!}</td>
                                                <td style="width:5px;"><a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="javascript:void(0)" class="btn btn-default add-line"><span class="glyphicon glyphicon-plus"></span> Add new line</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="tab-pane" id="info" >
                        <!-- <hr class="third"> -->
                        <!-- <h4>Affiliated Clinics</h4> -->
                        <hr class="third">
                         <div class="row">
                            <div class="col-sm-12">
                            <table class="table" id="aff-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Branch</th>
                                        <th>Clinic Hours</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody data-aff-branches="{{ json_encode($affiliationBranches) }}" data-aff="{{ $data->affiliations }}">
                                    @foreach($data->affiliations AS $i => $aff)
                                    <tr>
                                        <td >
                                            {!! Form::select("affiliations[{$i}][affiliation_id]", $affiliations, $aff->id, ['class' => 'form-control aff', 'data-name' => 'affiliations[idx][affiliation_id]', 'placeholder' => 'Select affiliated clinic']) !!}
                                        </td>
                                        <td>
                                            {!! Form::select("affiliations[{$i}][branch_id]", [], null, ['class' => 'form-control aff-branch', 'data-name' => 'affiliations[idx][branch_id]', 'data-default' => $aff->pivot->affiliation_branch_id ]) !!}
                                        </td>
                                        <td style="width:1px;">{!! Form::time("affiliations[{$i}][clinic_start]", $aff->pivot->clinic_start, ['class' => 'form-control', 'data-name' => 'affiliations[idx][clinic_start]']) !!}
                                        </td>
                                        <td style="width:1%;">to</td>
                                        <td  style="width:1px;">
                                        {!! Form::time("affiliations[{$i}][clinic_end]", $aff->pivot->clinic_end, ['class' => 'form-control', 'data-name' => 'affiliations[idx][clinic_end]']) !!}  
                                        </td>
                                        <td>
                                        <a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6"><a href="javascript:void(0)" class="btn btn-default add-line"><span class="glyphicon glyphicon-plus"></span>  Add new line</a></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    </div>
                    <!--  -->
                      <div class="tab-pane" id="profile" >
                        <div class="alert alert-danger hidden">NIKKS WHY U BOPOLS?</div>
                        <h4>Personal Information</h4>
                        <hr class="third"></hr>
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
                                {!! Form::bsText('birthdate', 'Birthdate *', $data->userInfo->birthdate, ['class' => 'form-control bsdatepicker']) !!}
                            </div>
                            <div class="col-md-4 ">
                                {!! Form::bsSelect('sex', 'Sex', [''  => '', 'Male' => 'Male', 'Female' => 'Female'], $data->userInfo->sex) !!}

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
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label class="control-label">Title</label>
                                    <span style="color: red">*</span> {!! Form::text('title', $data->title, ['class' => 'form-control']) !!} @if($errors->has('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="control-label">Home Address</label>
                                    <span style="color: red">*</span> {!! Form::text('address', $data->userInfo->address, ['class' => 'form-control']) !!} @if($errors->has('address'))
                                    <span class="help-block">{{ $errors->first('address') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        <h4>Account Information</h4>
                        <hr class="third"></hr>
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
                      </div>                        
                      <!-- another -->
                      <!-- another -->
<!-- tabcontentend div sa ubos -->
                    </div>     
                 </div>
           </div>             
         <!-- 12 -->
          <!--/.col (right) -->
      </div>  
       <button type="submit" class="btn btn-primary" style="margin-bottom: 20px">Update</button> {!! Form::close() !!}
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <a href="{{ route('doctors.index') }}"  id="back"></a>
</div>

<style type="text/css">
    .inside {
        padding: 12px;
    }
    .nav-tabs-custom {
    margin-bottom: 20px;
    background: #fff;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 3px;
    margin-top: 11px;
}
.col-md-3 {
    width: 25%;
    margin-top: 0px;
}

</style>

<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#dp').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        var affBranches = $('[data-aff-branches]').data('aff-branches'),
            counter = {{ $data->affiliations->count() }},
            specCounter = {{ $data->specializations->count() }}

                var specClone = $('.specialization:first').clone(),
                subspecClone = $('.subspecialization:first').clone();
         

                
        $('.specialization').each(function () {
            var $this = $(this),
                subspecializations = $this.find('option:selected').data('subspecialization'),
                options = '<option></option>';

            for (var x in subspecializations) {
                options += '<option value="' + x + '">' + subspecializations[x] + '</option>'
            }

            $(this).closest('tr').find('.subspecialization').html(options).val(function () {
                console.log($(this).data('values'))
                return $(this).data('values')
            });
        })

        $('.select2').css({width:'100%'}).select2();
       
       
         $('.content').on('change', '.specialization', function() {

            alert();

            var $this = $(this),
                subspecializations = $this.find('option:selected').data('subspecialization'),
                options = '<option></option>';

            for (var x in subspecializations) {
                options += '<option value="' + x + '">' + subspecializations[x] + '</option>'
            }

            $(this).closest('tr').find('.subspecialization').html(options);

        });

      


        $('table').on('click', '.remove-line', function() {
            var trs = $(this).closest('table').find('tbody tr');
            if (trs.length === 1) {
                trs.find('select,input').val('')
            } else {
                $(this).closest('tr').remove();
            }
        })

        $('.add-line').click(function() {
            specCounter++;
            var clone = $(this).closest('table').find('tbody tr:first').clone();
            clone.find('[data-name]').attr('name', function() {
                return $(this).data('name').replace('idx', specCounter);
            })
            clone.find('input,select').val('');
            clone.appendTo($(this).closest('table').find('tbody'));
        })

        $('.add-spec').click(function() {

            counter++;
            var clone = $(this).closest('table').find('tbody tr:first').clone();

             clone.find('td:first').html(specClone.prop('outerHTML'))
             clone.find('td:eq(1)').html(subspecClone.prop('outerHTML'))

            clone.find('[data-name]').attr('name', function() {
                return $(this).data('name').replace('idx', counter);
            })
            // clone.find('')
            clone.find('input,select').val('');
            clone.find('.select2').css({'width':'100%'})
            clone.find('.select2').select2();
            clone.appendTo($(this).closest('table').find('tbody'));
        })

        $('.table').on('change', '.aff', function() {
            var $this = $(this),
                val = $this.val(),
                affBranchEl = $this.closest('tr').find('.aff-branch');
            if (val) {
                var optionsEl = '<option disabled selected>Select branch</option>';
                $(affBranches[val]).each(function(i, v) {
                    optionsEl += '<option value="' + v.id + '">' + v.name + '</option>'
                });
                affBranchEl.html(optionsEl);
                if (affBranchEl.data('default')) {
                    affBranchEl.val(affBranchEl.data('default'))
                }
            } else {
                affBranchEl.html('');
            }
        });
        $('.aff').trigger('change');



        // $('#doc').submit(function(e) {
        //     e.preventDefault();
        //     var $this = $(this)
        //     submitBtn = $this.find('[type=submit]'),
        //         alertEl = $('.alert.alert-danger');

        //     alertEl.addClass('hidden');
        //     submitBtn.addClass('disabled');

        //     console.log(alertEl);
        //     $.post($this.attr('action'), $this.serialize())
        //         .done(function(res) {
        //             // window.location.href = res.url;
        //              $('.alert.alert-success').removeClass('hidden').text(res.message);
        //                 // $this.find('input').val('');
        //                 window.location.href = $("#back").attr('href');
        //         })
        //         .fail(function(res) {
        //             // console.log(res);
        //             // alert(res.responseJSON.errors.join('</li><li>'));
        //             // alertEl.remove();
        //             alertEl.html(function() {
        //                 return '<ul class="list-unstyled"><li>' + res.responseJSON.errors.join('</li><li>') + '</li><ul>';
        //             }).removeClass('hidden');
        //         })
        //         .always(function() {
        //             submitBtn.removeClass('disabled');
        //         })
        // })

    })

</script>
@endpush

<style type="text/css">
    .inside {
        padding: 12px;
    }

</style>

<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#dp').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>


<script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);
</script>

<style type="text/css">
    .alert {
    position:absolute;
    z-index:1;
    margin-bottom: : 30px;
    width: 500px;

}
</style>



@endsection
