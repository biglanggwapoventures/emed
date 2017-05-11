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
            @foreach($items as $item)
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box-body table-responsive no-padding"><br>
                            <table class="table table-bordered table-striped"">
                                <thead>
                                    <tr>
                                        <td colspan="10">{{ $item['doctor_name'] }}</td>
                                    </tr>
                                    <tr class="active">
                                        <th class="align-th" rowspan="2">Brand</th>
                                        <th class="align-th" rowspan="2">Generic Name</th>
                                        <th class="text-center align-th" colspan="2">Quantity</th>
                                        <th class="align-th" rowspan="2">Dosage</th>
                                        <th class="align-th" rowspan="2">Duration</th>
                                        <th class="align-th" rowspan="2">Frequency</th>
                                        <th class="align-th" rowspan="2">Start of Consumption</th>
                                        <th class="align-th" rowspan="2">End of Consumption</th>
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
                                                {{ $prescription->brand }}
                                            </td>
                                            <td class="align-pt">
                                                {{ $prescription->genericname }}
                                            </td>
                                            <td class="align-pt text-center">
                                                {{ $prescription->quantity }}
                                            </td>
                                            <td class="align-pt text-center">
                                                {{ $prescription->quantity + 1 }}
                                            </td>
                                            <td class="align-pt">
                                                {{ $prescription->dosage }}
                                            </td>
                                            <td class="align-pt">
                                                {{ $prescription->duration }}
                                            </td>
                                            <td class="align-pt">
                                                {{ $prescription->frequency }}
                                            </td>
                                            <td class="align-pt">
                                                {{ $prescription->start }}
                                            </td>
                                            <td class="align-pt">
                                                {{ $prescription->end }}
                                            </td>
                                            
                                            <td class="text-center">
                                                <a href="#" class="btn btn-default" style="background-color:#999;color:#FFF;margin-left:15px">
                                                    <span class="fa fa-bars action-icon"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No prescriptions found from this doctor.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
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
            font-size: 85% !important;
        }
    </style>
@endsection
