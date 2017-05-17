@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manager Form
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/pmanager-home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route( 'managers.create') }}">Add Manager</a></li>

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
                        {!! Form::open(['url' => route ('managers.store'), 'method' => 'POST']) !!}

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
                                <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <label class="control-label">Gender</label>
                                    <label for="sel1">Select list:</label>
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
                                <div class="form-group">
                                    <label class="control-label">Birthdate <span style="color: red">*</span></label>
                                    <input maxlength="100" name="birthdate" type="date" class="form-control" max="9999-12-31" style="width: 275px" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::bsText('contact_number', 'Contact Number') !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::bsText('address', 'Address') !!}
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
                            <div class="col-md-4">
                                {!! Form::bsText('license', 'License') !!}
                            </div>


                        </div>



                               <h4>Pharmacy</h4>
                        <hr class="third">
                        <div class="row">
                            
                            <div class="col-sm-12">
                                <table class="table" id="pha-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Branch</th>
                                            <th>Address</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody data-pharmacy-branches="{{ json_encode($pharmacyBranches) }}">
                                        <tr>
                                            <td>
                                                {{-- Form::select('pharmacies[0][pharmacy_id]', $pharmacies, null, ['class' => 'form-control pha', 'data-name' => 'pharmacies[idx][pharmacies_id]', 'placeholder' => 'Select Pharmacy']) --}}
                                                {!! Form::select('drugstore', $pharmacies, null, ['class' => 'form-control pha', 'data-name' => 'pharmacies[idx][pharmacies_id]', 'placeholder' => 'Select Pharmacy']) !!}
                                            </td>
                                            <td>
                                                {{-- Form::select('pharmacies[0][pharmacy_id]', [], null, ['class' => 'form-control pharmacy-branch', 'data-name' => 'pharmacies[idx][pharmacy_id]' ]) --}}
                                                {!! Form::select('drugstore_branch', [], null, ['class' => 'form-control pharmacy-branch', 'data-name' => 'pharmacies[idx][pharmacy_id]' ]) !!}
                                            </td>
                                            <td data-pharmacy-addresses="{{ json_encode($pharmacyAddress) }}">
                                                {{ Form::select('pharmacies[0][pharmacy_id]', [], null, ['class' => 'form-control pharmacy-address', 'data-name' => 'pharmacies[idx][pharmacy_id]','readonly' => 'true' ]) }}
                                                {{-- Form::bsText('pharmacy-branch-address') --}}
                                            </td>
                                            <td>
                                            <a href="javascript:void(0)" class="btn btn-danger remove-line"><span class="glyphicon glyphicon-remove"></span></a></td>
                                        </tr>
                                    </tbody>
                                    <!-- <tfoot>
                                        <tr>
                                            <td colspan="4"><a href="javascript:void(0)" class="btn btn-default add-line"><span class="glyphicon glyphicon-plus"></span>  Add new line</a></td>
                                        </tr>
                                    </tfoot> -->
                                </table>
                            </div>
                        </div>



                        <!--<div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                                <label class="control-label">Birthdate</label>
                                <input type="text" name="birthdate" class="form-control">
                                @if($errors->has('birthdate'))
                                    <span class="help-block">{{ $errors->first('birthdate') }}</span>
                                @endif
                                </div>-->

                        <button type="submit" class="btn btn-primary">Register</button> {!! Form::close() !!}
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

        var phaBranches = $('[data-pharmacy-branches]').data('pharmacy-branches'),
            phaAddresses = $('[data-pharmacy-addresses]').data('pharmacy-addresses'),
            counter = 1;

        // $('select[name=pharmacies]').change(function() {

        //     var $this = $(this),
        //         pharmacy_branches = $this.find('option:selected').data('pharmacy_branches'),
        //         options = '<option></option>';

        //     for (var x in pharmacy_branches) {
        //         options += '<option value="' + x + '">' + pharmacy_branches[x] + '</option>'
        //     }

        //     $('.pharmacy_branches').html(options);

        // });
        ////

         $('select[name=pharmacy_branches]').change(function() {

            var $this = $(this),
                pharmacy_branches = $this.find('option:selected').data('pharmacy_branches'),
                options = '<option></option>';

            for (var x in pharmacy_branches) {
                options += '<option value="' + x + '">' + address + '</option>'
            }

            $('.pharmacy_branches').html(options);

        });

        ////
         $('.table').on('change', '.pharmacy-branch', function() {
            var $this = $(this),
                val = $this.val(),
                phaBranchEl = $this.closest('tr').find('.pharmacy-address');

                console.log(val);
            if (val) {
                // var optionsEl = '<option disabled selected>address</option>';
                var phar_branch_address = phaAddresses[val];
                console.log(phaAddresses);
                // $(phaAddresses[val]).each(function(i, v) 
                // {
                   
                var optionsEl = '<option value="' + val + '">' + phar_branch_address + '</option>'
                // });
                // $("input[name=pharmacy-branch-address]").val(phar_branch_address);
                phaBranchEl.html(optionsEl);
            } else {
                phaBranchEl.html('');
            }
        }).trigger('change');
        ////


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

        $('.table').on('change', '.pha', function() {
            var $this = $(this),
                val = $this.val(),
                phaBranchEl = $this.closest('tr').find('.pharmacy-branch');
            if (val) {
                var optionsEl = '<option disabled selected>Select branch</option>';
                $(phaBranches[val]).each(function(i, v) {
                    optionsEl += '<option value="' + v.id + '">' + v.name + '</option>'
                });
                phaBranchEl.html(optionsEl);
            } else {
                phaBranchEl.html('');
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
