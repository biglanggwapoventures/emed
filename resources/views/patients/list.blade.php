@extends('welcome') @section('body')

<div class="container">
    <div class="row-bod">
        <div class="col-md-12">
            <div class="page-header">
                <h1>PATIENTS</h1>
            </div>

            <div class="col-md-6">

                {!! Form::open(['method'=>'GET','url'=>'patients','class'=>'navbar-form navbar-left','role'=>'search']) !!}
            
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

            <a class="btn btn-primary pull-right" href="{{ route('patients.create')}}">Add new patient</a>

            <table class="table">
                <thead>
                    <tr class="active">
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Bloodtype</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($patients AS $patient)
                    <tr>
                        <td>{{ $patient->userInfo->lastname }}</td>
                        <td>{{ $patient->userInfo->firstname }}</td>
                        <td>{{ $patient->bloodtype }}</td>
                        <td>

                           
                            
                            <form action="{{ route('users.destroy', ['id' => $patient->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')">
                                {{ csrf_field() }} {{ method_field('DELETE') }}

                                @if(Auth::user()->user_type === "DOCTOR")
                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                @elseif(Auth::user()->user_type === "SECRETARY")
                                <button type="submit" class="btn btn-danger" disabled><span class="glyphicon glyphicon-trash"></button>
                                @endif
                           

                                <a href="{{ route('patients.edit', ['id' => $patient->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>

                                @if(Auth::user()->user_type === "DOCTOR")
                                <a href="{{ route('patients.show', ['id' => $patient->id]) }}" class="btn btn-warning">View Patient</a>
                                @elseif(Auth::user()->user_type === "SECRETARY")
                                <button type="button" class="btn btn-warning" disabled>View Patient</button>
                                @endif
                             </form>
                                                        
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No patients recorded</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
<center>{{ $patients->links('vendor.pagination.custom') }}</center>
<!-- {{ $patients->appends(Request::except('page'))->links() }}  -->

@endsection
