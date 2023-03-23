<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;


class AuthService
{
    public function  UserRegister(RegisterUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect(route('home'));
        }
    }

    public function UserLogin(LoginRequest $request,)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            $user->save();
        }
    }

    public function UserLogout()
    {
        Session::flush();
        Auth::logout();
    }
}
