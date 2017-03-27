@extends('welcome') 

@section('body')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary pull-right" href="{{ route('specialization.create')}}" style="margin-top:100px"><span class="glyphicon glyphicon-plus"></span>Add Sub-specialization</a>
            <table class="table table-bordered" style="margin-top:100px">
                <thead>
                    <tr>
                        <th></th>
                        <th>Specialization</th>
                        <th>Subspecialization</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($items AS $i)
                        <tr>
                            <td>
                                <a href="{{ route('specialization.edit', ['id' => $i->id]) }}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a href="" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td>{{ $i->name }}</td>
                            <td>{{ implode(', ', $i->subs) ?: '-'}}</td>
                            
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>

		</div>
	</div>
</div>


@endsection

@push('scripts')
@endpush
