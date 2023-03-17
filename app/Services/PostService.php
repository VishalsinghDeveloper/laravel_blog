<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;

class PostService
{
    public function createpost(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth::user()->id;
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
        $post->save();
        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }
    }
    public function postupdate(Request $request, $id)
    {
        if (Auth::user()->id == Post::find($id)->user->id) {
            $post = Post::find($id);
            $post->update($request->all());
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
            if ($request->has('categories')) {
                $post->categories()->sync($request->categories);
            }
            $post->update();
        }
    }

    public function postedit(Request $request, $id)
    {
        if (Auth::user()->id == Post::find($id)->user->id) {
        } else {
            return abort('401');
        }
    }

    public function deletepost(Request $request, $id)
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
}
