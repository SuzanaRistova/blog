@extends('layouts.app')

@section('content')

<h4>Name: <?= $user->name ?></h4>
<h4>Email: <?= $user->email ?></h4>

@endsection