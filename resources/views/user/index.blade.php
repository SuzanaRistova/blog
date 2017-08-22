<h2>Users</h2>
<a class="btn" href="{{ route('user.create') }}">Add user</a>
@foreach($users as $user)
<h4>{{ $user->name }} 
    <a class="btn" href="{{ route('user.show', $user->id) }}">Show</a>
    @if($admin_role) <a class="btn" href="{{ route('user.delete', $user->id) }}"><a class="btn" href="{{ route('user.edit', $user->id) }}">Edit</a>@endif
    @if($admin_role) <a class="btn" href="{{ route('user.delete', $user->id) }}">Delete</a> @endif
</h4>
@endforeach