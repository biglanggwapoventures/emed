@extends('welcome') @section('body')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Doctor
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Edit Doctor</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="inside">
                        <div class="col-md-9" style="margin-left: 40%">
                            <img alt="User Pic" src="{{ " /storage/{$data->userInfo->avatar}" }}" style="width: 150px; height: 150px" class="img-circle img-responsive"> {!! Form::open(['url' => route('upload.dp'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} {!! Form::hidden('id', $data->userInfo->id) !!}
                            <input type="file" name="avatar">
                            <input type="submit" class="btn btn-sm btn-primary"> {!! Form::close() !!}
                        </div>

                        {!! Form::open(['url' => route('doctors.update', ['id' => $data->id]), 'method' => 'PUT', 'id' => 'doc']) !!} {!! Form::hidden('user_id', $data->userInfo->id) !!}
                        <div class="alert alert-danger hidden"></div>
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

                                <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                                    <label class="control-label ">Birthdate <span style="color: red ">*</span></label> {!! Form::date('birthdate', $data->userInfo->birthdate, ['class' => 'form-control'], ['maxlength' => 100]) !!} @if($errors->has('birthdate'))
                                    <span class="help-block ">{{ $errors->first('birthdate') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <label class="control-label">Gender</label>
                                    <span style="color: red">*</span> {!! Form::select('sex', ['Female' => 'FEMALE', 'Male' => 'MALE'], $data->userInfo->sex, ['class' => 'form-control']) !!} @if($errors->has('sex'))
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
                                {!! Form::bsSpecializationDropdown('specialization', 'Specialization', $data->specialization_id) !!}
                            </div>

                            <div class="col-md-4">
                                <label class="control-label">Subspecialization(s)</label>
                                <table class="table" id="sub">
                                    <tbody>
                                        @foreach($data->subspecializations AS $sub)
                                        <tr>
                                            <td>{!! Form::select('subspecializations[]', [], null, ['class' => 'form-control subspecialization', 'data-default' => $sub->id]) !!}</td>
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

                        <h4>Clinic Information</h4>
                        <hr class="third">
                        <div class="row">
                        </div>

                        @if(Auth::check()) @if(Auth::user()->user_type === 'ADMIN')
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
                        @endif

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

                        <h4>Affiliated Clinics</h4>
                        <hr class="third">
                        <div class="col-sm-12">
                            <table class="table" id="aff-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Branch</th>
                                        <th>Clinic Hours</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody data-aff-branches="{{ json_encode($affiliationBranches) }}" data-aff="{{ $data->affiliations }}">
                                    @foreach($data->affiliations AS $i => $aff)
                                    <tr>
                                        <td>
                                            {!! Form::select("affiliations[{$i}][affiliation_id]", $affiliations, $aff->id, ['class' => 'form-control aff', 'data-name' => 'affiliations[idx][affiliation_id]', 'placeholder' => 'Select affiliated clinic']) !!}
                                        </td>
                                        <td>
                                            {!! Form::select("affiliations[{$i}][branch_id]", [], null, ['class' => 'form-control aff-branch', 'data-name' => 'affiliations[idx][branch_id]', 'data-default' => $aff->pivot->affiliation_branch_id ]) !!}
                                        </td>
                                        <td>{!! Form::text("affiliations[{$i}][clinic_hours]", $aff->pivot->clinic_hours, ['class' => 'form-control', 'data-name' => 'affiliations[idx][clinic_hours]']) !!}</td>
                                        <td><a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"><a href="javascript:void(0)" class="btn btn-default add-line"><span class="glyphicon glyphicon-plus"></span>  Add new line</a></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <h4>Medical Organizations</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-6">
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
                    @endif
                    <button type="submit" class="btn btn-primary">Update</button> {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        var affBranches = $('[data-aff-branches]').data('aff-branches'),
            counter = {{ $data-> affiliations->count()}}


        $('select[name=specialization]').change(function() {

            var $this = $(this),
                subspecializations = $this.find('option:selected').data('subspecialization'),
                options = '<option></option>';

            for (var x in subspecializations) {
                options += '<option value="' + x + '">' + subspecializations[x] + '</option>'
            }

            $('.subspecialization').html(options).val(function() {
                if ($(this).data('default')) {
                    return $(this).data('default');
                }
            });

        }).trigger('change');



        $('table').on('click', '.remove-line', function() {
            var trs = $(this).closest('table').find('tbody tr');
            if (trs.length === 1) {
                trs.find('select,input').val('')
            } else {
                $(this).closest('tr').remove();
            }
        })

        $('.add-line').click(function() {
            counter++;
            var clone = $(this).closest('table').find('tbody tr:first').clone();
            clone.find('[data-name]').attr('name', function() {
                return $(this).data('name').replace('idx', counter);
            })
            clone.find('input,select').val('');
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



        $('#doc').submit(function(e) {
            e.preventDefault();
            var $this = $(this)
            submitBtn = $this.find('[type=submit]'),
                alertEl = $this.find('.alert.alert-danger');

            alertEl.addClass('hidden');
            submitBtn.addClass('disabled');

            $.post($this.attr('action'), $this.serialize())
                .done(function(res) {
                    window.location.href = res.url;
                    // if (res.result) {
                    //     window.location.href = $("#back").attr('href');
                    // }
                })
                .fail(function(res) {
                    alertEl.html(function() {
                        return '<ul class="list-unstyled"><li>' + res.responseJSON.errors.join('</li><li>') + '</li><ul>';
                    }).removeClass('hidden');
                })
                .always(function() {
                    submitBtn.removeClass('disabled');
                })
        })

    })

</script>
@endpush

<style type="text/css">
    .inside {
        padding: 12px;
    }

</style>


@endsection
