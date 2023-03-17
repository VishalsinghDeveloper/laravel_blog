<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
class ApipostController extends Controller
{
    public function index()
    {
        // $post =  Post::with(['categories'])->get();
        // return response()->json($post);

        return response()->json(PostResource::collection(Post::all()));
    }

    public function add_post(PostService $postService, StorePostRequest $request ,Post $post)
    {
        $postService->createpost($request);
        return  response([
            'message' => 'post Add  Successfull',
            'status' => 'success',
        ]);
    }
    public function update(PostService $postService, Request $request, $id)
    {
        $postService->postupdate($request, $id);
        return response([
            'message' => 'Post update Successfull',
            'status' => 'success',
        ]);
    }
    public function destroy(PostService $postService, Request $request, $id,  Post $post)
    {
        $postService->deletepost($request, $id);

        return response([
            'message' => 'Post delete Successfull',
            'status' => 'success',
        ]);
    }
}
