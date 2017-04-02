@extends('welcome') @push('styles')
<style>
    table.table td {
        vertical-align: middle;
    }
    
    table.table td .form-group {
        margin-bottom: 0;
    }

</style>
@endpush @section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['url' => route('transactions.store', ['patient' => request()->input('patient')]), 'method' => 'POST', 'id' => 'trans']) !!}
            <table class="table table-bordered" style="margin-top:80px;">
                @foreach($prescriptions->lacking_prescriptions AS $doctor => $presc)
                <tbody>
                    <tr>
                        <td colspan="9">{{ $doctor }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Brand</td>
                        <td>Generic Name</td>
                        <td>Frequency</td>
                        <td>Dosage</td>
                        <td>Duration</td>
                        <td>Quantity</td>
                        <td style="width:10%"></td>
                    </tr>
                    @foreach($presc AS $p)
                    <tr>
                        <td colspan="2"></td>
                        <td>{{ $p->brand }}</td>
                        <td>{{ $p->genericname }}</td>
                        <td>{{ $p->frequency }}</td>
                        <td>{{ $p->dosage }}</td>
                        <td></td>
                        <td>{{ number_format($p->lacking(), 2) }}</td>
                        <td>
                            {{ Form::hidden("prescription[{$p->id}][id]", $p->id) }} {{ Form::bsText("prescription[{$p->id}][quantity]") }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @endforeach
            </table>
            <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
            </div>

            {!! Form::close() !!}
            <pre>
                    {{ json_encode($prescriptions->toArray()) }}
                </pre>
        </div>
    </div>
</div>
@endsection @push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#trans').submit(function(e) {
            e.preventDefault();

            var form = $(this),
                submit = form.find('[type=button]');

            submit.addClass('disabled');

            $.post(form.attr('action'), form.serialize())
                .done(function(res) {
                    console.log(res)
                })
                .always(function() {
                    submit.removeClass('disabled');
                })
        })
    });

</script>
@endpush
