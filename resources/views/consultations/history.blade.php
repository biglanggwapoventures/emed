@extends('welcome') 
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div style="margin-top:10px">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url(session('homepage') . '') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Consultation History List</li>
                </ol>
            </div>
            <h1>
                <span style="font-size:80% !important;">
                    <span class="fa fa-hospital-o" style="font-size:135%!important"></span>
                    &nbsp;List of Consultation History
                </span>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <h4>Patient: {{ $patient }}</h4>
                    <h5>Physician: {{ $doctor }}</h5>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding"><br>
                        <table id="example1" class="table table-bordered table-striped"">
                            <thead>
                                <tr class="active" style="height: 50px">
                                    <th class="align-th">Height</th>
                                    <th class="align-th">Weight</th>
                                    <th class="align-th">Blood Pressure</th>
                                    <th class="align-th">Temperature</th>
                                    <th class="align-th">Pulse Rate</th>
                                    <th class="align-th">Respiratory Rate</th>
                                    <th class="align-th">Notes</th>
                                    <th class="align-th">Chief Complaints</th>
                                    <th class="align-th">Update Reason</th>  
                                    <th class="align-th">Updated At</th>
                                </tr>
                            </thead>
                            <tbody id="userdata">
                                @forelse($items AS $item)
                                    <tr>
                                        <td class="align-pt">{{ $item->height }}</td>
                                        <td class="align-pt">{{ $item->weight }}</td>
                                        <td class="align-pt">{{ $item->bloodpressure }}</td>
                                        <td class="align-pt">{{ $item->temperature }}</td>
                                        <td class="align-pt">{{ $item->pulserate }}</td>
                                        <td class="align-pt">{{ $item->resprate }}</td>
                                        <td class="align-pt">{{ $item->notes }}</td>
                                        <td class="align-pt">{{ $item->chiefcomplaints }}</td>
                                        <td class="align-pt">{{ $item->updatereason }}</td>
                                        <td class="align-pt">{{ $item->updated_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No history for this consultation.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <a href="{{ url("/patients/$item->patient_id") }}" class="btn btn-success" id="none">Back</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="voidTrans" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="padding:20px 40px 20px 60px;">
                <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                    <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                        <span id="mdl_userName"></span><br/>
                        <small class="sbold" style="margin-left:3px;">Prescription information</small>
                    </h3>

                    {{ csrf_field() }}

                    <hr style="margin-top:-5px;margin-bottom:5px;"/>

                    <div class="row">
                        <div class="form-body">
                            <h4 class="form-section" style="padding-left:10px;">User Information</h4>
                        </div>
                        
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Patient Name</h5>
                                <div id="mdl_patient" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Prescribing Physician</h5>
                                <div id="mdl_doctor" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Handling Pharmacist</h5>
                                <div id="mdl_pharma" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                    </div>

                    <hr style="margin-top:5px;" />

                    <div class="row" id="formUrl" data-url="{{ url('transact') }}">
                        <div class="form-body">
                            <h4 class="form-section" style="padding-left:10px;">Prescription Info</h4>
                        </div>
                        
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Brand</h5>
                                <div id="mdl_brand" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Generic Name</h5>
                                <div id="mdl_genericname" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Purchased Quantity</h5>
                                <div id="mdl_purqty" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Date of Purchase</h5>
                                <div id="mdl_purchdate" style="margin-top:-8px;"></div>  
                            </div>
                        </div>

                        @if(session('user_type') === 'PHARMA')
                            <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-7px">
                               <div class="form-group">
                                    <h5 style="font-weight: bold">Approving Manager</h5> 
                                    {!! Form::select('approving_manager', $mgrList, 'approving_manager', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-body col-md-12" style="margin-left:-5px;margin-top:-7px">
                               <div class="form-group">
                                    <h5 style="font-weight: bold">Manager Password</h5> 
                                    <input class="form-control" type="password" id="manager_password">
                                    <label class="text-danger" id="pwError" style="margin-top:5px"></label>
                                </div>
                            </div>
                        @endif
                            

                        
                    </div>

                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-12">
                            <button id="proceedVoiding" data-url="{{ url('void') }}" style="width:140px;margin-left:5px;" type="button" class="btn btn-danger grey pull-right">
                                Void 
                            </button>
                            <button style="width:140px;margin-left:5px;" type="button" class="btn btn-default grey pull-right" data-dismiss="modal">
                                Cancel 
                            </button>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
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
            font-size: 95% !important;
        }
        .valid-label {
            background-color:#18e801;
            padding:5px;
            font-size:87%;
            margin-top:-10px!important;
            color:#FFF;
            border-radius: 5px;
        }
        .voided-label {
            background-color:#eb3f00;
            padding:5px;
            font-size:87%;
            margin-top:-10px!important;
            color:#FFF;
            border-radius: 5px;
        }
    </style>
@endsection
