@extends('layouts.master')

@section('title', 'Student : create')

@section('content')



    <!-- ---side content goes here --  -->
    <div class="mt-4">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Add Teacher</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('students') }}">Teacher</a></li>
                                <li class="breadcrumb-item active">Add Teacher</li>
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
                            <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Teacher Information
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
                                            <label>Teacher ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="teacher_id" name="teacher_id"
                                                required>
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms ">
                                            <label>Email : <span class="login-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control" id="mobile_number"
                                                name="mobile_number" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label for="date_of_birth">Date of Birth:</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                class="form-control"
                                                value="{{ old('date_of_birth', isset($teacher) ? $teacher->date_of_birth->format('Y-m-d') : '') }}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Class</label>
                                            <div id="sections">
                                                @foreach ($sections as $section)
                                                    <div class="form-check">
                                                        <input class="form-check-input section-checkbox" type="checkbox" value="{{ $section->id }}" id="section{{ $loop->index }}" name="sections[]">
                                                        <label class="form-check-label" for="section{{ $loop->index }}">
                                                            {{ $section->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Subjects</label>
                                            <div id="subjects">
                                                <p id="no-selection-message" class="text-danger" style="display: none;">No section selected</p>
                                                @foreach ($subjects as $subject)
                                                    <div class="form-check subject-option" data-section="{{ $subject->section_id }}">
                                                        <input class="form-check-input" type="checkbox" value="{{ $subject->id }}" id="subject{{ $subject->id }}" name="subjects[{{ $subject->section_id }}][]">
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
                                            <label>Upload Teacher Photo (150px X 150px)</label>
                                            <div class="uplod">
                                                <label class="file-upload image-upbtn mb-0">
                                                    Choose File
                                                    <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*">
                                                </label>
                                                <p id="file-name" class="mt-2"></p> <!-- File name display -->
                                                @if (isset($teacher) && $teacher->profile_image)
                                                    <img src="{{ Storage::url($teacher->profile_image) }}" alt="Profile Image" width="100">
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
        document.addEventListener('DOMContentLoaded', function() {
            function updateSubjects() {
                // Get all selected sections
                var selectedSections = Array.from(document.querySelectorAll('#sections input:checked')).map(
                    function(checkbox) {
                        return checkbox.value;
                    });

                console.log("Selected Sections: ", selectedSections);

                if (selectedSections.length > 0) {
                    // Hide the "No section selected" message
                    document.getElementById('no-selection-message').style.display = 'none';

                    // Show subjects that match any of the selected sections
                    document.querySelectorAll('#subjects .subject-option').forEach(function(subject) {
                        var section = subject.getAttribute('data-section');
                        if (selectedSections.includes(section)) {
                            subject.style.display = 'flex'; // Ensure subjects are visible
                        } else {
                            subject.style.display =
                                'none'; // Hide subjects not matching the selected sections
                        }
                    });
                } else {
                    // Show the "No section selected" message
                    document.getElementById('no-selection-message').style.display = 'block';

                    // Hide all subjects
                    document.querySelectorAll('#subjects .subject-option').forEach(function(subject) {
                        subject.style.display = 'none';
                    });
                }
            }

            // Update subjects when the page loads
            updateSubjects();

            // Update subjects when any section checkbox changes
            document.querySelectorAll('#sections input').forEach(function(checkbox) {
                checkbox.addEventListener('change', updateSubjects);
            });
        });

        //which photo selected 
        document.getElementById('profile_image').addEventListener('change', function () {
        var fileInput = this;
        var fileName = fileInput.files[0].name;
        var fileType = fileInput.files[0].type;

        // Check if the selected file is an image
        if (!fileType.startsWith('image/')) {
            alert('Please select a valid image file.');
            fileInput.value = ''; // Clear the input field if it's not an image
            document.getElementById('file-name').textContent = ''; // Clear file name display
        } else {
            document.getElementById('file-name').textContent = 'Selected File: ' + fileName; // Display file name
        }
    });
    </script>
@endsection
