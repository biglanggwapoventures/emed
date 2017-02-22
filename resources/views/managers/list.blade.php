@extends('welcome')

@section('body')

<div class="container">
	<div class="row-bod">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Pharmacy Manager</h1>
			</div>


			<a class="btn btn-primary pull-right" href="{{ route('managers.create')}}">Add new pharmacy manager</a>
			<table class="table">
				<thead>
					<tr class="active">
						<th>Firstname</th>
						<th>Lastname</th>
						<th>License</th>
						<th>Drugstore</th>

						<th></th>
					</tr>
				</thead>
				<tbody>
					@forelse($items AS $i)
						<tr>
							<td>{{ $i->userInfo->firstname }}</td>
							<td>{{ $i->userInfo->lastname }}</td>
							<td>{{ $i->license}}</td>
							<td>{{ $i->drugstore}}</td>

							<td>
							<div class="row">
							<div class="col-md-2">
								<form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger">Delete</button>

								</form></div>
							
								<div class="col-md-2">
								<form>
									<button type="submit" class="btn btn-success">Edit</button>
								</form>
								</div>
								</div>
							</td>
						</tr>
					@empty
						<tr>

							<td colspan="4" class="text-center">No pharmacy managers recored</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection