@extends('welcome')

@section('body')
<div class="container-fluid">
	<div class="row-bod">
		<div class="col-md-9 col-md-offset-1">
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#users">Users</a></li>
			  <li><a data-toggle="tab" href="#register">Register</a></li>
			</ul>

			<div class="tab-content">
			  <div id="users" class="tab-pane fade in active">
			    <table class="table">
					<thead>
						<tr class="active">
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
							<th>User Type</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						@forelse($items AS $i)
							<tr>
								<td>{{ $i->firstname }}</td>
								<td>{{ $i->lastname }}</td>
								<td>{{ $i->username }}</td>
								<td>{{ $i->user_type }}</td>
								<td>
									<form action="{{ route('users.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
									</form>
									<a href="{{ route('doctors.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
								</td>
							</tr>
						@empty
							<tr>

								<td colspan="4" class="text-center">No doctors recorded</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			  </div>
			  <div id="register" class="tab-pane fade">
			    <p>Some content in menu 1.</p>
			  </div>
			</div>
		</div>
	</div>
</div>


@endsection
