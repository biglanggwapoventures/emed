@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Roles Form
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Custom User Role</a></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            {!! Form::open(['url' => route ('userroles.store'), 'method' => 'POST', 'id' => 'fUserRole']) !!}
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="inside">
                       <h3>Add Custom User Role</h3>

                        
                        {{csrf_field()}}

                        <div class="form-group">
                             {!! Form::bsText('name', 'Role Name') !!}
                        </div>
                        <div class="form-group">
                              {!! Form::bsText('namedisplay', 'Display Name') !!}
                        </div>
                        <div class="form-group">
                              {!! Form::bsText('description', 'Description') !!}
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

                                            <td><input type="checkbox" name="permissions[]" value="{{ $permission->id }}" >{{ $permission->display_name }}</td>
                                            <?php $tdCount++; ?>

                                            @if($tdCount > 4)
                                                </tr>
                                            @endif
                                        @endforeach
                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
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

</style>


@endsection
