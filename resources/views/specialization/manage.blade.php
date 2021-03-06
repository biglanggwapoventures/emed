@extends('welcome') @section('body')

<div class="content-wrapper">
   <section class="content-header">
        <h1>
           Manage Specialization 
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('specialization.index')}}">Specializations</a></li>
            <li><a href="{{ route( 'specialization.create')}} ">Manage Specialization</a></li>

        </ol>
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"> <i class="glyphicon glyphicon-user"></i> Specialization</h4>
                    </div>
                    <div class="panel-body"><div class="alert alert-success hidden"></div>
                        @if($data->id) {!! Form::open(['url' => route('specialization.update', ['id' => $data->id]), 'method' => 'PATCH', 'id' => 'spec']) !!} @else {!! Form::open(['url' => route('specialization.store'), 'method' => 'POST', 'id' => 'spec']) !!} @endif
                        <div class="alert alert-danger hidden"></div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::bsText('name', 'Name', $data->name) !!}
                                <div class="form-group">
                                    <label for="">Subspecialization(s)</label>
                                    <table class="table">
                                        <tbody>
                                            @foreach($data->subspecializations AS $i => $sub)
                                            <tr>
                                                <td>
                                                    {!! Form::text("subs[{$i}][name]", $sub->name, ['class' => 'form-control', 'data-name' => 'subs[idx][name]']) !!} @if($sub->id) {!! Form::hidden("subs[{$i}][id]", $sub->id) !!} @endif
                                                </td>
                                                <td> <a href="javascript:void(0)" class="btn btn-danger remove-line"><i class="glyphicon glyphicon-remove"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <td colspan="2"> <a href="javascript:void(0)" class="btn btn-default add-line"><i class="glyphicon glyphicon-plus"></i> Add new line</a></td>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('specialization.index') }}" class="btn btn-default" id="none">Back to list</a> {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
  <a href="{{ route('specialization.create') }}"  id="back"></a>
</div>

<style type="text/css">
    .panel-default {
    border-color: #ddd;
    margin-top: 30px;
}
</style>

@endsection @push('scripts')
<script type="text/javascript">
    var counter = $('#spec table tbody tr').length;

    $(document).ready(function() {
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
                        $('.alert.alert-success').removeClass('hidden').text(res.message);
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
<script type="text/javascript">
    $('#back').hide();
</script>
@endpush
