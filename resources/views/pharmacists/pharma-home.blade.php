@extends('welcome') @section('body')
<div class="content-wrapper">
    @if(session('ACTION_RESULT'))
    <div class="row">

        <div class="col-md-6 col-md-offset-3">
           <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                {{ session('ACTION_RESULT')['message'] }}
            </div>
        </div>
    </div>
    @endif
    <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>
           User Profile
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/pharma-home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pharma-home"><i class="fa fa-user"></i> {{ Auth::user()->fullname() }}</a></li>
            
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <center><img alt="User Pic" src="{{ "/storage/{$items->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>

                        <h3 class="profile-username text-center"> </h3>

                        <p class="text-muted text-center">{{ $items->userInfo->fullname() }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <b>{{ $items->userInfo->email }}</b>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-home" aria-hidden="true"></i><b>{{ $items->userInfo->address }}</b>
                                <li class="list-group-item">
                                    <center><a href="{{ route( 'patients.edit', [ 'id'=> $items->id]) }}" class= "btn btn-info"><i class="fa fa-pencil"></i> <span>Edit Profile</span></a></center>
                
                                </li>
                        </ul>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- tab start -->
                        <div class="active tab-pane" id="profile">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td><span class="glyphicon glyphicon-user"></span> &nbsp<b>Username</b> <br>{{ $items->userInfo->username }}</td>
                                        <td><span class="glyphicon glyphicon-envelope"></span> <b>Email</b> <br>{{$items->userInfo->email}}</td>
                                        <td><span class="glyphicon glyphicon-baby-formula"></span> <b>Date of Birth</b><br>{{ $items->userInfo->birthdate }}</td>
                                    </tr>

                                    <tr>
                                        <td><span class="glyphicon glyphicon-tint"></span> <b>Bloodtype</b> <br>{{ $items->bloodtype }}</td>
                                        <td><i class="fa fa-venus-mars" aria-hidden="true"></i> &nbsp <b>Gender</b> <br>{{ $items->userInfo->sex }}</td>
                                        <td><span class="glyphicon glyphicon-phone"></span> <b>Phone Number</b> <br>{{ $items->userInfo->contact_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-gavel" aria-hidden="true"></i><b>Civil Status</b> <br>{{ $items->civilstatus }}</td>
                                        <td><span class="glyphicon glyphicon-briefcase"></span> <b>Occuptation</b><br>{{ $items->occupation }}</td>
                                        <td><span class="glyphicon glyphicon-flag"></span> <b>Nationality</b><br>{{ $items->nationality }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>



<script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);
</script>
@endsection
