@extends('welcome')

@section('body')

<div class="container-fluid">
  <div class="row-bod">   
    <div class="col-md-9 col-md-offset-1">
        <div class="panel panel-default"> 
          <div class="panel-heading">
            <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i> Welcome {{ Auth::user()->fullname() }} </h4>
          </div>
          {{ csrf_field() }}
          <div class="panel-body">
            @forelse($items AS $d)
              @if($d->userInfo->username === Auth::user()->username)
                <strong>Name:</strong>{{ $d->userInfo->fullname() }} <br>
                <strong>Attainment:</strong>{{ $d->attainment }} <br>
                
              @endif
          @empty
            <p>There are no users yet!</p>
          @endforelse
          </div>
      </div>
    </div>
  </div>
</div>

@endsection