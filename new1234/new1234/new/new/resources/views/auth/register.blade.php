@extends('layouts.auth')

@section('title', 'School - Register')

@section('content')

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ asset('assets/img/login.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Sign Up</h1>
                            <p class="account-subtitle">Enter details to create your account</p>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group" style="position: relative; margin-bottom: 20px;">
                                    <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Username <span class="login-danger">*</span></label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="padding-left: 2.5rem;">
                                    <span class="profile-views" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"><i class="fas fa-user-circle"></i></span>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="position: relative; margin-bottom: 20px;">
                                    <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email <span class="login-danger">*</span></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="padding-left: 2.5rem;">
                                    <span class="profile-views" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"><i class="fas fa-envelope"></i></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="position: relative; margin-bottom: 20px;">
                                    <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Password <span class="login-danger">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="padding-left: 2.5rem;">
                                    <span class="profile-views feather-eye toggle-password" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="position: relative; margin-bottom: 20px;">
                                    <label for="password-confirm" style="display: block; margin-bottom: 5px; font-weight: bold;">Confirm Password <span class="login-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="padding-left: 2.5rem;">
                                    <span class="profile-views feather-eye reg-toggle-password" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></span>
                                </div>

                                <div class="dont-have" style="margin-top: 10px;">Already Registered? <a href="{{ route('login') }}">Login</a></div>
                                <div class="form-group mb-0" style="margin-top: 20px;">
                                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                                </div>
                            </form>



                            {{-- <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>

                            <div class="social-login">
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

   