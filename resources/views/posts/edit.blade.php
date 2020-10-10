<div class="modal fade px-4" id="EditPost" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="EditPostLabel">Edit Post</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form" method="post" action="" enctype="multipart/form-data">
                    <input id="post-id" type="hidden" value="">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" for="edit-post-title">Post Title</label>
                        <input name="title" type="text" class="form-control" id="edit-post-title" aria-describedby="titleHelp" placeholder="Enter Title Here">
                        <small id="titleHelp" class="form-text text-muted">Max. 120 characters</small>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" id="edit-post-image">
                                <label class="custom-file-label" for="edit-post-image" aria-describedby="imageHelp">Choose file</label>
                                <small id="imageHelp" class="form-text text-muted">Max. 1 MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" for="edit-post-body">Post Body</label>
                        <textarea contenteditable="true" name="body" id="edit-post-body" class="form-control" cols="30" rows="5"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="update-post-btn" type="button" class="btn btn-primary">Update Post</button>
            </div>
        </div>
    </div>
</div>
