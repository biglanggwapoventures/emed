@extends('welcome') @section('body')

<div class="container">
    <div class="row-bod">
        <div class="col-md-12">
            <div class="page-header">
                <h1>PHARMACISTS</h1>
            </div>

            <div class="col-md-6">
                {!! Form::open(['method'=>'GET','url'=>'pharmacists','class'=>'navbar-form navbar-left','role'=>'search']) !!}
                <div class="input-group custom-search-form">
                    {!! Form::text('search', request()->input('search'), ['placeholder' => 'Search', 'class' => 'form-control']) !!}
                    <span class="input-group-btn">
                                <button type="submit" class="btn btn-default-sm">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                </div>
                {!! Form::close() !!}
            </div>

            <a class="btn btn-primary pull-right" href="{{ route('pharmacists.create') }}"><span class="glyphicon glyphicon-plus"></span>Add Pharmacist</a>

            <table class="table">
                <thead>
                    <tr class="active">
                        <th>Name</th>
                        <th>Pharmacy</th>
                        <th>username</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items AS $i)
                    <tr>
                        <td>{{ $i->userInfo->fullname() }}</td>
                        <td>{{ $i->drugstore }}</td>
                        <td>{{ $i->userInfo->username }}</td>
                        <td>
                            <form action="{{ route('users.destroy', ['id' => $i->userInfo->id]) }}" method="POST" onsubmit="javascript:return confirm('Are you sure?')" style="display:inline-block">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>

                            <a href="{{ route('pharmacists.edit', ['id' => $i->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No pharmacists recorded</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="add-doctor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add new doctor</h4>
			</div>
			<form  action="{{ route('doctors.store') }}" class="ajax">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="alert alert-danger hidden"></div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>First name</label>
								<input type="text" name="firstname" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Last name</label>
								<input type="text" name="lastname" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Specialization</label>
						<input type="text" name="specialization" class="form-control">
					</div>
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			</form>
		</div>
	</div>
</div> -->


<style type="text/css">
    .col-md-12 {
        width: 100%;
        background-color: whitesmoke;
        border-radius: 12px;
    }

</style>

@endsection
