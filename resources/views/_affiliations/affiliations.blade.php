@extends('welcome') @section('body')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage Affiliations

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Affiliations</a></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="callout callout-info">
            {!! Form::open(['url' => route('affiliations.store'), 'method' => 'POST']) !!}
            <div class="row ">
                <div class="col-md-3">

                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <div class="col-md-8 ">
                    {!! Form::bsText('affiliations', 'Affiliations') !!}
                </div>

            </div>

            <!-- end of panelbody -->
            {!! Form::close() !!}
        </div>
        <table id="example1" class="table table-bordered table-striped">

            <thead>
                <tr class="active">
                    <th>Affiliations</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @forelse($items AS $i)
                <tr>
                    <td>{{ $i->affiliations }}</td>

                    <td>
                        <form action="{{ route('affiliations.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>

                        <a href="{{ route('affiliations.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                    </td>
                </tr>


                @empty
                <tr>
                    <td colspan="4" class="text-center">No records</td>
                </tr>
                @endforelse
        </table>
</div>
<!-- Default box -->
<div class="box">
    <!-- /.box-body -->
    <div class="box-footer">
        Footer
    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
@endsection
