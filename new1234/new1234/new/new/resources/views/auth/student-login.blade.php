@extends('layouts.auth')

@section('title', 'School - Student Login')

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
                            <h1>Welcome to Student Login</h1>
                            <p class="account-subtitle">Need an account? Connect to Admin</p>
                            <h2>Sign in</h2>

                            <!-- Display errors if any -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('student.login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="admission_no">Admission Number <span class="login-danger">*</span></label>
                                    <input type="text" name="admission_no" id="admission_no" class="form-control @error('admission_no') is-invalid @enderror" required>
                                    
                                    @error('admission_no')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password <span class="login-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                    
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
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

