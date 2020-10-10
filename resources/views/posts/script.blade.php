<script>

    let api_token = '';
    @Auth
        api_token = '{{Auth::user()->api_token}}';
        auth_user_id = '{{Auth::id()}}';
    @endauth

        console.log(auth_user_id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': 'Bearer '+api_token,
        }
    });
    $(document).ready(function () {

        show();

        $('#search-post').on('click', function () {
            show($('#query-string').val());
        });

        $(document).on('click', '.pagination .page-link', function () {
             show(null, $(this).data('page'));
             window.scrollTo(0, 0);
        });

        $('#create-post-btn').on('click', function () {
            store();
        });

        $(document).on('click', '.edit-post', function () {
            let post_id = $(this).parents('.post-container').data('post-id');
            $('#post-id').val(post_id);
            edit(post_id);
        });

        $('#update-post-btn').on('click', function () {
            update($('#post-id').val());
        });

        $(document).on('click', '.delete-post', function () {
            let post_id = $(this).parents('.post-container').data('post-id');
            $('#delete-post-id').val(post_id);
        });

        $('#delete-post-btn').on('click', function () {
            destroy($('#delete-post-id').val());
        });
    });

    /***********************************
     *  SHOW POST
     **********************************/

    function show(search_string, page) {
        $.ajax({
            url: '{{route('show')}}',
            type: 'post',
            data: {search_string, page},
            success: function (response) {
                console.log(response);
                //return;
                appendPost(response);
            }
        });
    }

    function appendPost(posts) {

        let data = '';

        if (!posts.data.length) {
            data += '<div class="alert alert-primary" role="alert">No Posts Found</div>';
        } else {
            $.each(posts.data, function (key, value) {
                data += '<div class="post-container row" data-post-id="'+ value.post_id +'" style="margin-bottom: 90px">';
                data += '<div class="col">';
                data += '<div class="row mb-3">';
                data += '<div class="mx-3">';
                data += '<img class="rounded-circle" src="{{asset('assets/images/profile_pic')}}/'+value.profile_pic+'" width="50" height="50">';
                data += '</div>';
                data += '<div class="">';
                data += '<div>'+ value.user_name +'</div>';
                data += '<div>'+ value.post_created_at +'</div>';
                data += '</div>';
                data += '</div>';
                data += '<div class="row mb-3">';
                data += '<div class="col">';
                @auth
                    if (auth_user_id == value.user_id) {
                        data += '<div id="btn-container" class="d-flex">';
                        data += '<a href="{{route('fullPost', '')}}/'+ value.post_id +'"><span class="material-icons-outlined view-post p-2">visibility</span></a>';
                        data += '<span class="material-icons-outlined edit-post p-2">create</span>';
                        data += '<span class="material-icons-outlined delete-post p-2" data-toggle="modal" data-target="#deletePost">delete</span>';
                        data += '</div>';
                    }
                @endauth
                data += '<img class="img-fluid" src="{{asset('assets/images/blogs')}}/'+ value.post_image +'" width="600" height="180">';
                data += '</div>';
                data += '</div>';
                data += '<div class="row">';
                data += '<div class="col">';
                data += '<a class="text-dark" href="{{route('fullPost', '')}}/'+ value.post_id +'"><h3>'+ value.title +'</h3></a>';
                data += '</div>';
                data += '</div>';
                data += '</div>';
                data += '</div>';
            });

            let prev_page_disabled = !posts.prev_page_url ? 'disabled' : '';
            let next_page_disabled = !posts.next_page_url ? 'disabled' : '';


            data += '<nav aria-label="Page navigation example">';
            data += '<ul class="pagination">';
            data += '<li class="page-item page-link '+ prev_page_disabled +'" data-page="'+ (posts.current_page - 1) +'">Previous</li>';

            for (let i=1; i <= (posts.total / posts.per_page); i++) {
                let active_class = posts.current_page === i ? 'bg-primary text-white' : '';
                    data += '<li class="page-item page-link '+ active_class +'" data-page="'+ i +'">'+ i +'</li>';
            }
            data += '<li class="page-item page-link '+ next_page_disabled +'" data-page="'+ (posts.current_page + 1) +'">Next</li>';
            data += '</ul>';
            data += '</nav>';
        }

        $('#post-lists').html(data);
    }


    /***********************************
     *  CREATE POST
     **********************************/

    function store()
    {
        let form = $('#create-form');
        let formData = new FormData(form[0]);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            cache       : false,
            contentType : false,
            processData : false,
            success: function(response) {
                $('#createPost').modal('hide');
                alert(response.message);
                show();
            },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
    }


    /***********************************
     *  EDIT POST
     **********************************/

    function edit(post_id) {
        $.ajax({
            url: '{{route('edit', '')}}/'+post_id,
            type: 'post',
            success: function (response) {
                $('#EditPost').modal('show');

                $('#edit-post-title').val(response.data.title);

                tinyMCE.activeEditor.setContent('');
                tinymce.get("edit-post-body").execCommand('mceInsertContent', false, response.data.body);
            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }

    /***********************************
     *  UPDATE POST
     **********************************/

    function update(post_id) {

        let form = $('#edit-form');
        let formData = new FormData(form[0]);

        $.ajax({
            url: '{{route('update', '')}}/'+post_id,
            type: 'post',
            data: formData,
            cache       : false,
            contentType : false,
            processData : false,
            success: function (response) {
                $('#EditPost').modal('hide');
                show();
                alert(response.message);
            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }


    /***********************************
     *  DELETE POST
     **********************************/

    function destroy(post_id) {

        $.ajax({
            url: '{{route('destroy', '')}}/'+post_id,
            type: 'post',
            success: function (response) {
                show();
                $('#deletePost').modal('hide');
                alert(response.message);
            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }


</script>
