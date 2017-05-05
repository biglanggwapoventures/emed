@extends('welcome') 
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div style="margin-top:10px">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Patients List</li>
                </ol>
            </div>
            <h1>
                <span style="font-size:80% !important;">
                    <span class="fa fa-qq" style="font-size:135%!important"></span>
                    &nbsp;List of Patients
                </span>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @if(EMedHelper::hasRoutePermission('patients.create'))
                        <a href="{{ route('patients.create') }}" class="btn btn-info btn-md add-button">
                            <span class="fa fa-plus" style="margin-right:5px;font-size:110%"></span>
                            Add Patient
                        </a>
                    @endif
                </div>
                <div>&nbsp;</div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="active">
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Bloodtype</th>
                                    <th>Occupation</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($patients AS $patient)
                                    <tr>
                                        <td>{{ $patient->userInfo->lastname }}</td>
                                        <td>{{ $patient->userInfo->firstname }}</td>
                                        <td>{{ $patient->userInfo->email }}</td>
                                        <td>{{ $patient->bloodtype }}</td>
                                        <td>{{ $patient->occupation }}</td>
                                        <td>
                                            @if(Auth::user()->user_type === "DOCTOR")
                                                @can('detach-patient', $patient) 
                                                    {!! Form::open(['url' => url('/detach-patient', ['patientId' => $patient->id]), 'method' => 'POST', 'onsubmit' => 'return confirm("Are you sure?")']) !!}
                                                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button> 
                                                    {!! Form::close() !!} 
                                                @endcan
                                            @elseif(Auth::user()->user_type === "SECRETARY")
                                                <button type="submit" class="btn btn-danger" disabled><span class="glyphicon glyphicon-trash"></button> 
                                            @endif
                                                
                                            <a href="{{ route('patients.edit', ['id' => $patient->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a> 
                                                
                                            @if(Auth::user()->user_type === "DOCTOR")
                                                <a href="{{ route('patients.show', ['id' => $patient->id]) }}" class="btn btn-warning">View Patient</a> 
                                            @elseif(Auth::user()->user_type === "SECRETARY")
                                                <button type="button" class="btn btn-warning" disabled>View Patient</button> 
                                            @endif
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
        </section>
    </div>

    <style type="text/css">
        .align-th {
            font-size:98% !important;
        }
        .align-pt {
            font-size:98% !important;
            padding-top:15px !important;
        }
        .add-button {
            width:140px !important;
            height:40px !important;
            padding-top:10px !important
        }
        .action-icon {
            font-size: 85% !important;
        }
    </style>
@endsection
