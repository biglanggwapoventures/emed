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
			    	@forelse($docs AS $d)
			    		@if($d->userInfo->username === Auth::user()->username)
					    	<br>Name:</br>{{ $d->userInfo->fullname() }} <br>
					    	<br>Specialization:</br>{{ $d->specialization }} <br>
					    	<br>Name:</br>{{ $d->clinic }} <br>
					    @endif
					@empty
						<p>There are no users yet!</p>
					@endforelse
			    </div>
			</div>
		</div>
	</div>
</div>

@endsection