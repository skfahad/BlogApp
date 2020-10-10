<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'fullPost']);
    }

    public function index()
    {
        return view('posts.index');
    }

    public function show(Request $request)
    {
        $currentPage = $request->page ?? 1;

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        $query = Post::join('users', 'users.id', 'posts.user_id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.profile_pic',
                'posts.id as post_id',
                'posts.title',
                'posts.post_image',
                'posts.body as post_body',
                'posts.created_at as post_created_at'
            )
            ->orderBy('posts.updated_at', 'DESC');

        if (!empty($request->search_string)) {
            $query = $query->where('posts.title', 'LIKE', "%$request->search_string%");
        }

        $all_posts = $query->paginate(3);
        //$post_array = $all_posts->items();
        //$pagination = $all_posts->links();

        return response()->json($all_posts, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:120',
            'image' => 'required|image|max:1024',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['message' => $error], 402);
        }

        $extension = $request->image->extension();
        $hashed_name = uniqid().''.time().'.'.$extension;
        $request->image->move('assets/images/blogs',$hashed_name);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'post_image' => $hashed_name,
            'body' => $request->body,
        ]);

        return response()->json(['message' => 'Post created successfully'], 200);
    }

    public function edit(Post $post)
    {

        return response()->json(['data' => $post], 200);
    }

    public function update(Post $post, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:120',
            'image' => 'image|max:1024',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['message' => $error], 402);
        }

        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->has('image')) {

            File::delete('assets/images/blogs/'.$post->post_image);

            $extension = $request->image->extension();
            $hashed_name = uniqid().''.time().'.'.$extension;
            $request->image->move('assets/images/blogs',$hashed_name);

            $post->post_image = $hashed_name;
        }

        $post->save();

        return response()->json(['message' => 'Post update successfully'], 200);
    }

    public function destroy(Post $post)
    {

        File::delete('assets/images/blogs/'.$post->post_image);
        Post::destroy($post->id);

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }

    public function fullPost(Post $post)
    {
        $user_post = Post::join('users', 'users.id', 'posts.user_id')
            ->select(
                'users.name as user_name',
                'users.profile_pic',
                'posts.title',
                'posts.post_image',
                'posts.body as post_body',
                'posts.created_at as post_created_at'
            )
            ->where('posts.id', $post->id)
            ->first();

        return view('posts.full-post', compact('user_post'));
    }
}
