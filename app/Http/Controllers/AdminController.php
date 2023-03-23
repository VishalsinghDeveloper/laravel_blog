<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use App\Services\AdminService;
use App\Services\PostService;
use App\Http\Requests\CategoryAddRequest;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function show()
    {
        $post = Post::all();
        return view('admin.show', ['post' => $post]);
    }

    public function category()
    {
        return view('admin.category');
    }

    public function addCategory(AdminService $AdminService, CategoryAddRequest $request)
    {

        $AdminService->addcategory($request);
        return redirect(route('category'));
    }

    public function edit($id)
    {
        $category = category::find($id);
        return view('admin.edit', ['category' => $category]);
    }

    public function update(AdminService $AdminService, Request $request, $id)
    {
        $AdminService->UpdateCategory($request, $id);
        return redirect(route('update&delete'));
    }

    public function destroy(AdminService $AdminService, $id)
    {
        $AdminService->DeleteCategory($id);
        return redirect()->back();
    }

    public function showcategory()
    {
        $category = category::all();
        return view('admin.showcategory', ['category' => $category]);
    }

    public function update_delete()
    {
        $category = category::all();
        return view('admin.update&delete', ['category' => $category]);
    }

    public function user()
    {
        $user = User::all();
        return view('admin.user', ['user' => $user]);
    }

    public function postedit(Post $post, $id)
    {
        $category = Category::all();
        $post = Post::find($id);
        return view('admin.postedit', compact('category', 'post'));
    }

    public function postupdate(PostService $postService, Request $request, $id)
    {
        $postService->postupdate($request, $id);
        return redirect()->back();
    }

    public function Postdestroy(PostService $postService, Request $request, $id,  Post $post)
    {
        $postService->deletepost($request, $id);
        return redirect()->back();
    }
}
