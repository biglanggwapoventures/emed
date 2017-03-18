@extends('welcome') @section('body')

<div class="container-fluid"><br><br><br>
  @if(session('ACTION_RESULT'))
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center">
          {{ session('ACTION_RESULT')['message'] }}
        </div>
      </div>
    </div>
  @endif

 <div class="tab_container">
       <input id="tab1" type="radio" name="tabs" checked>
      <label for="tab1"><i class="fa fa-code"></i><span>Profile</span></label>

      <input id="tab2" type="radio" name="tabs">
      <label for="tab2"><i class="fa fa-pencil-square-o"></i><span>Medical Profile</span></label>

      <input id="tab3" type="radio" name="tabs">
      <label for="tab3"><i class="fa fa-bar-chart-o"></i><span>Prescriptions</span></label>

      <input id="tab4" type="radio" name="tabs">
      <label for="tab4"><i class="fa fa-folder-open-o"></i><span>Doctors</span></label>

      <input id="tab5" type="radio" name="tabs">
      <label for="tab5"><i class="fa fa-envelope-o"></i><span>Consultation</span></label>


      <section id="content1" class="tab-content">

        <a href="{{ route('patients.edit', ['id' => $patients->id]) }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-edit"></a>
    <div class="row">
      <div class="left">
         <img alt="User Pic" src="{{ " /storage/{$patients->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive">
      </div>
      <div class="right">
                            
                    <p class="name">{{ $patients->userInfo->fullname() }} </p><br>
                   <p class="email" > {{$patients->userInfo->email}}</p><br>
                   <p class="address"></b> {{ $patients->userInfo->address }}</p><br> 
                    <b>Username:</b> {{ $patients->userInfo->username }} &nbsp &nbsp
                    <b>Contact number:</b> {{ $patients->userInfo->contact_number}}<br>
                    <b>Gender:</b> {{ $patients->userInfo->sex }}<br>

                     <b>Occupation:</b> {{ $patients->occupation }} <br>
                    <b>Bloodtype:</b> {{ $patients->bloodtype }} <br>  
                    <b>Nationality:</b> {{$patients->nationality}}<br>
                    <b>Civil Status:</b> {{ $patients->civilstatus}}<br>
                    <b>Emergency Contact:</b> {{ $patients->econtact }}<br>
                    <b>Relationship:</b> {{ $patients->erelationship }}<br>
                     <b>Contact number:</b> {{ $patients->enumber }}<br>
      </div>
        
                
                
                  
</div>
     
      </section>

      <section id="content2" class="tab-content">
        <a href="{{ route('patients.edit', ['id' => $patients->id]) }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-edit"></a>
        <h3>Medical Info</h3>
            <div class="medicalinfo">
  <br>
              <b>Allergy question:</b> {{ $patients->allergyquestion }} <br>
                    <b>Allergic to:</b> <br>{{ $patients->allergyname }} <br>  
                    <b>Disease History:</b> {{$patients->past_disease}}<br>
                    <b>Surgery History:</b> {{ $patients->past_surgery}}<br>
                    <b>Immunization:</b> {{ $patients->immunization }}<br><br><br>
                     <b>Family History:</b> {{ $patients->family_history }}<br><br><br>
</div>

      </section>

      <section id="content3" class="tab-content">
      <h3>Weed and other drugs</h3><br>
              <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
      </section>

      <section id="content4" class="tab-content">
        <h3>Headline 4</h3>
            <p>tab 4 Content</p>
      </section>

      <section id="content5" class="tab-content">
          
               <a href="{{ route('consultations.index', ['patient_id' =>  $patients->id]) }}" class="btn btn-info pull-left"><span class="glyphicon glyphicon-plus"></span> Consultation</a><br>
              <table class="table">
                <thead>
                  <tr class="active">
                    <th>Consultation Date</th>
                    <th>Doctor</th>
                    <th>Clinic</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($patients->consultations AS $a)
                    <tr>
                      <td>{{ $a->created_at }}</td>
                      <td>{{ $a->doctor->userInfo->fullname() }}</td>
                      <td>{{ $a->doctor->clinic_address }}</td>
                      <td>  

                         <form action="{{ route('consultations.destroy', ['patient_id' => $patients->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                          </form>

                              <a href="{{ route('prescription.index', ['patient_id' => $patients->id]) }}"  class="btn btn-info"><span class="glyphicon glyphicon-plus">prescription</a>
                              
                          <button 
                          type="button" 
                          class="btn btn-warning btn-default-sm" 
                          data-toggle="modal" 
                          data-target="#infoModal_{{ $patients->id }}">
                          <span class="glyphicon glyphicon-info-sign">
                          </button>

                          <div class="modal fade" id="infoModal_{{ $patients->id }}" 
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
                                  id="favoritesModalLabel">{{ $patients->userInfo->fullname() }}</h4>
                                </div>
                            <div class="modal-body">
                              <table class="table table-user-information">
                                <tbody>
                                  <tr>
                                    <td><b>Weight:</b>&#09;{{ $a->weight }}   kgs</td>
                                  </tr>
                                  <tr>
                                    <td><b>Height:</b>&#09;{{ $a->height }}  cm</td>
                                  </tr>
                                  <tr>
                                    <td><b>Blood Pressure:</b>&#09;{{ $a->bloodpressure}}  mmHg</td>
                                  </tr>
                               
                                     <tr>
                                    <tr>
                                    <td><b>Temperature:</b>&#09;{{ $a->temperature }}  C</td>
                                  </tr>
                                  <tr>
                                    <td><b>Pulse Rate:</b>&#09;{{ $a->pulserate }}  bpm</td>
                                  </tr>
                                    <td><b>Respiratory Rate:</b>&#09;{{ $a->resprate }}  cpm<br>
                                    </td>
                                     <tr>
                                    <td><b>Chief Complaints:</b>&#09;<br>{{ $a->chiefcomplaints }}</td>
                                  </tr>
                                    <td><b>Notes:</b><br>{{ $a->notes }}</td>
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
                    @empty
                        <tr>
                          <td colspan="4" class="text-center">No consultations recorded</td>
                        </tr>
                @endforelse
                </tbody>
              </table>
        

      </section>
    </div>

    <style type="text/css">
      .img-circle {
    border-radius: 50%;
    margin-left: 30px;
    margin-top: 30px;
}
.medicalinfo{

  margin-left: 60px;
}
.address{
  font-size: 15px;
   margin: -27px 0 10px;
}
.email{
  font-size: 20px;
}
.name{

  font-size: 30px;
}
.left{

  background-color: white;
  width: 220px;
  height: 380px;
}

.right {
    background-color: white;
    width: 600px;
    height: 357px;
    margin-left: 229px;
    margin-top: -358px;
}
      *,
*:after,
*:before {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.clearfix:before,
.clearfix:after {
  content: " ";
  display: table;
}

.clearfix:after {
  clear: both;
}

p {
    margin: -35px 0 10px;
}

a {
  color: #ccc;
  text-decoration: none;
  outline: none;
}

/*Fun begins*/
.tab_container {
    width: 90%;
    margin: 0 auto;
    padding-top: 10px;
    position: relative;
    margin-left: 22px;
}

input, section {
  clear: both;
  padding-top: 10px;
  display: none;
}

label {
  font-weight: 700;
  font-size: 18px;
  display: block;
  float: left;
  width: 20%;
  padding: 1.5em;
  color: #757575;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
  background: #f0f0f0;
}

#tab1:checked ~ #content1,
#tab2:checked ~ #content2,
#tab3:checked ~ #content3,
#tab4:checked ~ #content4,
#tab5:checked ~ #content5 {
  display: block;
  padding: 20px;
  background: #fff;
  color: #999;
  border-bottom: 2px solid #f0f0f0;
}

.tab_container .tab-content p,
.tab_container .tab-content h3 {
  -webkit-animation: fadeInScale 0.7s ease-in-out;
  -moz-animation: fadeInScale 0.7s ease-in-out;
  animation: fadeInScale 0.7s ease-in-out;
}
.tab_container .tab-content h3  {
  text-align: center;
}

.tab_container [id^="tab"]:checked + label {
  background: #fff;
  box-shadow: inset 0 3px #0CE;
}

.tab_container [id^="tab"]:checked + label .fa {
  color: #0CE;
}

label .fa {
  font-size: 1.3em;
  margin: 0 0.4em 0 0;
}

/*Media query*/
@media only screen and (max-width: 930px) {
  label span {
    font-size: 14px;
  }
  label .fa {
    font-size: 14px;
  }
}

@media only screen and (max-width: 768px) {
  label span {
    display: none;
  }

  label .fa {
    font-size: 16px;
  }

  .tab_container {
    width: 98%;
  }
}

/*Content Animation*/
@keyframes fadeInScale {
  0% {
    transform: scale(0.9);
    opacity: 0;
  }
  
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

body {
    font-family: sans-serif;
    background: #346677;
    color: #000;
}

#tab1:checked ~ #content1, #tab2:checked ~ #content2, #tab3:checked ~ #content3, #tab4:checked ~ #content4, #tab5:checked ~ #content5 {
    display: block;
    padding: 20px;
    background: #fff;
    color: #000;
    border-bottom: 2px solid #f0f0f0;
}

    </style>
    
@endsection
