@extends('welcome') 

@section('body')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" style="margin-top:100px">
                <thead>
                    <tr>
                        <th></th>
                        <th>Pharmacy</th>
                        <th>Branch</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($items AS $i)
                        <tr>
                            <td>
                                <a href="{{ route('pharmacy.edit', ['id' => $i->id]) }}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a href="" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td>{{ $i->name }}</td>
                            <td><ol><li>{!! implode('</li><li>', $i->branches) ?: '' !!}</li></ol></td>
                            
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
