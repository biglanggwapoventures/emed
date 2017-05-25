@extends('welcome') 
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div style="margin-top:10px">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url(session('homepage') . '') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Transaction History List</li>
                </ol>
            </div>
            <h1>
                <span style="font-size:80% !important;">
                    <span class="fa fa-hospital-o" style="font-size:135%!important"></span>
                    &nbsp;List of Transaction History
                </span>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <h4>{{ $userdata->pharmacy . ", " . $userdata->pharmacyBranch }}</h4>
                    <h5>{{ $userdata->pharmacyBranchAddress }}</h5>
                </div>
            </div>

            {{-- var_dump($mgrList) --}}

            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding"><br>
                        <table id="example1" class="table table-bordered table-striped"">
                            <thead>
                                <tr class="active" style="height: 50px">
                                    <th class="align-th">Date of Purchase</th>
                                    <th class="align-th">Patient Name</th>
                                    <th class="align-th">Prescribing Physician</th>
                                    <th class="align-th">Brand</th>
                                    <th class="align-th">Generic Name</th>
                                    <th class="align-th">Purchased Quantity</th>
                                    <th class="align-th">Handling Pharmacist</th>
                                    <th class="text-center"><span class="fa fa-ellipsis-h"></span></th>
                                </tr>
                            </thead>
                            <tbody id="userdata">
                                @forelse($items AS $item)
                                    <tr>
                                        <td class="align-pt">{{ $item->purchaseTimestamp }}</td>
                                        <td class="align-pt">{{ $item->patientName }}</td>
                                        <td class="align-pt">Dr. {{ $item->doctorName }}</td>
                                        <td class="align-pt">{{ $item->brand }}</td>
                                        <td class="align-pt">{{ $item->genericname }}</td>
                                        <td class="align-pt">{{ $item->purchaseQty }}</td>
                                        <td class="align-pt">{{ $item->pharmaName }}</td>
                                        <td class="text-center">
                                            @if($item->voided)
                                                <a href="#" class="btn btn-danger" style="margin-left:15px" disabled="disabled">
                                                    <span class="fa fa-rotate-left action-icon"></span>
                                                </a>
                                            @else
                                                <a name="voidTransaction" data-id="{{ $item->transId }}" data-pdata="{{ json_encode($item) }}" href="#" class="btn btn-danger" style="margin-left:15px">
                                                    <span class="fa fa-rotate-left action-icon"></span>
                                                </a>
                                            @endif
                                                
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No transactions for this pharmacy branch.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
    </style>

    @push('scripts')
        <script type="text/javascript">
            var onOperation = false,
                idToVoid = -1;

            $(document).ready(function() {
                $("a[name=voidTransaction]").click(function()
                {
                    $("#manager_password").val("");
                    $("#pwError").text("");

                    var transactionId = $(this).data('id');
                    var data = $(this).data('pdata');

                    idToVoid = transactionId;

                    $("#mdl_patient").text(data.patientName);
                    $("#mdl_doctor").text(data.doctorName);
                    $("#mdl_pharma").text(data.pharmaName);

                    $("#mdl_brand").text(data.brand);
                    $("#mdl_genericname").text(data.genericname);
                    $("#mdl_purqty").text(data.purchaseQty);
                    $("#mdl_purchdate").text(data.purchaseTimestamp);

                    $("#voidTrans").modal();
                });

                $("#proceedVoiding").click(function()
                {
                    if(onOperation) return;


                    if(idToVoid != -1)
                    {
                        var approving_manager = $("select[name=approving_manager]").val(),
                            mgr_password = $("#manager_password").val();


                        if(approving_manager === undefined)
                        {
                            approving_manager = null;
                            mgr_password = null;
                        }
                        
                        // console.log(approving_manager);
                        // return;

                        $.ajaxSetup(
                        {
                            headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                        });

                        var url = $(this).data('url'),
                            param = {
                                'transactionId': idToVoid,
                                'approvingMgr': approving_manager,
                                'mgrPassword': mgr_password
                            };

                        $.post(url, param)
                            .done(function(data) 
                            {
                                // console.log(data);
                                data = JSON.parse(data);
                                if(data.success)
                                {
                                    console.log('here');
                                    $("#voidTrans").modal('hide');
                                    window.location.reload();
                                }
                                else
                                {
                                    console.log('there');
                                    console.log(data.message);
                                    $("#pwError").text(data.message);
                                    $("#manager_password").focus();
                                }

                                
                                onOperation = false;
                            });
                    }
                });
            });
        </script>
    @endpush
@endsection
