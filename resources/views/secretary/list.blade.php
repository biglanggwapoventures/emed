@extends('welcome') @section('body')

<div class="container">
    <div class="row-bod">
        <div class="col-md-12">
            <div class="page-header">
                <h1>SECRETARY</h1>
            </div>

            <div class="col-md-6">

                {!! Form::open(['method'=>'GET','url'=>'secretary','class'=>'navbar-form navbar-left','role'=>'search']) !!}

                <div class="input-group custom-search-form">
                    {!! Form::text('search', request()->input('search'), ['placeholder' => 'Search', 'class' => 'form-control']) !!}
                    <span class="input-group-btn">
                                <button type="submit" class="btn btn-default-sm">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                </div>
                {!! Form::close() !!}

            </div>

            <a class="btn btn-primary pull-right" href="{{ route('secretary.create')}}">Add New Secretary</a>

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

<style type="text/css">
    .col-md-12 {
        width: 100%;
        background-color: whitesmoke;
        border-radius: 12px;
    }

</style>

@endsection
