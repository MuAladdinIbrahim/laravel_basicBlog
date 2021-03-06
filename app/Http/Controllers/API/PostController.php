<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Post;

class PostController extends Controller
{
    public function index()
    {

        // return PostResource::collection(Post::with('user')->get());
        return new PostCollection(Post::with('user')->paginate());
    }

    public function show($post)
    {
        return new PostResource(Post::find($post));
    }

    public function store()
    {
        $request = request();
        Post::create($request->only(['title', 'description', 'user_id']));
        return redirect()->route('posts.index');
    }
}