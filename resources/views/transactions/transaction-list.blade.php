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
                                            <a href="#" class="btn btn-default" style="background-color:#999;color:#FFF;margin-left:15px">
                                                <span class="fa fa-sitemap action-icon"></span>
                                            </a>
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
@endsection
