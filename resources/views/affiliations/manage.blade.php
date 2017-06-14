@extends('welcome') @section('body')

<div class="content-wrapper">
    <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url(session('homepage') . '') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('affiliations.index') }}">Affiliations</a>
                </li>
                <li class="breadcrumb-item">{{ $data->id ? 'Edit' : 'Add' }} Affiliation</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                &nbsp;{{ $data->id ? 'Edit' : 'Add' }} Affiliation Form
            </span>
        </h1>
    </section>
 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"> <i class="glyphicon glyphicon-user"></i> Affiliation</h4>
                    </div>
                    <div class="panel-body"> <div class="alert alert-success hidden"></div>

                        @if($data->id) {!! Form::open(['url' => route('affiliations.update', ['id' => $data->id]), 'method' => 'PATCH', 'id' => 'spec']) !!} @else {!! Form::open(['url' => route('affiliations.store'), 'method' => 'POST', 'id' => 'spec']) !!} @endif
                        <div class="alert alert-danger hidden"></div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::bsText('name', 'Name', $data->name) !!}
                                <div class="form-group">
                                    <label for="">Branch(es)</label>
                                    <table class="table">
                                        <tbody>
                                            @foreach($data->branches AS $i => $branch)
                                            <tr>
                                                <td>
                                                    {!! Form::text("branches[{$i}][name]", $branch->name, ['class' => 'form-control', 'data-name' => 'branches[idx][name]']) !!} @if($branch->id) {!! Form::hidden("branches[{$i}][id]", $branch->id) !!} @endif
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
                        <a href="{{ route('affiliations.index') }}" class="btn btn-success" id="none">Back to list</a>
                         {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
     <a href="{{ route('affiliations.create') }}"  id="back"></a>
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
                        // $this.find('input').val('');
                        window.location.href = $("#back").attr('href');
                    } else {
                        // validationError.html(function() {
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
