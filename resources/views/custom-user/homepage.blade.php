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
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-drupal" style="font-size:135%!important"></span>
                &nbsp;{{ session('custom_role') }} Profile
            </span>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <center><img alt="User Pic" src="{{ "/storage/{$data->avatar}" }}" style="width: 150px; height: 150px" class="img-circle img-responsive" ><center>

                        <h3 class="profile-username text-center"> </h3>

                        <p class="text-muted text-center">{{ $data->fullname }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <b>{{ $data->email }}</b>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-home" aria-hidden="true"></i><b>{{ $data->address }}</b>
                                <li class="list-group-item">
                                    <center><a href="{{ url('custom-role/edit', $data->id) }}" class= "btn btn-info"><i class="fa fa-pencil"></i> <span>Edit Profile</span></a></center>
                
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
                <div class="nav-tabs-custom" style="padding-top: 12px">
                  
                       <h1 style="margin-top: 2px; margin-left: 15px;">Profile</h1>
               
                    <div class="tab-content">
                        <!-- tab start -->
                        <div class="active tab-pane" id="activity">
                            <table class="table table-user-information">
                                <tbody>


                                    <tr>
                                        <td><span class="glyphicon glyphicon-user"></span> &nbsp;<b>Username</b> <br>{{ $data->username }}</td>
                                        <td><span class="glyphicon glyphicon-envelope"></span> <b>Email</b> <br>{{$data->email}}</td>
                                        <td><span class="glyphicon glyphicon-baby-formula"></span> <b>Date of Birth</b><br>{{ $data->birthdate }}</td>
                                    </tr>

                                    <tr>
                                        <td><span class="glyphicon glyphicon-tint"></span> <b>Bloodtype</b> <br>{{ $data->bloodtype }}</td>
                                        <td><i class="fa fa-venus-mars" aria-hidden="true"></i> &nbsp; <b>Gender</b> <br>{{ $data->sex }}</td>
                                        <td><span class="glyphicon glyphicon-phone"></span> <b>Phone Number</b> <br>{{ $data->contact_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-gavel" aria-hidden="true"></i><b>Civil Status</b> <br>{{ $data->civilstatus }}</td>
                                        <td><span class="glyphicon glyphicon-briefcase"></span> <b>Occuptation</b><br>{{ $data->occupation }}</td>
                                        <td><span class="glyphicon glyphicon-flag"></span> <b>Nationality</b><br>{{ $data->nationality }}</td>
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
<style type="text/css">
    .img-circle {
    border-radius: 50%;
    margin-left: 39px;
}
</style>

<style type="text/css">
    .alert {
    position:absolute;
    z-index:1;
    margin-bottom: : 30px;
    width: 500px;
}
</style>
@endsection
