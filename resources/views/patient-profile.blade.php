@extends('welcome') @section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div class="thumbnail">
                <img src="{{ asset(" storage/{$patient->userInfo->avatar}") }}" alt="...">
                <div class="caption">
                    <h3>{{ $patient->userInfo->fullname() }}</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
