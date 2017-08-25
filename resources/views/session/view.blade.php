@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="title-container">
                    <div class="title"><?= $session->title; ?></div>
                </div>
                <div class="body-container">
                    <div class="content"><?= $session->content; ?></div>
                        <input id="completed" name="completed" type="checkbox" <?= ($session->completed == 0) ? "" : "checked" ?> value="{{ old('completed', $session->completed) }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
