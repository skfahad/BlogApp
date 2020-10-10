<div class="modal fade px-4" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="deletePostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="deletePostLabel">Delete Post</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delete-post-id">
                <p class="font-weight-bold">Are you sure want to delete this post?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="delete-post-btn" type="button" class="btn btn-danger">Delete Post</button>
            </div>
        </div>
    </div>
</div>
