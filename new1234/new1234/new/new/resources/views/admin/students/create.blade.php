@extends('layouts.master')

@section('title', 'Student : Add')

@section('content')


    <!-- ---side content goes here --  -->
    <div class="mt-4">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Add Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('students') }}">Student</a></li>
                                <li class="breadcrumb-item active">Add Students</li>
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
                            <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Enter Full Name" value="{{ old('name') }}" required>

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father Name <span class="login-danger">*</span></label>
                                            <input type="text" name="father_name" id="father_name"
                                                placeholder="Enter Father Name" class="form-control"
                                                value="{{ old('father_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Admission Number <span class="login-danger">*</span></label>
                                            <input type="text" name="admission_no" id="admission_no"
                                                placeholder="Enter Admission Number" class="form-control"
                                                value="{{ old('admission_no') }}" required>

                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select name="section_id" id="section" class="form-control" required>
                                                <option value="">Select Class</option>
                                                @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    



                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Religion <span class="login-danger">*</span></label>
                                            <select name="religion" id="religion" class="form-control" required>
                                                <option value="">Select Religion</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Jain">Jain</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email : <span class="login-danger">*</span></label>
                                            <input type="email" placeholder="Enter Your Email" name="email"
                                                id="email" class="form-control" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Date of Birth: <span class="login-danger">*</span></label>
                                            <input type="date" name="dob" id="dob" class="form-control"
                                                value="{{ old('dob') }}" required>
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mobile Number</label>
                                            <input type="number" name="mobile_number"
                                                placeholder="Enter Your Mobile Number" id="mobile_number"
                                                class="form-control" value="{{ old('mobile_number') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Roll Number</label>
                                            <input type="number" placeholder="Enter Your Roll Number" name="roll_number"
                                                id="roll_number" class="form-control" value="{{ old('roll_number') }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Subjects <span class="login-danger">*</span></label>
                                            <div id="subjects-container">
                                                <p id="no-selection-message" class="text-danger">No subjects available.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-4">
                                        <div class="form-group students-up-files">
                                            <label>Upload Student Photo (150px X 150px)</label>
                                            <div class="uplod">
                                                <label class="file-upload image-upbtn mb-0">
                                                    Choose File <input type="file" name="photo" id="photo" class="form-control" accept=".jpg, .jpeg, .png">
                                                </label>
                                                <small id="file-name" class="form-text text-muted"></small> <!-- This will show the file name -->
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
  $(document).ready(function() {
        // Hide the no subjects message by default
        $('#no-selection-message').hide();

        // Listen for the section dropdown change event
        $('#section').on('change', function() {
            var sectionId = $(this).val();

            if (sectionId) {
                $.ajax({
                    url: '/admin/subjects-by-section', // URL to your route that fetches subjects
                    type: 'GET',
                    data: { section_id: sectionId }, // Send the selected section ID
                    success: function(response) {
                        $('#subjects-container').empty(); // Clear previous subjects

                        if (response.length > 0) {
                            // Append subjects to the container
                            response.forEach(function(subject) {
                                $('#subjects-container').append(`
                                    <div class="form-check subject-option" data-section="${subject.section_id}" style="margin-bottom: 8px; display: flex; align-items: center;">
                                        <input class="form-check-input" type="checkbox" name="subjects[]"
                                            value="${subject.id}" id="subject${subject.id}" style="margin-right: 10px;">
                                        <label class="form-check-label text-dark" for="subject${subject.id}" style="margin: 0;">
                                            ${subject.name}
                                        </label>
                                    </div>
                                `);
                            });
                        } else {
                            // Show message if no subjects available
                            $('#subjects-container').html('<p class="text-danger">No subjects available for this section.</p>');
                        }
                    },
                    error: function(xhr) {
                        $('#subjects-container').html('<p class="text-danger">Subject not Add</p>');
                    }
                });
            } else {
                $('#subjects-container').html('<p class="text-danger">No subjects available.</p>');
            }
        });
    });

//here we are display photo name and file type ensure
    document.getElementById('photo').addEventListener('change', function() {
    const fileInput = this;
    const fileNameDisplay = document.getElementById('file-name');
    const allowedExtensions = ['jpg', 'jpeg', 'png'];
    const file = fileInput.files[0];

    if (file) {
        const fileName = file.name;
        const fileExtension = fileName.split('.').pop().toLowerCase();

        // Check if the file type is allowed (jpg, jpeg, png)
        if (allowedExtensions.includes(fileExtension)) {
            fileNameDisplay.textContent = `Selected File: ${fileName}`;
        } else {
            // Show an error if the file type is not allowed
            fileInput.value = ''; // Reset the input value
            fileNameDisplay.textContent = '';
            alert('Invalid file type! Please upload an image file (.jpg, .jpeg, .png).');
        }
    } else {
        fileNameDisplay.textContent = '';
    }
});


</script>
@endsection


