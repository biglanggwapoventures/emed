@extends('welcome') 
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div style="margin-top:10px">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url(session('homepage') . '') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ url('patient-prescriptions') }}">Prescriptions</a></li>
                    <li class="breadcrumb-item active">Active Prescriptions List</li>
                </ol>
            </div>
            <h1>
                <span style="font-size:80% !important;">
                    <span class="fa fa-address-book-o" style="font-size:135%!important"></span>
                    &nbsp;Active List of Prescriptions of <strong>{{ $name }}</strong>
                </span>
            </h1>
        </section>

        <section class="content">
            <div class="form-body alert alert-success" id="mdl_successalert" style="display:none">
                <strong>Alright!</strong> 
                <span id="mdl_successmsg">You have successfully stored the transaction.</span>
            </div>

            @foreach($items as $item)
                @if(count($item['prescriptions']) > 0)
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box-body table-responsive no-padding"><br>
                                <table class="table table-bordered table-striped"">
                                    <thead>
                                        <tr>
                                            <td colspan="7">{{ $item['doctor_name'] }}</td>
                                            <td colspan= "1" style="text-align: right;"><b>PTR: </b>{{ $item['ptr'] }}</td>
                                            <td colspan= "1" style="text-align: right;"><b>PRC: </b>{{ $item['prc'] }}</td>
                                            <td colspan= "1" style="text-align: right;"><b>S2: </b>{{ $item['s2'] }}</td>
                                        </tr>
                                        <tr class="active">
                                            <th class="align-th" rowspan="2">Brand</th>
                                            <th class="align-th" rowspan="2">Generic Name</th>
                                            <th class="text-center align-th" colspan="2">Quantity</th>
                                            <th class="align-th text-center" rowspan="2">Dosage</th>
                                            <th class="align-th text-center" rowspan="2">Duration</th>
                                            <th class="align-th text-center" rowspan="2">Frequency</th>
                                            <th class="align-th text-center" rowspan="2">Start of Consumption</th>
                                            <th class="align-th text-center" rowspan="2">End of Consumption</th>
                                            <th class="text-center" rowspan="2" style="vertical-align:middle"><span class="fa fa-ellipsis-h"></span></th>
                                        </tr>
                                        <tr class="active">
                                            <th class="align-th text-center">Prescribed</th>
                                            <th class="align-th text-center">Purchased</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userdata">

                                        @forelse($item['prescriptions'] AS $prescription)
                                            <tr>
                                                <td class="align-pt">
                                                    {{ $prescription['brand'] }}
                                                </td>
                                                <td class="align-pt">
                                                    {{ $prescription['genericname'] }}
                                                </td>
                                                <td class="align-pt text-center">
                                                    {{ $prescription['quantity'] }}
                                                </td>
                                                <td class="align-pt text-center">
                                                    {{ $prescription['purchased'] }}
                                                </td>
                                                <td class="align-pt text-center">
                                                    {{ $prescription['dosage'] }}
                                                </td>
                                                <td class="align-pt text-center">
                                                    {{ $prescription['duration'] }}
                                                </td>
                                                <td class="align-pt text-center">
                                                    {{ $prescription['frequency'] }}
                                                </td>
                                                <td class="align-pt text-center">
                                                    {{ $prescription['start'] }}
                                                </td>
                                                <td class="align-pt text-center">
                                                    {{ $prescription['end'] }}
                                                </td>
                                                
                                                @if($prescription['quantity'] == $prescription['purchased'])
                                                    <td class="text-center">
                                                        <a href="#" class="btn btn-default" style="background-color:#999;color:#FFF;margin-left:15px;opacity:0.3" disabled="disabled">
                                                            <span class="fa fa-podcast action-icon"></span>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <a href="#" name="transactData" class="btn btn-default" style="background-color:#999;color:#FFF;margin-left:15px" data-info="{{ json_encode($prescription) }}">
                                                            <span class="fa fa-podcast action-icon"></span>
                                                        </a>
                                                    </td>
                                                @endif
                                                    
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No prescriptions found from this doctor.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </section>
    </div>

    <div class="modal fade" id="mdl_Transact" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="padding:20px 40px 20px 60px;">
                <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                    <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                        <span id="mdl_userName"></span><br/>
                        <small class="sbold" style="margin-left:3px;">Transaction Information</small>
                    </h3>

                    <hr style="margin-top:-5px;margin-bottom:5px;"/>
                    {{ csrf_field() }}

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
                                <h5 style="font-weight: bold">Prescribed Quantity</h5>
                                <div id="mdl_presqty" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Purchased Quantity</h5>
                                <div id="mdl_purqty" style="margin-top:-8px;"></div>  
                            </div>
                        </div>
                    </div>

                    <hr style="margin-top:5px;" />

                    <div class="row" style="margin-top:-20px">
                        <div class="form-body alert alert-danger" id="mdl_erralert" style="margin-left:10px;margin-right:25px">
                            <strong>Oops!</strong> 
                            <span id="mdl_errmsg"></span>
                        </div>

                        <div class="form-body">
                            <h4 class="form-section" style="padding-left:10px;">Purchase Details</h4>
                        </div>
                        
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                           <div class="form-group">
                                <h5 style="font-weight: bold">Quantity to Purchase</h5>
                            </div>
                        </div>
                        <div class="form-body col-md-6" style="margin-left:-5px;margin-top:-7px">
                            <input type="hidden" id="mdl_prescriptionId">
                            <input type="hidden" id="mdl_pharmaId" value="{{ session('user_id') }}">
                            <div class="form-group">
                                <!-- {!! Form::bsText('purcQty', '', '', array('type' => 'number')) !!} -->
                                <input class="form-control" type="number" id="purcQty">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top:10px;margin-right:-5px">
                        <div class="col-md-12">
                            <button style="width:140px;margin-left:5px;" type="button" class="btn btn-default grey pull-right" data-dismiss="modal">
                                Close 
                            </button>

                            <button id="completeTransaction" style="width:140px;margin-left:5px;" type="button" class="btn btn-primary grey pull-right">
                                Proceed 
                            </button>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlProcessing" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="padding:20px 40px 20px 60px;">
                <div class="modal-body"><!--  style="height:200px; overflow: scroll;"  -->
                    <h3 class="page-title text-info sbold" style="margin-left:-7px;">
                        <span id="mdl_userName">Processing</span><br/>
                    </h3>

                    <hr style="margin-top:-5px;margin-bottom:5px;"/>
                    <div class="row">
                        <div class="form-body">
                            <h4 class="form-section" style="padding-left:10px;">Please wait, the window will reload after processing.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        .align-th {
            font-size:98% !important;
            vertical-align: middle !important;
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
            font-size: 100% !important;
        }
    </style>

    @push('scripts')
        <script type="text/javascript">
            var onOperation = false;

            $(document).ready(function() {
                $("a[name=transactData]").click(function()
                {
                    var data = $(this).data('info'),
                        brand = data.brand,
                        generic = data.genericname,
                        presqty = data.quantity,
                        purqty = data.purchased;

                    $("#purcQty").val('');
                    $("#purcQty").prop('min', 1);
                    $("#purcQty").prop('max', presqty - purqty);

                    $("#mdl_brand").text(brand);
                    $("#mdl_genericname").text(generic);
                    $("#mdl_presqty").text(presqty);
                    $("#mdl_purqty").text(purqty);

                    $("#mdl_prescriptionId").val(data.id);

                    $("#mdl_erralert").hide();
                    $("#mdl_Transact").modal();
                });

                $("#completeTransaction").click(function()
                {
                    if(onOperation) return;

                    var qtyToPurchase = $("#purcQty").val(),
                        presQty = parseInt($("#mdl_presqty").text()),
                        purcQty = parseInt($("#mdl_purqty").text()),
                        prescriptionId = $("#mdl_prescriptionId").val(),
                        pharmaId = $("#mdl_pharmaId").val();

                    
                    if(qtyToPurchase.trim() == '' || isNaN(qtyToPurchase))
                    {
                        showErrMessage('Please enter a valid numeric quantity.');
                    }
                    else
                    {
                        if($.isNumeric(qtyToPurchase))
                        {
                            if(qtyToPurchase % 1 === 0)
                            {
                                var allowedQty = presQty - purcQty;
                                if(qtyToPurchase < 1 || qtyToPurchase > allowedQty)
                                {
                                    showErrMessage('Allowed quantity allowed is only 1' + ((allowedQty > 1) ? (' - ' + allowedQty + '.') : '.'));
                                }
                                else
                                {
                                    onOperation = true;
                                    var url = $("#formUrl").data('url');
                                    console.log('url = ' + url);
                                    console.log('qty = ' + qtyToPurchase);
                                    console.log('prescid = ' + prescriptionId);
                                    console.log('pharmid = ' + pharmaId);

                                    $("#mdl_Transact").modal('hide');
                                    $("#mdlProcessing").modal();

                                    $.ajaxSetup(
                                    {
                                        headers:
                                        {
                                            'X-CSRF-Token': $('input[name="_token"]').val()
                                        }
                                    });

                                    var param = {
                                        'quantity': qtyToPurchase, 
                                        'prescriptionId': prescriptionId, 
                                        'pharmaId': pharmaId
                                    };

                                    $.post(url, param)
                                        .done(function(data) 
                                        {
                                            window.location.reload();
                                            
                                            // showSuccessMessage();
                                            onOperation = false;
                                        });
                                }
                            }
                            else
                            {
                                showErrMessage('Please enter a valid numeric quantity.');
                            }
                        }
                        else
                        {
                            showErrMessage('Please enter a valid numeric quantity.');
                        }
                    }
                });

                $("#purcQty").focus(function()
                {
                    window.setTimeout(function () 
                    {
                        $("#mdl_erralert").hide();
                    }, 2000);
                    
                });
            });

            function showErrMessage(msg)
            {
                $("#mdl_erralert").show();
                $("#mdl_errmsg").text(msg);    
            }

            // function showSuccessMessage()
            // {
            //     $("#mdl_successalert").show(); 

            //     window.setTimeout(function () 
            //     {
            //         $("#mdl_successalert").hide();
            //         window.location.reload();
            //     }, 4000);
                
            // }
        </script>
    @endpush
@endsection
