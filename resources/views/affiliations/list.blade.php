@extends('welcome') 
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div style="margin-top:10px">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url(session('homepage') . '') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Affiliations</li>
                </ol>
            </div>
            <h1>
                <span style="font-size:80% !important;">
                    <span class="fa fa-bandcamp" style="font-size:135%!important"></span>
                    &nbsp;Affiliations
                </span>
            </h1>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    @if(EMedHelper::hasRoutePermission('affiliations.create'))
                        <a href="{{ route('affiliations.create') }}" class="btn btn-info btn-md add-button">
                            <span class="fa fa-plus" style="margin-right:5px;font-size:110%"></span>
                            Add Affiliation
                        </a>
                    @endif
                </div>
                <div>&nbsp;</div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box-body table-responsive no-padding">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="active">
                                    <th class="align-th">Clinic Affiliation</th>
                                    <th class="align-th">Branch</th>
                                    <th class="text-center"><span class="fa fa-ellipsis-h"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items AS $i)
                                    <tr>
                                        <td class="align-pt">{{ $i->name }}</td>
                                        <td class="align-pt">
                                            <ol>
                                                @foreach($i->branches AS $branch)
                                                <li>{{ $branch->name }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('affiliations.destroy', ['id' => $i->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </form>
                                            @if(EMedHelper::hasTargetActionPermission("AFFILIATION", "EDIT"))
                                                <a href="{{ route('affiliations.edit', ['id' => $i->id]) }}" class="btn btn-info">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-info">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </a>
                                            @endif
                                                
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3">There are no affiliations saved in the system.</td></tr> 
                                @endforelse
                            </tbody>
                        </table>
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
            width:150px !important;
            height:40px !important;
            padding-top:10px !important
        }
        .action-icon {
            font-size: 85% !important;
        }
    </style>
@endsection 

@push('scripts') @endpush
