@extends('welcome') 

@section('body')

<div class="container-fluid">
    <div class="row-bod">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="glyphicon glyphicon-user"></i> Pharmacy</h4>
                </div>
                <div class="panel-body">
                    @if($data->id)
                        {!! Form::open(['url' => route('pharmacy.update', ['id' => $data->id]), 'method' => 'PATCH', 'id' => 'pharm']) !!}
                    @else
                        {!! Form::open(['url' => route('pharmacy.store'), 'method' => 'POST', 'id' => 'pharm']) !!}
                    @endif
                        <div class="alert alert-danger hidden"></div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::bsText('name', 'Name', $data->name) !!}
                                <div class="form-group">
                                    <label for="">Branche(s)</label>
                                     <table class="table">
                                        <tbody>
                                            @php
                                                $branches = count($data->branches) ? $data->branches : [''];
                                            @endphp
                                            @foreach($branches AS $branch)
                                                <tr>
                                                    <td>{!! Form::text('branches[]', $branch, ['class' => 'form-control']) !!}</td>
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
                        <a href="{{ route('pharmacy.index') }}" class="btn btn-default" id="back">Back</a>
                    {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-line').click(function(){
                var clone = $('#pharm table tbody tr:first').clone();
                clone.find('input').val('');
                clone.appendTo('#pharm table tbody');
            })

            $('#pharm').on('click', '.remove-line', function(){
                var rows = $('#pharm table tbody tr').length;
                if(rows === 1){
                    $(this).closest('tr').find('input').val('');
                    return;
                }
                $(this).closest('tr').remove();
            });


            $('#pharm').submit(function(e){
                e.preventDefault();
                var $this = $(this)
                    submitBtn = $this.find('[type=submit]'),    
                    alert = $this.find('.alert.alert-danger');

                alert.addClass('hidden');
                submitBtn.addClass('disabled');

                $.post($this.attr('action'), $this.serialize())
                    .done(function(res) {
                        if(res.result){
                            window.location.href = $("#back").attr('href'); 
                        }else{
                            alert.html(function(){
                                return '<ul class="list-unstyled"><li>'+res.errors.join('</li><li>')+'</li><ul>';
                            }).removeClass('hidden');
                        }
                    })
                    .fail(function(){
                        alert('An internal server error has occured!');
                    })
                    .always(function(){
                        submitBtn.removeClass('disabled');
                    })
                
            })
        })
    </script>
@endpush
