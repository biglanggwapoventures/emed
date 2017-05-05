@extends('welcome') @section('body')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Organizations 
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route( 'organizations.index')}}">Organizations</a></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

                                        @if(session('ACTION_RESULT'))
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                                              
                                                    {{ session('ACTION_RESULT')['message'] }}

                                                </div>
                                            </div>
                                        </div>
                                        @endif

        @if(EMedHelper::hasRoutePermission('organizations.create'))
            <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-plus"></span>Add Organization
            </button><br><br>
        @endif

        <!-- Modal -->
        <!-- Trigger the modal with a button -->


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Organization</h4>
                    </div>
                    <div class="modal-body">

                        {!! Form::open(['url' => route('organizations.store'), 'method' => 'POST']) !!}
                        <div class="row ">

                            <div class="col-md-12 ">
                                {!! Form::bsText('organizations', 'Organizations') !!}
                            </div>

                            <div class="col-md-12">
                                <center>
                                    <button type="submit" class="btn btn-primary ">Add</button>
                                </center>
                            </div>

                        </div>

                        <!-- end of panelbody -->
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- //////////////////// -->


        <!-- //////////////////// -->
        <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">

            <thead>
                <tr class="active">
                    <th>Organizations</th>
                    <th>Manage</th>

                </tr>
            </thead>
            <tbody>
                @forelse($items AS $i)
                <tr>
                    <td>{{ $i->organizations }}</td>

                    <td>
                        <form action="{{ route('organizations.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>

                        <a href="{{ route('organizations.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a></span>
                    </td>

                </tr>


                @empty
                <tr>
                    <td colspan="4" class="text-center">No records</td>
                </tr>
                @endforelse
                
                </tbody>
        </table>
        </div>
</div>
<!-- Default box -->
<div class="box">
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
    
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
<style type="">
     th {
    padding: 0;
    background-color: #ecf0f5;
}
</style>
<script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);
</script>
@endsection
<span style="font-weight:bold;"></span>
