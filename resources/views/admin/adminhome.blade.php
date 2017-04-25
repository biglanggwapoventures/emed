@extends('welcome') @section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1>
           Admin
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
           

        </ol>
         @if(session('ACTION_RESULT'))
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                                                    {{ session('ACTION_RESULT')['message'] }}

                                                </div>
                                            </div>
                                        </div>
                                        @endif
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-group input-group-sm">
                    {!! Form::open(['method'=>'GET','url'=>'admin','class'=>'navbar-form navbar-left','role'=>'search']) !!} {!! Form::select('user_type', ['' => '**ALL**', 'DOCTOR' => 'Doctors', 'PMANAGER' => 'Pharmacy Manager','PATIENT' => 'Patient','PHARMA' => 'Pharmacist','SECRETARY' => 'Secretary'], request()->input('user_type'), ['class' => 'form-control']) !!}
                    <div class="input-group custom-search-form pull-right">
                        <span class="input-group-btn">
                                <button type="submit" class="btn btn-default-sm">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                    </div>

                    {!! Form::close() !!}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Username</th>
                                <th>User Type</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($items AS $i) @if($i->user_type != "ADMIN")
                            <tr>
                                <td>{{ $i->lastname }}</td>
                                <td>{{ $i->firstname }}</td>
                                <td>{{ $i->username }}</td>
                                <td>{{ $i->user_type }}</td>
                                <td>
                                    <form action="{{ route('users.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                    </form>

                                    @if(strtoupper($i->user_type) === "DOCTOR")
                                        <a href="{{ route('doctors.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a> 
                                    @elseif(strtoupper($i->user_type) === "PMANAGER")
                                        <a href="{{ route('managers.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a> 
                                    @elseif(!in_array(strtoupper($i->user_type), ['ADMIN', 'PATIENT', 'SECRETARY', 'PHARMA']))
                                        <a href="{{ url('custom-role/edit', $i->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a> 
                                    @else
                                        <button type="button" class="btn btn-info" disabled><span class="glyphicon glyphicon-edit"></button> 
                                    @endif


                                    <button type="button" class="btn btn-warning btn-default-sm" data-toggle="modal" data-target="#infoModal_{{ $i->id }}">
                        <span class="glyphicon glyphicon-info-sign">
                    </button>


                                <div class="modal fade" id="infoModal_{{ $i->id }}" tabindex="-1" role="basic" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content" style="padding:20px 35px 20px 40px;">
                                            <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                                                <center><img alt="User Pic" src="{{ " storage/{$i->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>
                                                <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                                                    {{ $i->fullname() }}
                                                </h3>

                                                <hr style="margin-top:-5px;margin-bottom:5px;"/>

                                                <div class="row">
                                                    <div class="form-body">
                                                        <h4 class="form-section" style="padding-left:10px;">User Information</h4>
                                                    </div>

                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <div style="margin-bottom:-5px">
                                                            <label>Username</label>    
                                                        </div>
                                                        <div>
                                                            <span> {{ $i->username }}</span>    
                                                        </div>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Date of Birth</label><br/>
                                                        <span> {{ $i->birthdate }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Gender</label><br/>
                                                        <span> {{ $i->sex }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Home Address</label><br/>
                                                        <span>{{ $i->address }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Email</label><br/>
                                                        <span>{{ $i->email }}</span>
                                                    </div>
                                                    <div class="form-body" style="padding-left:10px;margin-bottom:13px">
                                                        <label>Phone Number</label><br/>
                                                        <span> {{ $i->contact_number }}</span>
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top:10px;">
                                                    <div class="col-md-12">
                                                        <button style="width:140px;margin-left:5px;" type="button" class="btn btn-primary grey pull-right" data-dismiss="modal">
                                                            Close 
                                                        </button>
                                                    </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="modal fade" id="2infoModal_{{ $i->id }}" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="favoritesModalLabel">{{ $i->fullname() }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-user-information">
                                                        <center><img alt="User Pic" src="{{ " storage/{$i->avatar}" }}" style="width: 150px; height: 150px;" class="img-circle img-responsive"></center>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Username:</b>&#09;{{ $i->username }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Date of Birth:</b>&#09;{{ $i->birthdate }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Gender:</b>&#09;{{ $i->sex}} </td>
                                                            </tr>

                                                            <tr>
                                                                <tr>
                                                                    <td><b>Home Address:</b>&#09;{{ $i->address }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Email:</b>&#09;{{ $i->email }}</td>
                                                                </tr>
                                                                <td><b>Phone Number:</b>&#09;{{ $i->contact_number }}<br>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <span class="pull-right">
                          <button type="button" 
                             class="btn btn-default" 
                             data-dismiss="modal">Close</button>
                          </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endif @empty
                            <tr>
                                <td colspan="4" class="text-center">No users recorded</td>
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

<!-- /.row -->
        </section>
<!-- /.content -->
</div>
<script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);
</script>
@endsection

