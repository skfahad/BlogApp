<div class="modal fade px-4" id="createPost" tabindex="-1" role="dialog" aria-labelledby="createPostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="createPostLabel">Create Post</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-form" method="post" action="{{route('store')}}" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" for="post-title">Post Title</label>
                        <input name="title" type="text" class="form-control" id="post-title" aria-describedby="titleHelp" placeholder="Enter Title Here">
                        <small id="titleHelp" class="form-text text-muted">Max. 120 characters</small>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" id="post-image">
                                <label class="custom-file-label" for="post-image" aria-describedby="imageHelp">Choose file</label>
                                <small id="imageHelp" class="form-text text-muted">Max. 1 MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" for="post-body">Post Body</label>
                        <textarea name="body" id="post-body" class="form-control" cols="30" rows="5"></textarea>
                    </div>

                    {{--<div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>--}}

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="create-post-btn" type="button" class="btn btn-primary">Create Post</button>
            </div>
        </div>
    </div>
</div>
