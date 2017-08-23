@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Page</div>
                <div class="panel-body">
                <h4>Page Name: <?= $page->name ?></h4>
                <h4>Page Slug: <?= $page->slug ?></h4>
                <h4>Page Content: <?= $page->content ?></h4>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
