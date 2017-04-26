@extends('welcome') @section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="modal fade" id="viewRolePermissions" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="padding:20px 40px 20px 60px;">
                <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                    <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                        Role Details &amp; Permissions<br/>
                        <small class="sbold" style="margin-left:3px;">View details of role</small>
                    </h3>

                    <hr style="margin-top:-5px;margin-bottom:5px;"/>

                    <div class="row">
                        <div class="form-body">
                            <h4 class="form-section" style="padding-left:10px;">User Role Information</h4>
                        </div>
                        
                        <div class="form-body col-md-4" style="margin-left:-5px;">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Name / Code</h5>
                                <div id="mRoleName" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                        <div class="form-body col-md-4" style="margin-left:-5px;">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Display Name</h5>
                                <div id="mDispName" style="margin-top:-8px;"></div> 
                            </div>
                        </div>
                        <div class="form-body col-md-4" style="margin-left:-5px;">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Description</h5>
                                <div id="mDescription" style="margin-top:-8px;"></div> 
                            </div>
                        </div>
                    </div>

                    <hr style="margin-top:5px;margin-bottom:10px;" />

                    <div class="row">
                        <div class="form-body">
                            <h4 class="form-section" style="padding-left:10px;">List of Permissions</h4>
                        </div>

                        <table id="modalTable" style="margin-left:10px;width:100%;">
                            <tr>
                                <td><span class="fa fa-check"></span>Dummy data</td>
                            </tr>
                        </table>
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

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if(EMedHelper::hasUrlPermission('userroles.create'))
                        <a class="btn btn-primary" href="{{ route('userroles.create')}}" style="margin-bottom:10px;margin-top:10px;">
                            <span class="glyphicon glyphicon-plus"></span> New user role
                        </a>
                    @endif
                        
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name/Code</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th style="text-align: center"><span class="fa fa-ellipsis-h"></span></th>
                            </tr>
                        </thead>
                        <tbody id="tableData" data-role-permissions="{{ json_encode($all_permissions) }}">
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        @if($role->id > 6)
                                            <form action="{{ route('userroles.destroy', ['id' => $role->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                            </form>
                                            <a href="{{ route('userroles.edit', ['id' => $role->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                                            <a name="viewRoleModal" data-id="{{ $role->id }}" data-name="{{ $role->name }}" data-display_name="{{ $role->display_name }}" data-description="{{ $role->description }}" href="#" class="btn btn-warning"><span class="fa fa-info-circle"></span></a>
                                        @else
                                            <a class="btn btn-danger" disabled="disabled" style="opacity:0.30"><span class="glyphicon glyphicon-trash"></a>
                                            <a class="btn btn-info" disabled="disabled" style="opacity:0.30"><span class="glyphicon glyphicon-edit"></a>
                                            <a name="viewRoleModal" data-id="{{ $role->id }}" data-name="{{ $role->name }}" data-display_name="{{ $role->display_name }}" data-description="{{ $role->description }}" href="#" class="btn btn-warning"><span class="fa fa-info-circle"></span></a>
                                        @endif 
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No roles found. This is critical.</td>
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

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("a[name=viewRoleModal]").click(function()
            {
                $roleId = $(this).data("id");
                $roleName = $(this).data("name");
                $roleDispName = $(this).data("display_name");
                $roleDesc = $(this).data("description");

                $("#mRoleName").text($roleName);
                $("#mDispName").text($roleDispName);
                $("#mDescription").text($roleDesc);

                $("#modalTable > tbody").html("<tr></tr>");

                $("#viewRolePermissions").modal();
                var data = $("#tableData").data("role-permissions");

                $.each(data, function(i, item)
                {
                    if(item.role_id === $roleId)
                    {
                        console.log(item.display_name);
                        $("#modalTable tr:last").after("<tr><td style='padding:5px'><span class='fa fa-check'><span>&nbsp;&nbsp;" + data[i].display_name + "</td></tr>");
                    }
                    
                });
            });
        });
    </script>
@endpush

@endsection
