@extends('welcome') 
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div style="margin-top:10px">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url(session('homepage') . '') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">User Role List</li>
                </ol>
            </div>
            <h1>
                <span style="font-size:80% !important;">
                    <span class="fa fa-universal-access" style="font-size:135%!important"></span>
                    &nbsp;List of User Roles
                </span>
            </h1>
        </section>
        
        @if(session('ACTION_RESULT'))
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                        {{ session('ACTION_RESULT')['message'] }}

                    </div>
                </div>
            </div>
        @endif

        <section class="content">


            <div class="row">
                <div class="col-xs-12">
                    @if(EMedHelper::hasRoutePermission('userroles.create'))
                        <a href="{{ route('userroles.create') }}" class="btn btn-info btn-md add-button">
                            <span class="fa fa-plus" style="margin-right:5px;font-size:110%"></span>
                            Add User Role
                        </a>
                    @endif
                        
                </div>
                <div>&nbsp;</div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="active">
                                    <th>Name/Code</th>
                                    <th class="align-pt">Display Name</th>
                                    <th class="align-pt">Description</th>
                                    <th class="align-pt" style="text-align: center"><span class="fa fa-ellipsis-h"></span></th>
                                </tr>
                            </thead>
                            <tbody id="tableData" data-role-permissions="{{ json_encode($all_permissions) }}">
                                @forelse($roles as $role)
                                    <tr>
                                        <td class="align-pt">{{ $role->name }}</td>
                                        <td class="align-pt">{{ $role->display_name }}</td>
                                        <td class="align-pt">{{ $role->description }}</td>
                                        <td class="text-center">
                                            @if($role->id > 6)
                                                <form action="{{ route('userroles.destroy', ['id' => $role->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash action-icon"></span></button>
                                                </form>
                                                <a href="{{ route('userroles.edit', ['id' => $role->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit action-icon"></a>
                                                <a name="viewRoleModal" data-id="{{ $role->id }}" data-name="{{ $role->name }}" data-display_name="{{ $role->display_name }}" data-description="{{ $role->description }}" href="#" class="btn btn-warning"><span class="fa fa-info-circle"></span></a>
                                            @else
                                                <a class="btn btn-danger" disabled="disabled" style="opacity:0.30"><span class="glyphicon glyphicon-trash action-icon"></a>
                                                <a class="btn btn-info" disabled="disabled" style="opacity:0.30"><span class="glyphicon glyphicon-edit action-icon"></a>
                                                <a name="viewRoleModal" data-id="{{ $role->id }}" data-name="{{ $role->name }}" data-display_name="{{ $role->display_name }}" data-description="{{ $role->description }}" href="#" class="btn btn-warning"><span class="fa fa-info-circle"></span></a>
                                            @endif 
                                        </td>
                                    </tr>
                                @empty
                                    <!-- <tr>
                                        <td></td><td></td><td></td>
                                        <td colspan="4" class="text-center">ERROR: No roles found. This is critical.</td>
                                    </tr> -->
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
            
       

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

    </div>



    <style type="text/css">
        .align-th {
            font-size:98% !important;
        }
        .align-pt {
            font-size:98% !important;
            padding-top:15px !important;
        }
        .add-button {
            width:140px !important;
            height:40px !important;
            padding-top:10px !important
        }
        .action-icon {
            font-size: 85% !important;
        }
    </style>

    @push('scripts')
        <script type="text/javascript">
            // $(document).ready(function() {
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

                    var data = $("#tableData").data("role-permissions");

                    $.each(data, function(i, item)
                    {
                        if(item.role_id === $roleId)
                        {
                            $("#modalTable tr:last").after("<tr><td style='padding:5px'><span class='fa fa-check'></span>&nbsp;&nbsp;<span>" + data[i].display_name + "</span></td></tr>");
                        }
                        
                    });

                    $("#viewRolePermissions").modal();
                });
            // });
        </script>
        <script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);
</script>
    @endpush


<style type="text/css">
    .alert {
    position:absolute;
    z-index:1;
    margin-bottom: : 30px;
    width: 500px;

}
</style>
@endsection
<!-- hello -->