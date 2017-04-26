@extends('welcome') @section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
        <h1>
            Patient List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/doctor-home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route( 'patients.index') }} ">Patient List</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
@endsection
