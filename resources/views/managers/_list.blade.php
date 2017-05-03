@extends('welcome') @section('body')

<div class="container">
    <div class="row-bod">
        <div class="col-md-12">
            <div class="page-header">
                <h1>PHARMACY MANAGER</h1>
            </div>


            @if(EMedHelper::hasRoutePermission('managers.create'))
                <a class="btn btn-primary pull-right" href="{{ route('managers.create')}}">Add new pharmacy manager</a>
            @endif

            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
            <table class="table">
                <thead>
                    <tr class="active">
                        <th>Name</th>
                        <th>Username</th>
                        <th>Drugstore</th>
                        <th>Manage</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($items AS $i)
                    <tr>
                        <td>{{ $i->userInfo->fullname() }}</td>
                        <td>{{ $i->userInfo->username}}</td>
                        <td>{{ $i->drugstore}}</td>


                        <td>
                            <form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>


                                <a href="{{ route('managers.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>

                        </td>
                    </tr>
                    @empty
                    <tr>

                        <td colspan="4" class="text-center">No pharmacy managers recorded</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style type="text/css">
    .col-md-12 {
        width: 100%;
        background-color: whitesmoke;
        border-radius: 12px;
    }

</style>

@endsection
