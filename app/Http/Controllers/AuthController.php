<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function register(){

        return view('auth.register');

    }

    public function actionRegister(Request $request){

        $user = new User($request->all());

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('login');

    }

    public function login(){

        return view('auth.login');

    }

    public function actionLogin(Request $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            $request->session()->regenerate();

            return redirect()->route('home');

        }

        return back()->with('error', 'Dữ liệu không hợp lệ');

    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');

    }

}
