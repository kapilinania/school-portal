@extends('layouts.teacher')

@section('title', 'Teacher- Edit')

@section('content')


<!-- -----side content goes here ---  -->

<div class="mt-4">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Create Exam</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Exam</a></li>
                            <li class="breadcrumb-item active">Edit Exam</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display error messages -->
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Display success messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation errors from Laravel -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form action="{{ route('teacher.exams.update', $exam->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title student-info">Edit Exam Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="exam_name">Exam Name <span class="login-danger">*</span></label>
                                        <input type="text" name="exam_name" class="form-control" id="exam_name" value="{{ old('exam_name', $exam->exam_name) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="section">Class<span class="login-danger">*</span></label>
                                        <select name="section" id="section" class="form-control" required>
                                            <option value="">Select Class</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section }}" @if($section == $exam->section) selected @endif>{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                    <label for="subject">Subject</label>
                                    <select name="subject_id" id="subject" class="form-control" required>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}" data-section="{{ $subject->section }}" @if($subject->id == $exam->subject_id) selected @endif>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="exam_date">Exam Date</label>
                                        <input type="date" name="exam_date" class="form-control" id="exam_date" value="{{ old('exam_date', $exam->exam_date) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="exam_time">Exam Time</label>
                                        <input type="time" name="exam_time" class="form-control" id="exam_time" value="{{ old('exam_time', $exam->exam_time) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="duration">Duration (HH:MM)</label>
                                        <input type="text" name="duration" class="form-control" id="duration" placeholder="00:30" value="{{ old('duration', $exam->duration) }}" required>
                                        <small class="form-text text-muted">Please enter time in HH:MM format. Example: 00:30 for 30 minutes.</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update Exam</button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionSelect = document.getElementById('section');
    const subjectSelect = document.getElementById('subject');
    const subjectOptions = Array.from(subjectSelect.options);

    sectionSelect.addEventListener('change', function() {
        const selectedSection = this.value;
        subjectSelect.innerHTML = '';
        subjectOptions.forEach(option => {
            if (option.dataset.section === selectedSection || option.value === '') {
                subjectSelect.appendChild(option);
            }
        });
    });

    sectionSelect.dispatchEvent(new Event('change')); // Initial trigger to filter subjects
});
</script>
@endsection
