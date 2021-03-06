@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div style="margin-top:10px">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ url('userroles') }}">User Role List</a>
                </li>
                <li class="breadcrumb-item active">Edit User Role</li>
            </ol>
        </div>
        <h1>
            <span style="font-size:80% !important;">
                <span class="fa fa-universal-access" style="font-size:135%!important"></span>
                &nbsp;User Role Form
            </span>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            {!! Form::open(['url' => route ('userroles.update', ['id' => $roleData->id]), 'method' => 'PATCH', 'id' => 'fUserRole']) !!}
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="inside">
                       <h3>Edit Custom User Role</h3>

                        
                        {{csrf_field()}}

                        <div class="form-group">
                             {!! Form::bsText('name', 'Role Name', $roleData->name, ['disabled' => 'disabled']) !!}
                        </div>
                        <div class="form-group">
                              {!! Form::bsText('namedisplay', 'Display Name', $roleData->display_name, ['disabled' => 'disabled']) !!}
                        </div>
                        <div class="form-group">
                              {!! Form::bsText('description', 'Description', $roleData->description, ['disabled' => 'disabled']) !!}
                        </div>

                        <div class="form-group text-left">
                            <!--  But i foreach ni sila when we add roles -->
                            <div class="box-body table-responsive no-padding">
                                <h3>List of permissions</h3>
                                @if($errors->has('permissions'))
                                    <div class="alert alert-danger" style="opacity:0.7">
                                      {{ $errors->first('permissions') }}
                                    </div>
                                @endif
                               <table class="table table-bordered" >
                                   <tbody> 
                                        <?php $tdCount = 1; ?>
                                        @foreach($permissions as $permission)
                                            @if($tdCount > 4)
                                                <?php $tdCount = 1; ?>
                                            @endif

                                            @if($tdCount == 1)
                                                <tr>
                                            @endif

                                            @if($permission->allow_in_custom == 1 && $permission->target != session('user_type_name'))
                                                <td><input type="checkbox" name="permissions[]" value="{{ $permission->id }}" style="font-size:97%!important" {{ EMedHelper::hasPermissionId($permission->id, $roleData->id) ? "checked='checked'" : "" }}>
                                                    &nbsp;{{ $permission->display_name }}
                                                </td>
                                                <?php $tdCount++; ?>
                                            @endif

                                            @if($tdCount > 4)
                                                </tr>
                                            @endif
                                        @endforeach
                        
                                    </tbody>
                                </table>
                            </div>
                        </div> 

                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}             
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<style type="text/css">
    .inside {
        padding: 12px;

    }
    .table{
         background-color: #ffffff ;
    }

</style>


@endsection
