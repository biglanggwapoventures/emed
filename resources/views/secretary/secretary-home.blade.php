@extends('welcome') @section('body')

<div class="content-wrapper">
<section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="/secretary-home"><i class="fa fa-dashboard"></i> Home</a></li>
          
            <li><a href="#"><i class="fa fa-user"></i> {{ Auth::user()->fullname() }} </a></li>
    </section>
    <div class="container-fluid">
        <div class="row-bod">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i> Welcome {{ Auth::user()->fullname() }} </h4>
                    </div>
                    {{ csrf_field() }}
                    <div class="panel-body">
                        @if(session('ACTION_RESULT'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="alert alert-{{ session('ACTION_RESULT')['type'] }} text-center" role="alert">
                                    {{ session('ACTION_RESULT')['message'] }}

                                </div>
                            </div>
                        </div>
                        @endif @forelse($items AS $d) @if($d->userInfo->username === Auth::user()->username)
                        <strong>Name:</strong>{{ $d->userInfo->fullname() }} <br>
                        <strong>Attainment:</strong>{{ $d->attainment }} <br> @endif @empty
                        <p>There are no users yet!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);
</script>

@endsection
