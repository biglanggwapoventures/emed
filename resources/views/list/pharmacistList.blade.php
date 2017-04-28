@extends('welcome') @section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
        <h1>
            Pharmacist List
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
                                <table>
                                <tr>
                                    <a href="#" class="btn btn-info" data-toggle="tooltip" id="myTooltip" title="Edit items"><span class="glyphicon glyphicon-edit"></a> 
                                        
                                   
                                        <a href="#" class="btn btn-warning" data-toggle="tooltip" id="myTooltip" title="View items" ><span class="glyphicon glyphicon-eye-open"></a> 
                                    
                                        <button type="button" class="btn btn-warning" disabled><span class="glyphicon glyphicon-eye"></button> 
                                   
                                    <tr>
                                    </table>
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
