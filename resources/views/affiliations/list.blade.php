@extends('welcome') @section('body')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table>
                    <thead>
                        <tr>
                            <th>
                                <a class="btn btn-primary pull-right" href="{{ route('affiliations.create')}}" style="margin-bottom:10px;margin-top:10px;"><span class="glyphicon glyphicon-plus"></span> New affiliation</a>
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Clinic Affiliation</th>
                            <th>Branch</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items AS $i)
                        <tr>
                            <td>
                                <a href="{{ route('affiliations.edit', ['id' => $i->id]) }}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                                
                            <form action="{{ route('affiliations.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>
                            </td>
                            <td>{{ $i->name }}</td>
                            <td>
                                <ol>
                                    @foreach($i->branches AS $branch)
                                    <li>{{ $branch->name }}</li>
                                    @endforeach
                                </ol>

                            </td>

                        </tr>
                        @empty @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<style type="">
     th {
    padding: 0;
    background-color: #ecf0f5;
}
</style>
@endsection @push('scripts') @endpush
