@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="title-container">
                    <div class="title">
                        @if($page->image != NULL)
                            <img src="/uploads/pages/small/{{ $page->image}}"/>
                        @endif
                        <?= $page->title; ?>
                    </div>
                </div>                        
                <div class="body-container">
                    @if($page->image != NULL)
                        <img class="page-image" src="/uploads/pages/large/{{ $page->image}}"/>
                    @endif
                    <div class="content"><?= $page->content; ?></div>
                    <div class="back">
                        <a href="{{ url()->previous() }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
