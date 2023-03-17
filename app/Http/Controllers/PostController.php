<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('posts.index', ['category' => $category]);
    }

    public function add_post(PostService $postService, StorePostRequest $request)
    {
        $postService->createpost($request);
        return redirect()->back();
    }
    public function edit(PostService $postService, Request $request, $id)
    {
        $postService->postedit($request, $id);
        $category = Category::all();
        $post = Post::find($id);
        return view('posts.edit', compact('category', 'post'));
    }

    public function update(PostService $postService, Request $request, $id)
    {
        $postService->postupdate($request, $id);
        return redirect()->back();
    }

    public function destroy(PostService $postService, Request $request, $id,  Post $post)
    {
        $postService->deletepost($request, $id);
        return redirect()->back();
    }

    public function post()
    {
        $post = [];
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $post = Post::where('user_id', $user_id,)->get();
        }
        return view('posts.show', ['post' => $post]);
    }
}
