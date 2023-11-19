<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function createPost(Request $request) {
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
