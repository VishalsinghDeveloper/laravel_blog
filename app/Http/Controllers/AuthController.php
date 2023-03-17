<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\AuthService;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{

    public function logout(AuthService $AuthService,)
    {
        $AuthService->UserLogout();
        return redirect(route('login'));
    }

    public function index()
    {
        return view('auth.login');
    }
    public function login(AuthService $AuthService, Request $request)
    {
        $AuthService->UserLogin($request);
        return redirect('/')->withError('Login details are not valid');
    }
    public function register_view()
    {
        return view('auth.register');
    }

    public function  register(AuthService $AuthService, RegisterUserRequest $request)
    {
        $AuthService->UserRegister($request);
        return redirect('register')->withError('Error');
    }
}
