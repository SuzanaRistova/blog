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
                        <div class="col-md-12">
                            <input id="title" type="text" class="form-control" name="title" placeholder="Title" required autofocus>
                            <span class="help-block title"></span>
                        </div>
                    </div>

                    <div class="form-group slug">
                        <div class="col-md-12">
                            <input id="slug" type="text" class="form-control" name="slug" placeholder="Slug" required>
                                <span class="help-block slug"></span>
                        </div>
                    </div>
                    
                        <div class="form-group content ">
                            <div class="col-md-12">
                                <textarea id="content" class="content" type="text" class="form-control" name="content" placeholder="Content" required></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
<!--                    <div class="form-group image ">

                        <div class="col-md-6">
                            <img id="image" class="edit-page-image">
                            <input type="file" name="image" id="image_id">
                            <span class="help-block"></span>
                        </div>
                    </div>-->
                    
                    <input id="id" type="hidden" class="form-control" name="id" >
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary edit-btn">
                            Update
                        </button>
                    </div>
                  
                   
                </form>
            </div>
                                  

            
        </div>
    </div>
</div>

