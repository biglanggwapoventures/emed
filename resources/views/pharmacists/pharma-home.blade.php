@extends('welcome') @section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                   <a href="{{ url(session('homepage') . '') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">{{ Auth::user()->fullname() }}</li>
            </ol>
        </div>
        <h1>
           User Profile
            <small></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">


                         @forelse($items AS $items) 
                         @if($items->userInfo->username === Auth::user()->username)
                        <h3 class="profile-username text-center">{{ $items->userInfo->fullname()}} </h3>

                        <p class="text-muted text-center">Pharmacist</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <b>{{ $items->userInfo->email }}</b>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-home" aria-hidden="true"></i><b>{{ $items->userInfo->address }}</b>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-phone" aria-hidden="true"></i><b>{{ $items->userInfo->contact_number }}</b>
                            </li>
                        </ul>
                        @endif @empty
                        <p>There are no users yet!</p>
                        @endforelse
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <!-- tab start -->
                        <div class="active tab-pane" id="activity">
                            <a href="{{ route('pharmacists.edit', ['id' => Auth::user()->id]) }}" class="btn btn-info pull-right" data-toggle="tooltip" id="myTooltip" title="Edit Profile"><span class="glyphicon glyphicon-edit"></a>
                            <table class="table table-user-information">
                                <tbody>

                                    <tr>
                                        @if(session('ACTION_RESULT'))
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                               <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                                                    {{ session('ACTION_RESULT')['message'] }}

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </tr>
                                    <tr><b><h3>Personal information</h3></tr></b></tr>
                                    <tr>
                                        <td><span class="glyphicon glyphicon-user"></span> &nbsp<b>Username:</b> <br> {{ Auth::user()->username }} </td>
                                        <td><span class="glyphicon glyphicon-envelope"></span> <b>Email:</b> <br> {{ Auth::user()->email }} </td>
                                    </tr>

                                    <tr>
                                        <td><span class="glyphicon glyphicon-baby-formula"></span> <b>Date of Birth:</b><br> {{ Auth::user()->birthdate }}</td>
                                        <td><i class="fa fa-venus-mars" aria-hidden="true"></i> &nbsp <b>Gender:</b> <br>{{ Auth::user()->sex }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="glyphicon glyphicon-phone"></span> <b>Drugstore:</b> <br> {{ EMedHelper::retrievePharmacy($items->drugstore)->name }}</td>
                                        <td><i class="fa fa-user-md" aria-hidden="true"></i></span> <b>Drugstore:</b> <br> {{ EMedHelper::retrievePharmacyBranch($items->drugstore_branch)->name }}</td>
                                    </tr>


                                </tbody>
                            </table>

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
    .alert {
    position:absolute;
    z-index:1;
    margin-bottom: : 30px;
    width: 500px;
}
</style>



    @endsection
