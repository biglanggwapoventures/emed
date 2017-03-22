s@extends('welcome') @section('body')

<div class="container-fluid">
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
        <label for="tab2"><i class="fa fa-drivers-license-o"></i><span>Medical Profile</span></label>


        <input id="tab3" type="radio" name="tabs">
        <label for="tab3"><i class="fa fa-pencil"></i><span>Prescriptions</span></label>

        <input id="tab4" type="radio" name="tabs">
        <label for="tab4"><i class="fa fa-user-md"></i><span>Doctors</span></label>

        <input id="tab5" type="radio" name="tabs">
        <label for="tab5"><i class="fa fa-envelope-o"></i><span>Consultation</span></label>


        <section id="content1" class="tab-content">

            <a href="{{ route('patients.edit', ['id' => $items->id]) }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-edit"></a>
            <div class="row">
                <div class="left">
                    <img alt="User Pic" src="{{ " /storage/{$items->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive">
                </div>
                <div class="right">
                    <table class="table table-user-information">
                        <tbody>
                            <tr>

                                <td>
                                    <p class="name">{{ $items->userInfo->fullname() }} </p><br>
                                    <p class="email"> <i class="fa fa-envelope"></i> &nbsp {{$items->userInfo->email}}</p><br>
                                    <p class="address">
                                        </b><i class="fa fa-home"></i> &nbsp {{ $items->userInfo->address }}</p><br>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><span class="glyphicon glyphicon-user"></span> &nbsp<b>Username</b> <br> {{ $items->userInfo->username }} </td>
                                <td><span class="glyphicon glyphicon-envelope"></span> <b>Email</b> <br> {{$items->userInfo->email}}</td>
                                <td><span class="glyphicon glyphicon-baby-formula"></span> <b>Date of Birth</b><br> {{ $items->userInfo->birthdate }}</td>
                            </tr>

                            <tr>
                                <td><span class="glyphicon glyphicon-tint"></span> <b>Bloodtype</b> <br> {{ $items->bloodtype }}</td>
                                <td><i class="fa fa-venus-mars" aria-hidden="true"></i> &nbsp <b>Gender</b> <br>{{ $items->userInfo->sex }}</td>
                                <td><span class="glyphicon glyphicon-phone"></span> <b>Phone Number</b> <br> {{ $items->userInfo->contact_number }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-gavel" aria-hidden="true"></i> <b>Civil Status</b> <br> {{ $items->civilstatus }}</td>
                                <td><span class="glyphicon glyphicon-briefcase"></span> <b>Occuptation</b><br>{{ $items->occupation }}</td>
                                <td><span class="glyphicon glyphicon-flag"></span> <b>Nationality</b><br>{{ $items->nationality }}</td>
                            </tr>






                            <!-- medschool -->


                        </tbody>
                    </table>




                </div>

        </section>


        <section id="content2" class="tab-content">
            <a href="{{ route('patients.edit', ['id' => $items->id]) }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-edit"></a>



            <div class="medicalinfo">
                <br>
                <table class="table table-user-information">
                    <tbody>

                        <tr>
                            <td>
                                <h3 class="pull-left">Medical Info</h3>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-question" aria-hidden="true"></i> <b>Do you have allergies? Y/N :</b><br>&nbsp {{ $items->allergyquestion }} </td>
                            <td><i class="fa fa-bug" aria-hidden="true"></i> <b>Allergic to:</b> <br>{{ $items->allergyname }} </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><i class="fa fa-wheelchair" aria-hidden="true"></i> <b>Past Diseases :</b><br>&nbsp {{$items->past_disease}} </td>
                            <td><i class="fa fa-heart" aria-hidden="true"></i> <b>Past Surgeries:</b> <br> {{ $items->past_surgery}} </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><i class="fa fa-plus-square" aria-hidden="true"></i> <b>Immunizations :</b><br>&nbsp{{ $items->immunization }}</td>
                            <td><i class="fa fa-user-circle-o" aria-hidden="true"></i> <b>Family History:</b> <br>{{ $items->family_history }} </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <h3 class="pull-left">Incase of Emergency</h3>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span> <b>Contact</b> <br> {{ $items->econtact }}</td>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> <b>Contact Number</b><br>{{ $items->enumber }}</td>
                            <td><i class="fa fa-gratipay" aria-hidden="true"></i></span> <b>Relationship</b><br>{{ $items->erelationship }}</td>
                        </tr>



                    </tbody>
                </table>
        </section>

        <section id="content3" class="tab-content">

            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i>Prescriptions</h4>
                </div>

                <div class="panel-body  ">
                    <div class="col-md-2 ">
                        <img alt="User Pic" src="{{ " /images/rx.png " }}" style="width: 150px; height: 150px;">
                    </div>
                    <table class="fix">
                        <thead>
                            <tr class="active">
                                <th>Doctor</th>
                                <th>Generic Name</th>
                                <th>Brand Name</th>
                                <th>Dosage</th>
                                <th>Frequency</th>
                                <th>Available</th>
                                <th>Start</th>
                                <th>End</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items->prescriptions AS $consultation)
                            <tr>
                                <td>{{ $consultation->doctor->userInfo->fullname() }}</td>
                                <td>{{ $consultation->genericname }}</td>
                                <td>{{ $consultation->brand }}</td>
                                <td>{{ $consultation->dosage }}</td>
                                <td>{{ $consultation->frequency }}</td>
                                <td>{{ $consultation->quantity }}</td>
                                <td>{{ $consultation->start }}</td>
                                <td>{{ $consultation->end }}</td>
                            </tr>
                            @empty @endforelse
                        </tbody>
                    </table>


                </div>
                <!-- end of panelbody -->
                <button type="submit" class="btn btn-primary pull-right">View All prescription history</button>

            </div>

        </section>

        <section id="content4" class="tab-content">
            <table class="table">
                <thead>
                    <tr class="active">
                        <th>Name</th>
                        <th>Specialization</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items->doctors AS $item)
                    <tr>
                        <td>{{ $item->userInfo->fullname()}}</td>
                        <td>{{ $item->specialization }}</td>
                        <td>{{ $item->clinic_address }}</td>

                        <td>
                            <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#infoModal_{{ $item->id }}">
                                              <span class="glyphicon glyphicon-info-sign">
                                    </button>
                            <div class="modal fade" id="infoModal_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="favoritesModalLabel">{{ $item->userInfo->fullname() }}, {{ $item->title }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-user-information">
                                                <center><img alt="User Pic" src="{{ " storage/{$item->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>
                                                <tbody>
                                                    <tr>
                                                        <td><b>Clinic:</b>&#09;{{ $item->clinic }}, {{ $item->clinic_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Gender:</b>&#09;{{ $item->userInfo->sex}} </td>
                                                    </tr>

                                                    <tr>
                                                        <tr>
                                                            <td><b>Clinic Hours:</b>&#09;{{ $item->clinic_hours }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Email:</b>&#09;{{ $item->userInfo->email }}</td>
                                                        </tr>
                                                        <td><b>Phone Number:</b>&#09;{{ $item->userInfo->contact_number }}<br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>PRC License:</b>&#09;{{ $item->prc }}<br>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No doctors recorded</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <section id="content5" class="tab-content">

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
                    @forelse($items->consultations AS $a)
                    <tr>
                        <td>{{ $a->created_at }}</td>
                        <td>{{ $a->doctor->userInfo->fullname() }}</td>
                        <td>{{ $a->doctor->clinic }}</td>
                        <td>


                            <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#infoModals_{{ $items->id }}">
                          <span class="glyphicon glyphicon-info-sign">
                          </button>

                            <div class="modal fade" id="infoModals_{{ $items->id }}" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="favoritesModalLabel">{{ $items->userInfo->fullname() }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <td><b>Weight:</b>&#09;{{ $a->weight }} kgs</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Height:</b>&#09;{{ $a->height }} cm</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Blood Pressure:</b>&#09;{{ $a->bloodpressure}} mmHg</td>
                                                    </tr>

                                                    <tr>
                                                        <tr>
                                                            <td><b>Temperature:</b>&#09;{{ $a->temperature }} C</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Pulse Rate:</b>&#09;{{ $a->pulserate }} bpm</td>
                                                        </tr>
                                                        <td><b>Respiratory Rate:</b>&#09;{{ $a->resprate }} cpm<br>
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
            
            .medicalinfo {
                margin-left: 60px;
            }
            
            .address {
                font-size: 15px;
                margin: -27px 0 10px;
            }
            
            .email {
                font-size: 20px;
            }
            
            .name {
                font-size: 30px;
            }
            
            .left {
                background-color: white;
                width: 220px;
                height: 360px;
            }
            
            .right {
                background-color: white;
                width: 750px;
                height: 360px;
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
            
            input,
            section {
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
            
            #tab1:checked~#content1,
            #tab2:checked~#content2,
            #tab3:checked~#content3,
            #tab4:checked~#content4,
            #tab5:checked~#content5 {
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
            
            .tab_container .tab-content h3 {
                text-align: center;
            }
            
            .tab_container [id^="tab"]:checked+label {
                background: #fff;
                box-shadow: inset 0 3px #0CE;
            }
            
            .tab_container [id^="tab"]:checked+label .fa {
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
                /* background: #346677;*/
                color: #000;
            }
            
            #tab1:checked~#content1,
            #tab2:checked~#content2,
            #tab3:checked~#content3,
            #tab4:checked~#content4,
            #tab5:checked~#content5 {
                display: block;
                padding: 20px;
                background: #fff;
                color: #000;
                border-bottom: 2px solid #f0f0f0;
            }
            
            td {
                width: 8%;
            }
            
            .panel-primary {
                border-color: #ffffff;
                width: 969px;
                margin-left: 59px;
            }
            
            .fix {
                width: 83%;
                max-width: 100%;
                margin-bottom: 20px;
            }

        </style>

        <!--  <script type="text/javascript">
      setTimeout(function() {
   $("#alert").delay(3200).fadeOut(300)

}
    </script>
     -->
        @endsection
