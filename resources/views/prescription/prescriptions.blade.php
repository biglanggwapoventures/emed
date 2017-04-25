@extends('welcome') @section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>
            Prescription

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Patient</a></li>
            <li class="active">Prescription</li>
        </ol>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="row"></div>
        <!-- Default box -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <div class="col-md-2 ">
                            <img alt="User Pic" src="{{ " /images/rx.png " }}" style="width: 3x 0px; height: 30px;">
                        </div> &nbsp &nbsp Add Prescriptions</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>

                    </div>
                </div>
                <div class="box-body">
                    @if(count($errors->all()))
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() AS $err)
                            <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif {!! Form::open(['url' => route('prescription.store'), 'method' => 'POST']) !!} {!! Form::hidden('patient_id', request()->input('patient_id')) !!} {!! Form::hidden('consultation_id', request()->input('consultation_id')) !!}



                    <div class="row col-md-offset-1 ">
                        <div class="col-md-10 ">
                            {!! Form::bsText('genericname', 'Generic Name', null) !!}
                        </div>
                    </div>
                    <div class="row col-md-offset-1 ">
                        <div class="col-md-10">
                            {!! Form::bsText('brand', 'Brand Name') !!}
                        </div>
                    </div>
                    <div class="row col-md-offset-1 ">
                        <div class="col-md-5">
                            {!! Form::bsText('quantity', 'Quantity', null) !!}
                        </div>
                        <div class="col-md-5  ">
                            {!! Form::bsText('dosage', 'Dosage', null) !!}
                        </div>
                    </div>
                    <div class="row col-md-offset-1 ">
                        <div class="col-md-5 ">
                            {!! Form::bsText('frequency', 'Frequency', null) !!}
                        </div>
                        <div class="col-md-5 ">
                            {!! Form::bsText('duration', 'Duration', null,['placeholder'=> 'Days']) !!}
                        </div>
                    </div>
                    <div class="row col-md-offset-1 ">
                        <div class="col-md-5 ">
                            {!! Form::bsDate('start', 'Start Date', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-5">
                            {!! Form::bsDate('end', 'End Date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row col-md-offset-1 ">
                        <div class="col-md-5 ">
                            <strong>Notes:</strong> {{ Form::textarea('notes', null, ['size' => '56x5'])}}

                            <button type="submit" class="btn btn-primary">Add</button> {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>
            </div>
            <!-- /.box -->

        </div>
        <!-- Default box -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Prescriptions</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    Insert prescriptions here
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer-->
            </div>
        </div>
        <!-- /.box -->
</div>
</section>
<!-- /.content -->

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() 
    {
        $("input[name=duration]").focusout(function()
        {
            var duration = $(this).val();
            if($.isNumeric(duration))
            {
                duration = parseInt(duration);

                var strStartDate = $("input[name=start]").val(),
                    startDate = new Date(strStartDate);

                if(!isNaN(startDate))
                {
                    var retEndDate = computeEndDate(duration, startDate);
                    $("input[name=end]").val(retEndDate);
                }
            }
        });

        $("input[name=start]").focusout(function()
        {
            var duration = $("input[name=duration]").val();
            if($.isNumeric(duration))
            {
                duration = parseInt(duration);

                var strStartDate = $(this).val(),
                    startDate = new Date(strStartDate);

                if(!isNaN(startDate))
                {
                    var retEndDate = computeEndDate(duration, startDate);
                    $("input[name=end]").val(retEndDate);
                }
            }
        });
    });

    function computeEndDate(duration, startDate)
    {
        var year = startDate.getFullYear();
        var month = startDate.getMonth() + 1;
        var currDay = startDate.getDate();
        var endDay = startDate.getDate() + duration;
        var maxDaysInTheMonth = new Date(year, month, 0).getDate();

        if(endDay > maxDaysInTheMonth)
        {
            endDay = endDay - maxDaysInTheMonth;
            month++;
        }

        if(month > 12)
        {
            month = month - 12;
            year++;
        }

        // var strEndDate = month + "/" + endDay + "/" + year,

        var actualEndMonth = (month < 10 ? ('0' + month) : month),
            actualEndDay = (endDay < 10 ? ('0' + endDay) : endDay);

        var strEndDate = year + "-" + actualEndMonth + "-" + actualEndDay,
            endDate = new Date(strEndDate);

        console.log(strEndDate);
        return strEndDate;
    }
</script>

</div>
@endpush

@endsection