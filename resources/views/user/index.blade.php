@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    <a class="btn" href="{{ route('user.create') }}">Add user</a>
                    @foreach($users as $user)
                    <h4>{{ $user->name }} 
                        <a class="btn" href="{{ route('user.show', $user->id) }}">Show</a>
                        @if($admin_role) <a class="btn" href="{{ route('user.delete', $user->id) }}"><a class="btn" href="{{ route('user.edit', $user->id) }}">Edit</a>@endif
                            @if($admin_role) <a class="btn" href="{{ route('user.delete', $user->id) }}">Delete</a> @endif
                    </h4>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
