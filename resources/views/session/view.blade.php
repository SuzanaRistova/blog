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
                    <div class="body-container">
                        <label>Completed:</label>
                        <?php if($completed){ ?>
                            <input id="completed-view" name="completed" type="checkbox" <?= ($session->completed == 0) ? "" : "checked" ?> value="{{ old('completed', $session->completed) }}">
                        <?php } else { ?> 
                             <input id="completed-view" name="completed" type="checkbox" value="0">
                        <?php } ?>
                        <input id="session_id" name="session_id" type="hidden" value="{{ $session->id }}">
                    </div>
                    <div class="content"><?= $session->content; ?></div>
                    <div class="body-container">
                        <iframe id="video" width="420" height="315" src="<?= $session->video ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="back">
                        <a href="{{ url()->previous() }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
