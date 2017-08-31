@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User</div>
                <div class="panel-body">
                    <img class="profile" src="/uploads/avatars/{{$user->avatar}}"/>
                    <h4><?= $user->name ?>`s Profile</h4>
                    <form enctype="multipart/form-data" action="/profile" method="POST">
                        <label>Update Profile Image </label>
                        <input type="file" name="avatar" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-primary pull-right" value="Update Profile Image">
                    </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection