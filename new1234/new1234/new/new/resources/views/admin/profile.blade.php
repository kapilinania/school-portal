<!-- resources/views/admin/profile.blade.php -->
@extends('layouts.master')
@section('title', 'Admin - Profile')

@section('content')
    <div class="container mt-4">
        <h3>Edit Admin Profile</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf

            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" readonly>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group position-relative">
                <label for="password">Password (leave blank to keep current password)</label>
                <input type="password" class="form-control" id="password" name="password">
                <i class="fas fa-eye toggle-password position-absolute" style="right: 10px; top: 45px; cursor: pointer;"></i>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group position-relative">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                <i class="fas fa-eye toggle-password position-absolute" style="right: 10px; top: 45px; cursor: pointer;"></i>
            </div>

            <!-- Old Password Field (Required for verification) -->
            <div class="form-group position-relative">
                <label for="old_password">Old Password (required to save changes)</label>
                <input type="password" class="form-control" id="old_password" name="old_password" required>
                <i class="fas fa-eye toggle-password position-absolute" style="right: 10px; top: 45px; cursor: pointer;"></i>
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <!-- Add Font Awesome for the eye icon -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Add JavaScript to toggle password visibility -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', function () {
                let passwordField = this.previousElementSibling;
                let fieldType = passwordField.getAttribute('type');
                
                if (fieldType === 'password') {
                    passwordField.setAttribute('type', 'text');
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    passwordField.setAttribute('type', 'password');
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    </script>
@endsection
