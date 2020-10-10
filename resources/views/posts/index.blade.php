@extends('layouts.app')

@section('head')
    <style>
        .tox .tox-statusbar {
            display: none !important;
        }
        .header {
            box-shadow: 0 2px 6px 0 rgba(0,0,0,.12), inset 0 -1px 0 0 #dadce0;
        }
        #btn-container span {
            color: #03a87c;
            cursor: pointer;
        }
        .input-group-append, .input-group-prepend {
            cursor: pointer;
        }

        #create-post-modal-btn  {
            position: fixed;
            background: #1A8DFE;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 1;
        }
        #create-post-modal-btn div {
            font-size: 2rem;
            line-height: 52px;
            text-align: center;
            color: white;
            cursor: pointer;
        }

        #createPost .modal-dialog, #EditPost .modal-dialog {
            max-width: 700px;
        }

        .page-link.disabled {
            cursor: not-allowed;
            color: grey;
        }
    </style>
@endsection



@section('content')

    <div id="create-post-modal-btn" data-toggle="modal" data-target="#createPost">
        <div>+</div>
    </div>

    <div class="row px-5">
        <div class="col-lg-6">

            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <input id="query-string" type="text" class="form-control" name="post" placeholder="Search Posts...">
                        <div id="search-post" class="input-group-append">
                            <span class="input-group-text bg-dark text-white" id="basic-addon2">Search</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row header mb-4 p-3">
                <h3 class="col">All Posts</h3>
            </div>

            <div id="post-lists"></div>

        </div>
    </div>

    @include('posts.create')
    @include('posts.edit')
    @include('posts.delete')
@endsection

@section('scripts')
    @include('posts.script')
@endsection
