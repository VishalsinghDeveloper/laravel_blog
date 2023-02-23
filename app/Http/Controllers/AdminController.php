<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function dashboard(){
        return view ('admin.dashboard');
    }

    public function show(){
        $post=Post::all();
        return view ('admin.show',['post'=>$post]);
    }

    public function category(){
        return view ('admin.category');
    }



    public function addCategory(Request $request){

        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect(route('category'));
    }

    public function edit($id){
        $category = category::find($id);
        return view('admin.edit' ,['category'=>$category]);

    }

    public function update(Request $request , $id){

        $category = category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect(route('show'));

    }
    public function destroy($id)
    {
        $category = category::find($id);
        $category->delete();
        return redirect()->back();

    }

    public function showcategory(){
        $category = category::all();
        return view('admin.showcategory' ,['category'=>$category]);


    }

    public function update_delete(){
        $category = category::all();
        return view('admin.update&delete' ,['category'=>$category]);
    }

   public function user()
   {
    $user= User::all();
    return view('admin.user' ,['user'=>$user]);

   }

   public function userdelete($id){
    $user= User::find($id);
    $user->delete();

   }


   public function pedit(Post $post, $id)
   {


       $category = Category::all();
       $post = Post::find($id);
       return view('admin.postedit', compact('category', 'post'));
   }

   public function pupdate(Request $request, $id, Post $post)
   {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'categories' => 'required|exists:App\Models\Category,id',
    ]);

    $post = Post::find($id);
    $post->title = $request->title;
    $post->description = $request->description;
    if ($request->hasfile('image')) {
        $des = 'uploads/post/'.$post->image;
        if(File::exists($des)){
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
   }

   public function pdestroy(Request $request, $id,  Post $post)
   {
    $post = Post::find($id);
    $des = 'uploads/post/'.$post->image;
    if(File::exists($des)){
        File::delete($des);
    }
    $post->categories()->detach();
    $post->delete();
    return redirect()->back();
   }


}
