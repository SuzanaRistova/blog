@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ route('user.create') }}">Add user</a>
                     <table class="table">
                        <thead>
                         <tr>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Actions</th>
                         </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>   
                                <a class="btn btn-primary" href="{{ route('user.show', $user->id) }}">Show</a>

                                @if($admin_role) 
                                    <a class="btn btn-primary" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                @endif

                                @if($admin_role) 
                                    <a class="btn btn-primary delete-button" href="{{ route('user.delete', $user->id) }}">Delete</a>
                                @endif
                            </td>
                             </tr>
                            @endforeach   
                        </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
