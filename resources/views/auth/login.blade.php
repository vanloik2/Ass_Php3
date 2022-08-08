@extends('auth.layout')
@section('content')
    
    <form action="{{ route('loginPost') }}" class="login100-form validate-form" method="POST">
        @csrf
        <span class="login100-form-title p-b-49">
            Đăng Nhập
        </span>
        <div>
            @if ($errors->any())
                <ul class="alert alert-danger list-unstyled text-center">
                    <li class="text-danger">{{ $errors->all()[0] }}</li>
                </ul>
            @endif
            @if (session('success'))
                <ul class="alert alert-success list-unstyled text-center">
                    <li class="text-success">{{ session('success') }}</li>
                </ul>
            @endif
            @if (session('error'))
                <ul class="alert alert-danger list-unstyled text-center">
                    <li class="text-danger">{{ session('error') }}</li>
                </ul>
            @endif
        </div>
        <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
            <span class="label-input100">Email User</span>
            <input class="input100" type="text" name="email" value="{{ old('email') }}" placeholder="Type your username">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="Type your password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>

        <div class="text-right p-t-8 p-b-31">
            <a href="#">
                Forgot password?
            </a>
        </div>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">
                    Login
                </button>
            </div>
        </div>
        
        <div class="txt1 text-center p-t-54 p-b-20">
            <span>
                Or Sign Up Using
            </span>
        </div>

        <div class="flex-c-m">
            <a href="#" class="login100-social-item bg1">
                <i class="fa fa-facebook"></i>
            </a>

            <a href="#" class="login100-social-item bg2">
                <i class="fa fa-twitter"></i>
            </a>

            <a href="{{ route('login-google') }}" class="login100-social-item bg3">
                <i class="fa fa-google"></i>
            </a>
        </div>

        <div class="flex-col-c p-t-40">
            <span class="txt1 p-b-17">
                Or Sign Up Using
            </span>

            <a href="{{ route('register') }}" class="txt2">
                Sign Up
            </a>
        </div>
    </form>
@endsection
