@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User</div>
                <div class="panel-body">
                <h4>Name: <?= $user->name ?></h4>
                <h4>Email: <?= $user->email ?></h4>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection