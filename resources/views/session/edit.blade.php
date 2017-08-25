@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new session</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('session.update', $session->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $session->title) }}" placeholder="Title" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label for="slug" class="col-md-4 control-label">Slug</label>

                            <div class="col-md-6">
                                <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug', $session->slug) }}" placeholder="Slug" required>

                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <textarea id="content" type="text" class="form-control" name="content" value="{{ old('content', $session->slug) }}" placeholder="Content" required></textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
                            <label for="video" class="col-md-4 control-label">Video</label>

                            <div class="col-md-6">
                                <input id="video" type="text" class="form-control" name="video" value="{{ old('video', $session->video) }}" placeholder="Video" required>

                                @if ($errors->has('video'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('video') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('completed') ? ' has-error' : '' }}">
                            <label for="completed" class="col-md-4 control-label">Completed</label>

                            <div class="col-md-6">
                                <input id="completed" type="text" class="form-control" name="completed" value="{{ old('completed', $session->completed) }}" placeholder="Completed" required>

                                @if ($errors->has('completed'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('completed') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <input id="lesson_id" type="hidden" class="form-control" name="lesson_id" value="<?= $session->lesson_id ?>" placeholder="lesson_id" required>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
