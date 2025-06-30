@extends('layouts.auth')

@section('title', 'School - Teacher Login')

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
                            <h1>Welcome to Teacher Login</h1>
                            <p class="account-subtitle">Need an account? Connect to Admin</p>
                            <h2>Sign in</h2>    

                            <form method="POST" action="{{ route('teacher.login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="teacher_id">Teacher ID <span class="login-danger">*</span></label>
                                    <input type="text" name="teacher_id" id="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" required>
                                    
                                    @error('teacher_id')
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
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
