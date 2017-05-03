@extends('welcome') @section('body')
<div class="content-wrapper">
 <section class="content-header">
        <h1>
            Secretary List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/doctor-home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route( 'secretary.index') }} ">Secretary List</a></li>
        </ol>
    </section>
   <!--  <div class="box">
        <div class="box-body"> -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- <div class="box"> -->
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding"><br>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="active">
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Username</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items AS $i)
                                    <tr>
                                        <td>{{ $i->userInfo->lastname}}</td>
                                        <td>{{ $i->userInfo->firstname}}</td>
                                        <td>{{ $i->userInfo->username}}</td>
                                        <td>
                                            <form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                                <a href="{{ route('secretary.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No secretaries recorded</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    <!-- </div> -->
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer">
                <a href="doctor-home" data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-arrow-left"></i>Back to Profile</a>
            </div> -->
            <!-- /.box-footer-->
        <!-- </div> -->
    <!-- </div> -->
    </section>
</div>





<style type="text/css">
    .col-md-11 {
        width: 91.66666667%;
        margin-left: 22px;
        margin-top: -79px;
    }

</style>
@endsection