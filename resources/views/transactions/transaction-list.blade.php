@extends('welcome') 
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div style="margin-top:10px">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url(session('homepage') . '') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Prescription Transactions List</li>
                </ol>
            </div>
            <h1>
                <span style="font-size:80% !important;">
                    <span class="fa fa-hospital-o" style="font-size:135%!important"></span>
                    &nbsp;List of Prescription Transactions
                </span>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    {{-- var_dump($userdata) --}}
                    <h4>{{ $userdata->pharmacy . ", " . $userdata->pharmacyBranch }}</h4>
                    <h5>{{ $userdata->pharmacyBranchAddress }}</h5>
                </div>
                
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding"><br>
                        <table class="table table-bordered table-striped"">
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
                                        <?php 
                                            $rowCount = $item['doctorCount']; 
                                            $doctors = $item['doctors'];
                                            $patientId = $item['patient_id'];
                                        ?>
                                        <td class="align-pt" rowspan="{{ $rowCount }}">
                                            {{ $item['firstname'] . " " . $item['lastname'] }}
                                        </td>
                                        
                                        @foreach($doctors AS $doctor)
                                            <td class="align-pt">Dr. {{ $doctor['firstname'] . " " . $doctor['lastname'] }}</td>
                                            <td class="align-pt">{{ $doctor['prescriptionCount'] }} active prescription{{ $doctor['prescriptionCount'] > 1  ? 's' : '' }}</td>
                                            <td class="text-center">
                                                <a href="{{ url('pharmatransaction', $patientId) }}" class="btn btn-default" style="background-color:#999;color:#FFF;margin-left:15px">
                                                    <span class="fa fa-sitemap action-icon"></span>
                                                </a>
                                            </td>

                                            @if(--$rowCount > 0)
                                                </tr><tr>
                                            @endif
                                        @endforeach
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
