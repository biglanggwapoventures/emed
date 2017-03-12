@extends('welcome')

@section('body')

<div class="container">
	<div class="row-bod">
		<div class="col-md-12">
			<div class="page-header">
				<h1>PATIENTS</h1>
			</div>

        <div class="col-md-6">
        		{!! Form::open(['method'=>'GET','url'=>'patients','class'=>'navbar-form navbar-left','role'=>'search']) !!}
						<div class="input-group custom-search-form">
							{!! Form::text('search', request()->input('search'), ['placeholder' => 'Search', 'class' => 'form-control']) !!}
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default-sm">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
				{!! Form::close() !!}
		</div>

         <a class="btn btn-primary pull-right" href="{{ route('patients.create')}}">Add new patient</a> 
       <!-- <form class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>
        -->

			<table class="table">
				<thead>
					<tr class="active">
						<th>Name</th>
						<th>Username</th>
						<th>Bloodtype</th>
						<th>Manage</th>
					</tr>
				</thead>
				<tbody>
				
					@forelse($patients AS $patient)
						<tr>
							<td>{{ $patient->userInfo->fullname() }}</td>
							<td>{{ $patient->userInfo->username }}</td>
							<td>{{ $patient->bloodtype }}</td>
							<td>	
								<form action="{{ route('users.destroy', ['id' => $patient->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
									<a href="{{ route('patients.edit', ['id' => $patient->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
									<a href="{{ route('patients.show', ['id' => $patient->id]) }}" class="btn btn-warning">View Patient</a>
								</form>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4" class="text-center">No patients recorded</td>
						</tr>
					@endforelse

				</tbody>
			</table>
		</div>
	</div>
</div>
<center>{{ $patients->links('vendor.pagination.custom') }}</center>
<!-- {{ $patients->appends(Request::except('page'))->links() }}  -->

@endsection