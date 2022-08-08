<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function register()
    {

        return view('auth.register');
    }

    public function registerPost(RegisterRequest $request)
    {

        $user = new User($request->all());

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('login')->with('success', 'Đăng ký thành công');
    }

    public function login()
    {

        return view('auth.login');
    }

    public function loginPost(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $request->session()->regenerate();

            return redirect()->route('user.index');
        }

        return back()->with('error', 'Dữ liệu không hợp lệ');
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }

    public function loginGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function loginGoogleCallback()
    {

        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {

            Auth::login($user);
            return redirect('/admin/user');
        } else {
            return redirect()->route('register')->with('error', 'Bạn chưa đăng ký tài khoản');
        }
    }
}
