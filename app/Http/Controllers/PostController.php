<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function showCreateForm(Request $request)
    {
        return view('create-post');
    }

    public function saveNewPost(Request $request)
    {
        $incomingFields = $this->validateAndSanitizePost($request);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('success', 'Post successful created');
    }

    public function viewPost(Post $post)
    {
        // translate body content markdown into html and restricted allowed html tags 
        $postHtml = strip_tags(Str::markdown($post->body), '<p><ul><ol><li><br><strong><em><h1><h2><h3><h4><h5><h6>');
        $post['body'] = $postHtml;

        return view('single-post', [
            'post' => $post
        ]);
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect('/profile/' . auth()->user()->id)->with('success', 'Post successful deleted');
    }

    public function getForm(Post $post)
    {
        return view('edit-post', ['post' => $post]);
    }
    
    public function updateForm(Post $post, Request $request)
    {
        $incomingFields = $this->validateAndSanitizePost($request);

        $post->update($incomingFields);

        return redirect("/post/{$post->id}")->with('success', 'Post successful updated');
    }

    private function validateAndSanitizePost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => ["required", "max:5000"]
        ]);
        // remove html tags before save
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        return $incomingFields;
    }

}
