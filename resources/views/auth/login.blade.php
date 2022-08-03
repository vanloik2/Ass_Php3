@extends('auth.layout')
@section('content')
    <div class="login-wrap">
        <div class="login-html">
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
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1"
                class="tab">Sign In</label> 
            <a href=""><input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label></a>
            <div class="login-form">
                <div class="sign-in-htm">
                    <form action="{{ route('loginPost') }}" method="post">
                        @csrf
                        <div class="group">
                            <label for="user" class="label">Email</label>
                            <input id="user" type="text" class="input" name="email">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" type="password" class="input" name="password" data-type="password">
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Keep me Signed in</label>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign In">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
