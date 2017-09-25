<div class="modal fade" id="confirm-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>

            <div class="modal-body">
                <form enctype="multipart/form-data" id="update_page_modal" name="page_form" novalidate  class="form-horizontal" method="POST" action="{{ route('page.save') }}">
                    {{ csrf_field() }}
                    <div class="form-group title">
                        <div class="col-md-12 form-group">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title',  $page->title) }}" placeholder="Title" required autofocus>
                            <span class="help-block title"></span>
                        </div>
                    </div>

                    <div class="form-group slug">
                        <div class="col-md-12 form-group">
                            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug',  $page->slug) }}" placeholder="Slug" required>
                                <span class="help-block slug"></span>
                        </div>
                    </div>
                    
                        <div class="form-group content ">
                            <div class="col-md-12">
                                <textarea id="content" type="text" class="form-control" name="content" value="{{ old('content') }}" placeholder="Content" required> {{ $page->content }}</textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                    <div class="form-group image ">

                        <div class="col-md-6">
                            <img class="edit-page-image" src="/uploads/pages/large/{{ $page->image }}">
                            <input id="image" type="file" name="image">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <input id="id" type="hidden" class="form-control" name="id" value="{{ old('id',  $page->id) }}">

                    <button type="submit" class="btn btn-primary edit-btn">
                        Update
                    </button>
                   
                </form>
            </div>
                                  

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

