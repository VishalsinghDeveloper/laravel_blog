<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Doctrine\Common\Lexer\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Services\AuthService;
use App\Http\Requests\RegisterUserRequest;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;



class ApiauthController extends Controller
{
    public function login(AuthService $AuthService, Request $request, User $user)
    {
        $AuthService->UserLogin($request);
        $user = $request->user();
        $token = $user->createToken($request->email)->plainTextToken;
        return Response()->json([
            'loggedin' => true, 'success' => 'Login was successfully !',
            'user' => Auth::user(),
            'Token' => $token,
        ]);
    }
    public function  register(AuthService $AuthService, RegisterUserRequest $request)
    {
        $AuthService->UserRegister($request);
        $user = $request->user();
        $token = $user->createToken($request->email)->plainTextToken;
        return response([
            'message' => 'registraition Successfull',
            'status' => 'success',
            'Token' => $token,


        ]);
    }
}
