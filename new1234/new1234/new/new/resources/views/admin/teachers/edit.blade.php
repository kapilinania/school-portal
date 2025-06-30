@extends('layouts.master')

@section('title', 'Teacher : Edit')


@section('content')


    <!-- ---side content goes here --  -->

    <div class="mt-4">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Teachers</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('teachers') }}">Teacher</a></li>
                                <li class="breadcrumb-item active">Edit Teachers</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title teachers-info">Teacher Information
                                            <span>
                                                <a href="javascript:;">
                                                    <i class="feather-more-vertical"></i>
                                                </a>
                                            </span>
                                        </h5>
                                    </div>
                            
                                    <!-- Full Name -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Full Name <span class="login-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', $teacher->name) }}" required>
                                        </div>
                                    </div>
                            
                                    <!-- Teacher ID -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Teacher Id <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="teacher_id" name="teacher_id"
                                                value="{{ old('teacher_id', $teacher->teacher_id) }}" required>
                                        </div>
                                    </div>
                            
                                    <!-- Email -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email : <span class="login-danger">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ old('email', $teacher->email) }}" required>
                                        </div>
                                    </div>
                            
                                    <!-- Mobile Number -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mobile Number</label>
                                            <input type="text" name="mobile_number" id="mobile_number"
                                                class="form-control"
                                                value="{{ old('mobile_number', $teacher->mobile_number) }}" required>
                                        </div>
                                    </div>
                            
                                    <!-- Date of Birth -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Date of Birth</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                class="form-control"
                                                value="{{ old('date_of_birth', $teacher->date_of_birth ? \Carbon\Carbon::parse($teacher->date_of_birth)->format('Y-m-d') : '') }}"
                                                required>
                            
                                        </div>
                                    </div>
                            
                                    <!-- Password -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                            <small class="form-text text-muted">Leave blank if you don't want to change the
                                                password.</small>
                                        </div>
                                    </div>
                            
                                    <!-- Confirm Password -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control">
                                        </div>
                                    </div>
                            
                                    
                            
                                    <!-- Sections -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Sections <span class="login-danger">*</span></label>
                                            <div id="sections-container">
                                                @foreach ($sections as $section)
                                                    <div>
                                                        <input type="checkbox" name="sections[]" value="{{ $section->id }}"
                                                            id="section-{{ $section->id }}"
                                                            {{ in_array($section->id, old('sections', $teacher->sections->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                        <label for="section-{{ $section->id }}">{{ $section->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            
                                    <!-- Subjects -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Subjects <span class="login-danger">*</span></label>
                                            <div id="subjects-container">
                                                @foreach ($subjects as $subject)
                                                    <div class="subject-group"
                                                        data-section-id="{{ $subject->section_id }}">
                                                        <input type="checkbox" name="subjects[]"
                                                            value="{{ $subject->id }}" id="subject-{{ $subject->id }}"
                                                            {{ in_array($subject->id, old('subjects', $teacher->subjects->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                        <label for="subject-{{ $subject->id }}">{{ $subject->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            
                                    <!-- No Subjects Message -->
                                    <div id="no-subjects-message" style="display: none;">
                                        No subjects available for the selected sections.
                                    </div>

                                    <!-- Profile Image -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group students-up-files">
                                            <label>Upload Teacher Photo (150px X 150px)</label>
                                            <div class="uplod">
                                                <label class="file-upload image-upbtn mb-0">
                                                    Choose File
                                                    <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
                                                </label>
                                                <p id="file-name" class="mt-2"></p> <!-- Selected file name display -->
                                                @if ($teacher->profile_image)
                                                    <img src="{{ asset('storage/' . $teacher->profile_image) }}" alt="Profile Image" width="100">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.getElementById('profile_image').addEventListener('change', function () {
        var fileInput = this;
        var file = fileInput.files[0];

        if (file) {
            var fileName = file.name;
            var fileType = file.type;

            // Check if the selected file is an image (jpg, png)
            if (!fileType.startsWith('image/')) {
                alert('Please select a valid image file (jpg, png).');
                fileInput.value = ''; // Clear the file input if it's not an image
                document.getElementById('file-name').textContent = ''; // Clear displayed file name
            } else {
                document.getElementById('file-name').textContent = 'Selected File: ' + fileName; // Display file name
            }
        }
    });
</script>
@endsection
