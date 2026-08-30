<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function showCreateForm(Request $request)
    {
        return view('create-post');
    }

    public function saveNewPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => ["required", "max:1000"]
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('success', 'Post successful created');
    }

    public function viewPost(Post $post)
    {
        return view('single-post', [
            'post' => $post
        ]);
    }
}
