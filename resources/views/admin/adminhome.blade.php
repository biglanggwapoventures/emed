@extends('welcome')

@section('body')
<div class="container-fluid">
	<div class="row-bod">
					
		<div class="col-md-9 col-md-offset-1">

			<h4 class="pull-left"><span class="glyphicon glyphicon-user"></span>Users</a></h4>
				<div class="col-md-6">
					{!! Form::open(['method'=>'GET','url'=>'admin','class'=>'navbar-form navbar-left','role'=>'search']) !!}
						{!! Form::select('user_type', ['' => '**ALL**', 'DOCTOR' => 'Doctors', 'PMANAGER' => 'Pharmacy Manager','PATIENT' => 'Patient','PHARMA' => 'Pharmacist','SECRETARY' => 'Secretary'], request()->input('user_type'), ['class' => 'form-control']) !!}
						<div class="input-group custom-search-form pull-right">
							{!! Form::text('search', request()->input('search'), ['placeholder' => 'Search', 'class' => 'form-control']) !!}
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default-sm">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
					
					{!! Form::close() !!}
				</div>
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
									@else
										<button type="button" class="btn btn-info" disabled><span class="glyphicon glyphicon-edit"></button>
									@endif

										
									<button 
											   type="button" 
											   class="btn btn-warning btn-default-sm" 
											   data-toggle="modal" 
											   data-target="#infoModal_{{ $i->id }}">
											  <span class="glyphicon glyphicon-info-sign">
										</button>

										<div class="modal fade" id="infoModal_{{ $i->id }}" 
									     tabindex="-1" role="dialog" 
									     aria-labelledby="favoritesModalLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" 
									          data-dismiss="modal" 
									          aria-label="Close">
									          <span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" 
									        id="favoritesModalLabel">{{ $i->fullname() }}</h4>
									      </div>
									      <div class="modal-body">
									        <table class="table table-user-information">
									        <center><img alt="User Pic" src="{{ "storage/{$i->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>
						                    <tbody>
						                      <tr>
						                        <td><b>Username:</b>&#09;{{ $i->username }}</td>
						                      </tr>
						                      <tr>
						                        <td><b>Date of Birth:</b>&#09;{{ $i->birthdate }}</td>
						                      </tr>
						                      <tr>
						                        <td><b>Gender:</b>&#09;{{ $i->sex}} </td>
						                      </tr>
						                   
						                         <tr>
						                        <tr>
						                        <td><b>Home Address:</b>&#09;{{ $i->address }}</td>
						                      </tr>
						                      <tr>
						                        <td><b>Email:</b>&#09;{{ $i->email }}</td>
						                      </tr>
						                        <td><b>Phone Number:</b>&#09;{{ $i->contact_number }}<br>
						                        </td>
						                      </tr>
						                     
						                    </tbody>
						                  </table>
									      </div>
									      <div class="modal-footer">
									      	<span class="pull-right">
									        <button type="button" 
									           class="btn btn-default" 
									           data-dismiss="modal">Close</button>
									        </span>
									      </div>
									    </div>
									  </div>
									</div>

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


<style type="text/css">
	
	
.col-md-offset-1 {
    margin-left: 8.33333333%;
    background-color: whitesmoke;
    border-radius: 14px;
}
</style>

@endsection
