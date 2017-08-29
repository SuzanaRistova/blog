@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>
                <div class="panel-body">
                     You are logged in!
                     <div class="home body-container">
                        <div class="link">
                            <a href="users">Users</a>
                        </div>
                        <div class="link">
                            <a href="pages">Pages</a>
                        </div>
                        <div class="link">
                            <a href="modules">Modules</a>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
