@extends('welcome') @section('body')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"> <i class="glyphicon glyphicon-user"></i> Pharmacy</h4>
                    </div>
                    <div class="panel-body">
                        @if($data->id) {!! Form::open(['url' => route('pharmacy.update', ['id' => $data->id]), 'method' => 'PATCH', 'id' => 'spec']) !!} @else {!! Form::open(['url' => route('pharmacy.store'), 'method' => 'POST', 'id' => 'spec']) !!} @endif
                        <div class="alert alert-danger hidden"></div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::bsText('name', 'Name', $data->name) !!}
                                <div class="form-group">
                                    <label for="">Branche(s)</label>
                                    <table class="table">
                                        <tbody>
                                            @foreach($data->branches AS $i => $sub)
                                            <tr>
                                                <td>
                                                    {!! Form::text("branch[{$i}][name]", $sub->name, ['class' => 'form-control', 'data-name' => 'branch[idx][name]', 'placeholder'=>'Branch']) !!} @if($sub->id) {!! Form::hidden("branch[{$i}][id]", $sub->id) !!}  @endif
                                                </td>
                                                <td>
                                                    {!! Form::text("branch[{$i}][address]", $sub->address, ['class' => 'form-control', 'data-name' => 'branch[idx][address]','placeholder'=>'Address']) !!}


                                                </td>

                                                <td> <a href="javascript:void(0)" class="btn btn-danger remove-line"><i class="glyphicon glyphicon-remove"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <td colspan="3"> <a href="javascript:void(0)" class="btn btn-default add-line"><i class="glyphicon glyphicon-plus"></i> Add new line</a></td>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('pharmacy.index') }}" class="btn btn-default" id="back">Back</a> {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection @push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var counter = $('#spec table tbody tr').length;
        $('.add-line').click(function() {
            counter++;
            var clone = $('#spec table tbody tr:first').clone()
            clone.find('[data-name]').attr('name', function() {
                return $(this).data('name').replace('idx', counter);
            });
            clone.find('input').val('');
            clone.find('[type=hidden]').remove();
            clone.appendTo('#spec table tbody');
        })

        $('#spec').on('click', '.remove-line', function() {
            var rows = $('#spec table tbody tr').length;
            if (rows === 1) {
                var tr = $(this).closest('tr');
                tr.find('input').val('');
                tr.find('[type=hidden]').remove();
                return;
            }
            $(this).closest('tr').remove();
        });


        $('#spec').submit(function(e) {
            e.preventDefault();
            var $this = $(this)
            submitBtn = $this.find('[type=submit]'),
                alert = $this.find('.alert.alert-danger');

            alert.addClass('hidden');
            submitBtn.addClass('disabled');

            $.post($this.attr('action'), $this.serialize())
                .done(function(res) {
                    if (res.result) {
                        window.location.href = $("#back").attr('href');
                    } else {
                        alert.html(function() {
                            return '<ul class="list-unstyled"><li>' + res.errors.join('</li><li>') + '</li><ul>';
                        }).removeClass('hidden');
                    }
                })
                .fail(function() {
                    alert('An internal server error has occured!');
                })
                .always(function() {
                    submitBtn.removeClass('disabled');
                })

        })
    })

</script>
@endpush
