@extends('layouts.teacher')

@section('title', 'Exam - Edit')

@section('content')

    <!-- -----side content goes here ---  -->

    <div class="">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Question Edit</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Question</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

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
                            <form action="{{ route('teacher.questions.update', [$exam->id, $question->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- MCQ Fields -->
                                    <div class="col-12">
                                        <h5 class="form-title student-info mt-4">MCQ Question Details</h5>
                                    </div>
                                    <!-- Exam Details -->
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label for="exam_name">Exam Name</label>
                                            <input type="text" class="form-control" name="exam_name" id="exam_name" value="{{ old('exam_name', $exam->exam_name) }}" required>
                                            @error('exam_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label for="section">Section</label>
                                            <input type="text" class="form-control" name="section" id="section" value="{{ old('section', $exam->section) }}" required>
                                            @error('section')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label for="exam_date">Exam Date</label>
                                            <input type="date" class="form-control" name="exam_date" id="exam_date" value="{{ old('exam_date', $exam->exam_date) }}" required>
                                            @error('exam_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label for="exam_time">Exam Time</label>
                                            <input type="time" class="form-control" name="exam_time" id="exam_time" value="{{ old('exam_time', $exam->exam_time) }}" required>
                                            @error('exam_time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label for="duration">Duration (in minutes)</label>
                                            <input type="text" class="form-control" name="duration" id="duration" value="{{ old('duration', $exam->duration) }}" required>
                                            @error('duration')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                            
                                    <!-- Question Details -->
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label for="question">Question Name <span class="login-danger">*</span></label>
                                            <input name="question" class="form-control" type="text" value="{{ old('question', $question->question) }}" placeholder="Enter Question Name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label for="question_type">Question Type <span class="login-danger">*</span></label>
                                            <select name="question_type" class="form-control" required>
                                                <option value="objective" {{ old('question_type', $question->question_type) == 'objective' ? 'selected' : '' }}>Objective</option>
                                                <option value="subjective" {{ old('question_type', $question->question_type) == 'subjective' ? 'selected' : '' }}>Subjective</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if (old('question_type', $question->question_type) == 'objective')
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label for="option_a">Option A <span class="login-danger">*</span></label>
                                                <input type="text" name="option_a" class="form-control" value="{{ old('option_a', $question->option_a) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label for="option_b">Option B <span class="login-danger">*</span></label>
                                                <input type="text" name="option_b" class="form-control" value="{{ old('option_b', $question->option_b) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label for="option_c">Option C</label>
                                                <input type="text" name="option_c" class="form-control" value="{{ old('option_c', $question->option_c) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label for="option_d">Option D</label>
                                                <input type="text" name="option_d" class="form-control" value="{{ old('option_d', $question->option_d) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label for="correct_option">Correct Option <span class="login-danger">*</span></label>
                                                <select name="correct_option" class="form-control" required>
                                                    <option value="option_a" {{ old('correct_option', $question->correct_option) == 'option_a' ? 'selected' : '' }}>Option A</option>
                                                    <option value="option_b" {{ old('correct_option', $question->correct_option) == 'option_b' ? 'selected' : '' }}>Option B</option>
                                                    <option value="option_c" {{ old('correct_option', $question->correct_option) == 'option_c' ? 'selected' : '' }}>Option C</option>
                                                    <option value="option_d" {{ old('correct_option', $question->correct_option) == 'option_d' ? 'selected' : '' }}>Option D</option>
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label for="subjective_answer">Subjective Answer</label>
                                                <input type="text" name="subjective_answer" class="form-control" value="{{ old('subjective_answer', $question->subjective_answer) }}">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label for="points">Points <span class="login-danger">*</span></label>
                                            <input type="number" name="points" class="form-control" value="{{ old('points', $question->points) }}" required>
                                        </div>
                                    </div>
                            
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="image">Image (optional)</label>
                                            <input type="file" class="form-control-file" name="image" id="image">
                                            @if ($question->image)
                                                <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                                            @endif
                                        </div>
                                    </div>
                            
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Update Question</button>
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
