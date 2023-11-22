<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', function () {
    $posts = [];

    if(auth()->check()) {
        // take the posts by user auth()->user() returns current user
        $posts = auth()->user()->userPosts()->latest()->get();
    }
    // for all posts
    // $posts = Post::all();

    // get post per current user
    // $posts = Post::where('user_id', auth()->id())->get();

    return response()->json($posts, 200);
});


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//  Blog Posts
Route::post('/create-post', [PostController::class, 'createPost']);

Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);

Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
