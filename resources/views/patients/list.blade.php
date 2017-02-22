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
						<th>Username</th>
						<th>Doctor</th>
						<th>Manage</th>
					</tr>
				</thead>
				<tbody>
					@forelse($items AS $i)
						<tr>
							<td>{{ $i->userInfo->fullname()}}</td>
							<td>{{ $i->userInfo->username }}</td>
							<td>{{ $i->bloodtype}}</td>
							<td>
							
							<form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>

							
									<a href="{{ route('patients.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
								
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