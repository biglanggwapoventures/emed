@extends('welcome') @section('body')
<div class="content-wrapper">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Pharmacist</h3>


        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <!--  <h3 class="box-title">List</h3> -->
                            <div class="box-tools">
                                <div class="input-group input-group-sm">

                                    <!-- <div class="input-group custom-search-form pull-right">
                    {!! Form::text('search', request()->input('search'), ['placeholder' => 'Search', 'class' => 'form-control']) !!}
                    <span class="input-group-btn">
                                <button type="submit" class="btn btn-default-sm">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                </div>

                {!! Form::close() !!} -->
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="active">
                                        <th>Name</th>
                                        <th>Pharmacy</th>
                                        <th>username</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items AS $i)
                                    <tr>
                                        <td>{{ $i->userInfo->fullname() }}</td>
                                        <td>{{ $i->drugstore }}</td>
                                        <td>{{ $i->userInfo->username }}</td>
                                        <td>
                                            <form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                            </form>

                                            <a href="{{ route('pharmacists.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No pharmacists recorded</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                User list
            </div>
            <!-- /.box-footer-->
        </div>
    </div>
</div>
@endsection
