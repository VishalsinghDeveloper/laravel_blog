<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use App\Services\AdminService;
use App\Services\PostService;
use App\Http\Requests\CategoryAddRequest;

class ApiadminController extends Controller
{
    public function index()
    {
        return category::all();
    }
    public function addCategory(AdminService $AdminService, CategoryAddRequest $request)
    {
        $AdminService->addcategory($request);
        return response([
            'message' => 'category created Successfull',
            'status' => 'success',
        ]);
    }
    public function update(AdminService $AdminService, Request $request, $id)
    {
        $AdminService->UpdateCategory($request, $id);
        return response([
            'message' => 'category Upadate Successfull',
            'status' => 'success',
        ]);
    }
    public function destroy(AdminService $AdminService, $id , Category $category)
    {
        $AdminService->DeleteCategory($id);
        return response([
            'message' => 'category Delete Successfull',
            'status' => 'success',
        ]);
    }

    public function show(AdminService $AdminService,$id)
    {
        return $AdminService->ShowCategory($id);

    }

    public function user(AdminService $AdminService)
    {
        return $AdminService->ShowUser();
    }

}
