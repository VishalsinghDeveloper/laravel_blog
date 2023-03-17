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
use App\Http\Requests\LoginRequest;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;



class ApiauthController extends Controller
{
    public function login(AuthService $AuthService, LoginRequest $request, User $user)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $AuthService->UserLogin($request);
            $user = $request->user();
            $token = $user->createToken($request->email)->plainTextToken;
            return Response()->json([
                'loggedin' => true, 'success' => 'Login was successfully !',
                'user' => Auth::user(),
                'Token' => $token,
            ]);
        } else {
            return Response()->json([
                'loggedin' => false, 'failure' => 'Login was unuccessfully !! ',
                'message' => 'please enter right information '
            ]);
        }
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
