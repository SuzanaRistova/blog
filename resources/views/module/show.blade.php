@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modules</div>
                <div class="panel-body">
                <h4>Module Title: <?= $module->title ?></h4>
                <h4>Module Slug: <?= $module->slug ?></h4>
                <h4>Module Content: <?= $module->content ?></h4>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
