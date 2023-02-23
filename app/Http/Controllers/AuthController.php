<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;




class AuthController extends Controller
{

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('');
    }

    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect(route('home'));
        }

        return redirect('/')->withError('Login details are not valid');

    }
    public function register_view(){
        return view('auth.register');
    }

    public function  register(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if(Auth::attempt($request->only('email','password'))){
            return redirect(route('home'));
        }

        return redirect('register')->withError('Error');

    }


}
