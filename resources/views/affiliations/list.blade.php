@extends('welcome') @section('body')
<div class="content-wrapper">
<section class="content-header">
        <h1>
            Affiliations 
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('affiliations.index')}}">Affiliations</a></li>

        </ol>
    </section>
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
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Clinic Affiliation</th>
                            <th>Branch</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items AS $i)
                        <tr>
                           
                            <td>{{ $i->name }}</td>
                            <td>
                                <ol>
                                    @foreach($i->branches AS $branch)
                                    <li>{{ $branch->name }}</li>
                                    @endforeach
                                </ol>

                            </td>
                             <td>


                                  <form action="{{ route('affiliations.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                                     {{ csrf_field() }} {{ method_field('DELETE') }}
                                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                     </form>

                                 <a href="{{ route('affiliations.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                            </form>


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
