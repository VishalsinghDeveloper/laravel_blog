<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryAddRequest;
use Illuminate\Http\Request;

class AdminService
{
    public function addcategory(CategoryAddRequest $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();
    }

    public function UpdateCategory(Request $request, $id)
    {
        $category = category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();
    }
    public function DeleteCategory($id)
    {
        $category = category::find($id);
        $category->delete();
    }

    public function ShowCategory($id)
    {
        return  category::find($id);
    }
    public function ShowUser()
    {
        return User::all();
    }
}
