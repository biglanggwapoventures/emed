@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Doctor Form
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route( 'doctors.create') }} ">Add Doctor</a></li>

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
                        {!! Form::open(['url' => route ('doctors.store'), 'method' => 'POST', 'id' => 'doc']) !!}
                        <div class="alert alert-danger hidden"></div>
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
                                    <input maxlength="100" name="birthdate" type="date" class="form-control" max="9999-12-31" style="width: 275px" /> @if($errors->has('birthdate'))
                                    <span class="help-block">{{ $errors->first('birthdate') }}</span> @endif
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
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label>Email</label>{{Form::email('email',null,['class' => 'form-control'])}}
                                    @if($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
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
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label class="control-label">Title</label>
                                    <span style="color: red">*</span>
                                    <input type="text" name="title" class="form-control" placeholder="eg. MD, MS, GP, OB/GYN"> @if($errors->has('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsSpecializationDropdown('specialization', 'Specialization') !!}
                            </div>
                            

                            <!-- test json -->

                            <div class="col-md-4">
                                <label class="control-label">Subspecialization(s)</label>
                                <table class="table" id="sub">
                                    <tbody>


                                        <tr>
                                            <td>{!! Form::select('subspecializations[]', [], null, ['class' => 'form-control subspecialization']) !!}</td>
                                            <td style="width:5px;"><a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a></td>
                                        </tr>

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


                        <h4>Affiliated Clinics</h4>
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
                                    <tbody data-aff-branches="{{ json_encode($affiliationBranches) }}">
                                        <tr>
                                            <td>
                                                {!! Form::select('affiliations[0][affiliation_id]', $affiliations, null, ['class' => 'form-control aff', 'data-name' => 'affiliations[idx][affiliation_id]', 'placeholder' => 'Select affiliated clinic']) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('affiliations[0][branch_id]', [], null, ['class' => 'form-control aff-branch', 'data-name' => 'affiliations[idx][branch_id]' ]) !!}
                                            </td>
                                            <td style="width:1px;">{!! Form::time('affiliations[0][clinic_start]', null, ['class' => 'form-control', 'data-name' => 'affiliations[idx][clinic_start]']) !!} </td>
                                            <td style="width:1px;"><center>-</center></td>
                                            <td style="width:1px;">{!! Form::time('affiliations[0][clinic_end]', null, ['class' => 'form-control', 'data-name' => 'affiliations[idx][clinic_end]']) !!}</td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6"><a href="javascript:void(0)" class="btn btn-default add-line"><span class="glyphicon glyphicon-plus"></span>  Add new line</a></td>

                                        </tr>
                                    </tfoot>
                                </table>
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

                        <h4>Medical Organizations</h4>
                        <hr class="third">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('affiliations') ? 'has-error' : '' }}">
                                    <table class="table" id="aff">
                                        <tbody>
                                            <tr>
                                                <td>{!! Form::select('organizations[]', $orgs, null, ['class' => 'form-control org', 'placeholder' => 'Select organization']) !!}</td>
                                                <td style="width:5px;"><a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a></td>
                                            </tr>
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
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">Register</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>


            </div>
            <!--/.col (left) -->

            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        var affBranches = $('[data-aff-branches]').data('aff-branches'),
            counter = 1;


        $('select[name=specialization]').change(function() {

            var $this = $(this),
                subspecializations = $this.find('option:selected').data('subspecialization'),
                options = '<option></option>';

            for (var x in subspecializations) {
                options += '<option value="' + x + '">' + subspecializations[x] + '</option>'
            }

            $('.subspecialization').html(options);

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
            } else {
                affBranchEl.html('');
            }
        }).trigger('change');

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
