@extends('layouts.master')

@section('title', 'Student : Edit')

@section('content')

<div class="mt-4">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Edit Students</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('students') }}">Student</a></li>
                            <li class="breadcrumb-item active">Edit Students</li>
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
                        <form action="{{ route('admin.students.update', $student->id) }}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title student-info">Student Information 
                                        <span>
                                            <a href="javascript:;">
                                                <i class="feather-more-vertical"></i>
                                            </a>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Full Name <span class="login-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Father Name <span class="login-danger">*</span></label>
                                        <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name', $student->father_name) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Admission Number <span class="login-danger">*</span></label>
                                        <input type="text" name="admission_no" id="admission_no" class="form-control" value="{{ old('admission_no', $student->admission_no) }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Class <span class="login-danger">*</span></label>
                                        <select name="section_id" id="section" class="form-control" required>
                                            <option value="">Select Class</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}" {{ old('section_id', $student->section_id) == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Gender <span class="login-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Religion <span class="login-danger">*</span></label>
                                        <select name="religion" id="religion" class="form-control" required>
                                            <option value="">Select Religion</option>
                                            <option value="hindi" {{ $student->religion == 'hindi' ? 'selected' : '' }}>Hindi</option>
                                            <option value="jain" {{ $student->religion == 'jain' ? 'selected' : '' }}>Jain</option>
                                            <option value="other" {{ $student->religion == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms calendar-icon">
                                        <label>Email : <span class="login-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms calendar-icon">
                                        <label>Date of Birth :  <span class="login-danger">*</span></label>
                                        <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $student->dob) }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Mobile Number</label>
                                        <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="{{ old('mobile_number', $student->mobile_number) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Roll Number</label>
                                        <input type="text" name="roll_number" id="roll_number" class="form-control" value="{{ old('roll_number', $student->roll_number) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                        <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Subjects <span class="login-danger">*</span></label>
                                        <div id="subjects-container">
                                            @foreach($subjects as $subject)
                                                <div class="form-check subject-option" data-section="{{ $subject->section->id }}">
                                                    <input class="form-check-input" type="checkbox" name="subjects[]" value="{{ $subject->id }}" id="subject{{ $subject->id }}"
                                                        @if($student->subjects->contains($subject->id)) checked @endif>
                                                    <label class="form-check-label" for="subject{{ $subject->id }}">
                                                        {{ $subject->name }} ({{ $subject->section->name }})
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-12 col-sm-4">
                                    <div class="form-group students-up-files">
                                        <label>Upload Student Photo (150px X 150px)</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                Choose File 
                                                <input type="file" name="photo" id="photo" class="form-control" accept=".jpg, .jpeg, .png">
                                            </label>
                                            <!-- Display the name of the selected file -->
                                            <small id="file-name" class="form-text text-muted mt-2"></small>
                                            
                                            <!-- Display the current student photo if it exists -->
                                            @if($student->photo)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" width="100">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
document.addEventListener('DOMContentLoaded', function () {
    const sectionSelect = document.getElementById('section');
    const subjectsContainer = document.getElementById('subjects-container');

    function filterSubjects() {
        const selectedSection = sectionSelect.value;

        document.querySelectorAll('.subject-option').forEach(option => {
            const sectionId = option.dataset.section;
            if (selectedSection === '' || selectedSection === sectionId) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    }

    sectionSelect.addEventListener('change', filterSubjects);

    filterSubjects(); // Initial filter based on default value
});

//here we are file type and ensure image 
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('photo');
    const fileNameDisplay = document.getElementById('file-name');
    const allowedExtensions = ['jpg', 'jpeg', 'png'];

    fileInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();

            if (allowedExtensions.includes(fileExtension)) {
                // Display the selected file name with an appropriate message
                fileNameDisplay.textContent = `New Image Selected: ${fileName}`;
                fileNameDisplay.style.color = 'green'; // Optional: Change text color to indicate success
            } else {
                // Reset the file input
                this.value = '';
                fileNameDisplay.textContent = '';

                // Display an alert for invalid file type
                alert('Invalid file type! Please upload an image file (.jpg, .jpeg, .png).');
            }
        } else {
            // If no file is selected, clear the file name display
            fileNameDisplay.textContent = '';
        }
    });
});
</script>
@endsection
