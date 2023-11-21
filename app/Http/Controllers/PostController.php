<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function showEditScreen(Post $post) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function deletePost(Post $post) {
        if(auth()->user()->id === $post['user_id']) {
           $post->delete();
        }
        return redirect('/');
    }

    public function updatePost(Post $post, Request $request) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

          $payload = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $payload['title'] = strip_tags($payload['title']);
        $payload['body'] = strip_tags($payload['body']);

        $post->update($payload);
        return redirect('/');
    }

    public function  createPost(Request $request) {
        $payload = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $payload['title'] = strip_tags($payload['title']);
        $payload['body'] = strip_tags($payload['body']);
        $payload['user_id'] = auth()->id();

        Post::create($payload);
        return redirect('/');
    }
}
