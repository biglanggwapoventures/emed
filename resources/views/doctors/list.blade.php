@extends('welcome')

@section('body')

<div class="container">
	<div class="row-bod">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Doctors</h1>
			</div>


			<a class="btn btn-primary pull-right" href="{{ route('doctors.create')}}">Add new doctor</a>
			<table class="table">
				<thead>
					<tr class="active">
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Specialization</th>
						<th>License</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@forelse($items AS $i)
						<tr>
							<td>{{ $i->userInfo->firstname }}</td>
							<td>{{ $i->userInfo->lastname }}</td>
							<td>{{ $i->specialization }}</td>
							<td>{{ $i->license }}</td>
							<td>
								<form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>
								<a href="{{ route('doctors.edit', ['id' => $i->id]) }}" class="btn btn-info">Edit</a>
							</td>
						</tr>
					@empty
						<tr>

							<td colspan="4" class="text-center">No doctors recored</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- <div class="modal fade" id="add-doctor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add new doctor</h4>
			</div>
			<form  action="{{ route('doctors.store') }}" class="ajax">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="alert alert-danger hidden"></div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>First name</label>
								<input type="text" name="firstname" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Last name</label>
								<input type="text" name="lastname" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Specialization</label>
						<input type="text" name="specialization" class="form-control">
					</div>
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			</form>
		</div>
	</div>
</div> -->

@endsection

