<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        //$posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(5);
        $posts = Post::latest()->with(['user', 'likes'])->paginate(5);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        #dd($request);
        # return view('posts.index');

        $this->validate($request, [
            'body' => 'required'
        ]);

        // old
        #Post::create([
        #    'user_id' => auth()->id(),
        #    'body' => $request->body
        #]);

        //eloquent

        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        if (!$post->ownedBy(auth()->user)) {
            dd('no');
        }

        $post->delete();

        return back();
    }
}
