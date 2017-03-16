@extends('welcome') @section('body')

<div class="container">
    <div class="row-bod">
        <div class="col-md-12">
            <div class="page-header">
                <h1>SECRETARY</h1>
            </div>


            <a class="btn btn-primary pull-right" href="{{ route('secretary.create')}}">Add New Secretary</a>
            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
            <table class="table">
                <thead>
                    <tr class="active">
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Username</th>
                        <th>Manage</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($items AS $i)
                    <tr>
                        <td>{{ $i->userInfo->lastname}}</td>
                        <td>{{ $i->userInfo->firstname}}</td>
                        <td>{{ $i->userInfo->username}}</td>


                        <td>
                            <form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>


                                <a href="{{ route('secretary.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>

                        </td>
                    </tr>
                    @empty
                    <tr>

                        <td colspan="4" class="text-center">No secretaries recorded</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
    