@extends('layouts.app')

@section('content')

    <div class="row px-5 justify-content-center">
        <div class="col-lg-6">

            <div class="row mb-3">
                <div class="col">
                    <h3>{{$user_post->title}}</h3>
                </div>
            </div>

            <div class="row mb-3">
                <div class="mx-3">
                    <img class="rounded-circle" src="{{asset('assets/images/profile_pic/'.$user_post->profile_pic)}}"
                         width="50" height="50">
                </div>
                <div class="">
                    <div>{{$user_post->user_name}}</div>
                    <div>{{$user_post->post_created_at}}</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <img src="{{asset('assets/images/blogs/'.$user_post->post_image)}}" alt=""
                         width="100%" height="100%">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    {!! $user_post->post_body !!}
                </div>
            </div>

        </div>
    </div>

@endsection
