@extends('welcome')

@section('body')
<div class="container-fluid">
	<div class="row-bod">
		
<div class="col-md-9 col-md-offset-1">
    			<div class="panel panel-default"> 
			    	<div class="panel-heading">
			    		<h4 class="panel-title"><i class="glyphicon glyphicon-user"></i> Welcome Dr. {{ Auth::user()->fullname() }} </h4>
			    	</div>
					<div class="panel-body">
					
							<strong>Personal Info</strong><a href="#" class="btn btn-info  pull-right"><span class="glyphicon glyphicon-edit"></a><br>
							<hr class="third">
							<b>Fullname:</b> {{ Auth::user()->fullname() }} <br>
							<b>Username:</b> {{ Auth::user()->username }} &nbsp <b>Email Address</b> {{Auth::user()->email}}<br>
							<b>Contact number</b> {{Auth::user()->contact_number}}<br> 

								@forelse($items AS $i)
						<tr>
							<td>{{ $i->userInfo->fullname() }}, {{ $i->title}} </td>
							<td>{{ $i->clinic }}</td>
							<td>{{ $i->userInfo->username }}</td>
							<td>
								<form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
								</form>
								<a href="{{ route('doctors.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
								<!-- <a href="{{ route('doctors.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></a> -->
							</td>
						</tr>
					@empty
						<tr>

							<td colspan="4" class="text-center">No doctors recorded</td>
						</tr>
					@endforelse
						
							
		</div>
					</div>
					</div>
					</div>

@endsection