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
                        
                         <page></page>
                        <div class="link">
                            <a href="{{ route('users')}}">Users</a>
                        </div>
                        <div class="link">
                            <a href="{{ route('pages')}}">Pages</a>
                        </div>
                        <div class="link">
                            <a href="{{ $user->hasRole('admin') ? "admin/modules" : route('modules') }}">Modules</a>
                        </div>
                        @if($user->hasRole('admin'))
                        <div class="link">
                            <a href="{{ route('lessons')}}">Lessons</a>
                        </div>
                        <div class="link">
                            <a href="{{ route('sessions')}}">Sessions</a>
                        </div>
                        @endif
                        <div class="link">
                            <passport-clients></passport-clients>
                            <passport-authorized-clients></passport-authorized-clients>
                            <passport-personal-access-tokens></passport-personal-access-tokens>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
