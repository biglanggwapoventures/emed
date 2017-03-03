@extends('welcome')

@section('body')
<div class="container-fluid">
	<div class="row-bod">
					
		<div class="col-md-9 col-md-offset-1">

			<h4 class="pull-left"><span class="glyphicon glyphicon-user"></span>Users</a></h4>

				<a class="btn btn-primary pull-right" href="{{ route('managers.create')}}"><span class="glyphicon glyphicon-plus"></span>Add Pharmacy Manager</a>
				<a class="btn btn-primary pull-right" href="{{ route('doctors.create')}}"><span class="glyphicon glyphicon-plus"></span>Add Doctor</a>	
			
			{{ csrf_field() }}

			<div class="tab-content">
			  <div id="users" class="tab-pane fade in active">
			    <table class="table">
					<thead>
						<tr class="active">
							<th>Last Name</th>
							<th>First Name</th>
							<th>Username</th>
							<th>User Type</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						@forelse($items AS $i)
							@if($i->user_type != "ADMIN")
							<tr>
								<td>{{ $i->lastname }}</td>
								<td>{{ $i->firstname }}</td>
								<td>{{ $i->username }}</td>
								<td>{{ $i->user_type }}</td>
								<td>
									<form action="{{ route('users.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
									</form>
									@if($i->user_type === "DOCTOR")
										<a href="{{ route('doctors.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
									@elseif($i->user_type === "PMANAGER")
										<a href="{{ route('managers.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
									@endif
								</td>
							</tr>
							@endif
						@empty
							<tr>
								<td colspan="4" class="text-center">No users recorded</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			  </div> 
			</div>
		</div>
	</div>
</div>

<center>{{ $items->links('vendor.pagination.custom') }}</center>
@endsection
