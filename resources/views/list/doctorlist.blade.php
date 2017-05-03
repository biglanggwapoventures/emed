@extends('welcome') @section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
        <h1>
            Doctors List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/doctor-home"><i class="fa fa-dashboard"></i> Home</a></li>
           
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($items AS $items)
                            <tr>
                                <td>{{ $items->userInfo->lastname }}</td>
                                <td>{{ $items->userInfo->firstname }}</td>
                                <td>{{ $items->userInfo->username }}</td>
                                <td>{{ $items->userInfo->email }}</td>
                                <td>
                             
                              <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#infoModal_{{ $items->id }}">
                                                <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" id="myTooltip" title="View Details">
                                            </button>


                                <div class="modal fade" id="infoModal_{{ $items->id }}" tabindex="-1" role="basic" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content" style="padding:20px 35px 20px 40px;">
                                            <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                                                <center><img alt="User Pic" src="{{ " storage/{$items->userInfo->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>
                                                <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                                                    {{ $items->userInfo->firstname }} &nbsp {{ $items->userInfo->lastname }}
                                                </h3>

                                                <hr style="margin-top:-5px;margin-bottom:5px;"/>

                                                <div class="row">
                                                    <div class="form-body">
                                                        <h4 class="form-section" style="padding-left:10px;">User Information</h4>
                                                    </div>

                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <div style="margin-bottom:-5px">
                                                            <label>Username</label>    
                                                        </div>
                                                        <div>
                                                            <span> {{ $items->userInfo->username }}</span>    
                                                        </div>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Date of Birth</label><br/>
                                                        <span> {{ $items->userInfo->birthdate }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Gender</label><br/>
                                                        <span> {{ $items->userInfo->sex }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Home Address</label><br/>
                                                        <span>{{ $items->userInfo->address }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Email</label><br/>
                                                        <span>{{ $items->userInfo->email }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Phone Number</label><br/>
                                                        <span> {{ $items->userInfo->contact_number }}</span>
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top:10px;">
                                                    <div class="col-md-12">
                                                        <button style="width:140px;margin-left:5px;" type="button" class="btn btn-primary grey pull-right" data-dismiss="modal">
                                                            Close 
                                                        </button>
                                                    </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td></td><td></td><td></td><td></td>
                                <td colspan="4" class="text-center">No items recorded</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
@endsection
