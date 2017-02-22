@extends('welcome')

@section('body')

<div class="container">
	<div class="row-bod">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Patients</h1>
			</div>


			<a class="btn btn-primary pull-right" href="{{ route('patients.create')}}">Add new patient</a>
			<table class="table">
				<thead>
					<tr class="active">
						<th>Name</th>
						<th>Lastname</th>
						<th>Address</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@forelse($items AS $i)
						<tr>
							<td>{{ $i->userInfo->fullname() }}, {{ $i->title}} </td>
							<td>{{ $i->userInfo->lastname }}</td>
							<td>{{ $i->userInfo->address}}</td>
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

							<td colspan="4" class="text-center">No patients recored</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection