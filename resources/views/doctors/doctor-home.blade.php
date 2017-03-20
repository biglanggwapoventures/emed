@extends('welcome') @section('body')
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
 
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title">
               <h2> <i class="fa fa-user-md" aria-hidden="true"></i>&nbsp  Dr.{{ $docs->userInfo->fullname() }}</h2>
            </h4>
           
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ " storage/{$docs->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"><br>
                <a href="{{ route('doctors.edit', ['id' => $docs->user_id]) }}"  class="btn btn-info btn-sm ">Edit Picture</a>
                </div>
                <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                        <tbody>
                        <tr>
                        @if(session('ACTION_RESULT'))
                        <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                            <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center">
                              {{ session('ACTION_RESULT')['message'] }}
                            
                            </div>
                          </div>
                        </div>
                      @endif
                        </tr>
                        <tr ><b><h3>Personal information</h3></tr></b></tr>
                            <tr>
                                <td><span class="glyphicon glyphicon-user"></span> &nbsp<b>Username:</b> <br> {{ $docs->userInfo->username }}</td>
                                <td><span class="glyphicon glyphicon-envelope"></span> <b>Email:</b> <br> {{$docs->userInfo->email}}</td>
                            </tr>

                            <tr>
                                <td><span class="glyphicon glyphicon-baby-formula"></span> <b>Date of Birth:</b><br> {{ $docs->userInfo->birthdate }}</td>
                                <td><i class="fa fa-venus-mars" aria-hidden="true"></i> &nbsp <b>Gender:</b> <br>{{ $docs->userInfo->sex }}</td>
                            </tr>
                            <tr>
                                <td><span class="glyphicon glyphicon-phone"></span> <b>Phone Number:</b> <br> {{ $docs->userInfo->contact_number }}</td>
                                <td><i class="fa fa-user-md" aria-hidden="true"></i></span> <b>Specialization:</b> <br> {{ $docs->specialization }}</td>
                          </tr>
                            <tr>
                                <td><span class="glyphicon glyphicon-home"></span> <b>Home Address:</b><br>{{ $docs->userInfo->address }}</td>
                                <td> <i class="fa fa-stethoscope" aria-hidden="true"></i> <strong>Subspecialty: </strong><br>
                                        {{ implode(',<br> ', $docs->subspecialty) }}<br>

                                </td>
                            </tr>

        

                                <tr >
                            <td>
                            <b><h3>Clinic Information</h3></td>
                            <td></td>
                            </tr>  
                            <tr>

                                <td><i class="fa fa-hospital-o" aria-hidden="true"></i></span> <b>Clinic:</b><br>{{ $docs->clinic }}</td>
                                <td><span class="glyphicon glyphicon-time"></span> &nbsp<b>Clinic Hours:</b><br>{{ $docs->clinic_hours }}</td>
                            </tr>
                            <tr>

                                <td><i class="fa fa-h-square" aria-hidden="true"></i><b>Clinic Address:</b><br>{{ $docs->clinic_address }}</td>
                                <td></td>
                            </tr>
                          
                            

                            <!-- medschool -->

                            <tr >
                            <td>
                            <b><h3>Education information</h3></td>
                            <td></td>
                            </tr>                            
                            <tr>
                                <td><span class="glyphicon glyphicon-education"></span> <b>Med School:</b><br>{{ $docs->med_school }}</td>
                                <td><i class="fa fa-calendar" aria-hidden="true"></i> <b>Med School year:</b><br>{{ $docs->med_school_year }}</td>
                      </tr>
                     
                      <tr>
                        <td><i class="fa fa-building" aria-hidden="true"></i><b>Residency:</b><br>{{ $docs->residency }}</td>
                                <td><b><i class="fa fa-calendar" aria-hidden="true"></i> Residency Year:</b><br>{{ $docs->residency_year }}</td>
                            </tr>

                            <tr>
                                <td><i class="fa fa-leanpub" aria-hidden="true"></i> <b>Training:</b><br>{{ $docs->training }}</td>
                                <td><i class="fa fa-calendar" aria-hidden="true"></i> <b>Training Year:</b><br>{{$docs->training_year }}</td>
                            </tr>
                          
                            <!-- med school end -->


                            <tr>
                                <td>
<i class="fa fa-sitemap" aria-hidden="true"></i>
                                    <strong>Affiliations and Organizations: </strong> <br>{{implode(',<br> ', $docs->affiliations) }} <br>

                                </td>
                                <td>

                                    
                                </td>
                            </tr>

                        </tbody>
                    </table>


                    
                    <a href="{{ route('patients.index') }}" class="btn btn-primary pull-right">Search Patients</a>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <a href="doctor-home" data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-arrow-left"></i></a>
            <span class="pull-right" style="margin-top: 8px;">
                            <a href="{{ route('doctors.edit', ['id' => $docs->user_id]) }}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            
                        </span>
        </div>
    </div>
</div>
<style type="text/css">
    table {
        border-collapse: collapse;
    }
    /* remove padding */
    
    td,
    th {
        padding: 0;
    }
    span{
        color: #346677;
    }
    .fa{
        color: #346677;
    }

</style>

@endsection
