@extends('welcome') @section('body')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table>
                    <thead>
                        <tr>
                            <th>
                                <a class="btn btn-primary pull-right" href="{{ route('specialization.create')}}" style="margin-bottom:10px;margin-top:10px;"><span class="glyphicon glyphicon-plus"></span> New specialization</a>
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Specialization</th>
                            <th>Subspecialization</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items AS $i)
                        <tr>
                            
                            <td>{{ $i->name }}</td>
                            <td>
                                <ol>
                                    @foreach($i->subspecializations AS $sub)
                                    <li>{{ $sub->name }}</li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>


                            <form action="{{ route('specialization.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                             </form>

                                 <a href="{{ route('specialization.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                                 
                            </td>
                        </tr>
                        @empty @endforelse
                    </tbody>
                </table>
                </div>

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
