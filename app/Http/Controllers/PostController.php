<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('posts.index', ['category' => $category]);
    }

    public function add_post(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'categories' => 'required',
            'image' => 'required',
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/post/', $filename);
            $post->image = $filename;
        }
        $post->user_id = Auth::user()->id;
        $post->save();
        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }
        return redirect()->back();
    }

    public function edit(Post $post, $id)
    {
        if (Auth::user()->id == Post::find($id)->user->id) {
            $category = Category::all();
            $post = Post::find($id);
            return view('posts.edit', compact('category', 'post'));
        } else {
            return abort('401');
        }
    }

    public function update(Request $request, $id, Post $post)
    {
        if (Auth::user()->id == Post::find($id)->user->id) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
                'categories' => 'required|exists:App\Models\Category,id',
            ]);

            $post = Post::find($id);
            $post->title = $request->title;
            $post->description = $request->description;
            if ($request->hasfile('image')) {
                $des = 'uploads/post/' . $post->image;
                if (File::exists($des)) {
                    File::delete($des);
                }
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('uploads/post/', $filename);
                $post->image = $filename;
            }
            $post->categories()->sync($request->categories);
            $post->update();
            return redirect()->back();
        } else {
            return abort('401');
        }
    }

    public function destroy(Request $request, $id,  Post $post)
    {
        if (Auth::user()->id == Post::find($id)->user->id) {
            $post = Post::find($id);
            $des = 'uploads/post/' . $post->image;
            if (File::exists($des)) {
                File::delete($des);
            }
            $post->categories()->detach();
            $post->delete();
            return redirect()->back();
        } else {
            return abort('401');
        }
    }

    public function post()
    {
        $post = [];
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $post = Post::where('user_id', $user_id)->get();
        }
        return view('posts.show', ['post' => $post]);
    }
}
