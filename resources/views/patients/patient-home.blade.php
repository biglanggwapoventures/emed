@extends('welcome')

@section('body')
<div class="container-fluid">
<div class="container">
  <h2>Welcome  {{ Auth::user()->fullname() }} </h2>
  <!-- <p>To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a div element with class .tab-content.</p> -->

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
    <li><a data-toggle="tab" href="#menu1">Prescription</a></li>
    <li><a data-toggle="tab" href="#menu2">Doctors</a></li>
    <li><a data-toggle="tab" href="#menu3">Medical Profile</a></li>
  </ul>

  <div class="tab-content">
    <div id="profile" class="tab-pane fade in active">
      <strong>Personal Info</strong><a href="#" class="btn btn-info  pull-right"><span class="glyphicon glyphicon-edit"></a><br>
							<hr class="third">
							<b>Fullname:</b> {{ Auth::user()->fullname() }} <br>
							<b>Username:</b> {{ Auth::user()->username }} &nbsp <b>Email Address</b> {{Auth::user()->email}}<br>
							<b>Contact number</b> {{Auth::user()->contact_number}}<br>
              <b>Gender</b> {{Auth::user()->sex}}<br>

    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>

	<!-- <div class="row-bod">
		
<div class="col-md-9 col-md-offset-1">
    			<div class="panel panel-default"> 
			    	<div class="panel-heading">
			    		<h4 class="panel-title"><i class="glyphicon glyphicon-user"></i> Welcome  {{ Auth::user()->fullname() }} </h4>
			    	</div>
					<div class="panel-body">
					
							<strong>Personal Info</strong><a href="#" class="btn btn-info  pull-right"><span class="glyphicon glyphicon-edit"></a><br>
							<hr class="third">
							<b>Fullname:</b> {{ Auth::user()->fullname() }} <br>
							<b>Username:</b> {{ Auth::user()->username }} &nbsp <b>Email Address</b> {{Auth::user()->email}}<br>
							<b>Contact number</b> {{Auth::user()->contact_number}}<br>

							
		</div>
					</div>
					</div> -->
					</div>

@endsection