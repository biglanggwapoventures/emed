@extends('welcome')

@section('body')
<div class="container-fluid"><br><br><br>
<div class="container">
        <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#profile">Consultation</a></li>
    <li><a data-toggle="tab" href="#menu1">General Info</a></li>
    <li><a data-toggle="tab" href="#menu2">Vitals</a></li>
    <li><a data-toggle="tab" href="#menu3">Prescription</a></li>
  </ul>

  <div class="tab-content">
    <div id="profile" class="tab-pane fade in active">
      <a href="{{ route('patients.edit', ['id' => $items->id]) }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-edit"></a><br>
              <hr class="third">
             
              <img alt="User Pic" src="{{ "/storage/{$items->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive">
              <br><br>

                 <div class="col-md-3 patprof">
                 
              <b>Fullname:</b> {{ $items->userInfo->fullname() }} <br>
              <b>Username:</b> {{ $items->userInfo->username }} &nbsp <b>Email Address</b> {{Auth::user()->email}}<br>
              <b>Contact number</b> {{ $items->userInfo->contact_number}}<br>
              <b>Gender</b> {{ $items->userInfo->sex }}<br><br><br>
              </div>

    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Headache and shit stuff lyk dat</h3>
       <p>Mother fuvkcing peacce of shit fvk y u no commit.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>stuff here like omg</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Weed and other drugs</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>

</div>
  </div>

@endsection