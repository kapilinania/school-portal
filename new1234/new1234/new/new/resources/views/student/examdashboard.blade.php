@extends('layouts.student') {{-- Use your existing layout here --}}
@section('content')

<style>
    /* Card Hover Effect */
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(0, 123, 255, 0.5); /* Add a subtle border */
    }

    /* List Item Hover Effect */
    .list-group-item {
        transition: background-color 0.3s, color 0.3s;
        border-radius: 5px; /* Rounded corners for list items */
    }
    
    .list-group-item:hover {
        background-color: rgba(0, 123, 255, 0.1); /* Light blue background */
        color: #007bff; /* Change text color on hover */
    }

    /* Exam Card Styling */
    .exam-card {
        border: 0px solid #007bff; /* Border color for exam cards */
        border-radius: 10px; /* Rounded corners for exam cards */
        transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
    }

    .exam-card:hover {
        background-color: rgba(0, 123, 255, 0.1); /* Light blue background */
        transform: scale(1.05); /* Slightly increase size */
        box-shadow: 0 10px 30px rgba(0, 123, 255, 0.2); /* Light shadow on hover */
    }
</style>

<div class="container my-5">
    <h2 class="text-center mb-4">Exam Dashboard</h2>

    <div class="row">
        <!-- User Information Card -->
        <div class="col-md-12">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Welcome, {{ $student->name }}</h4>
                </div>
                <div class="card-body">
                    <p class="lead"><strong>Section:</strong> {{ $studentSection->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Assigned Subjects Card -->
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Assigned Subjects</h4>
                </div>
                <div class="card-body">
                    @if($studentSubjects->isEmpty())
                        <p class="text-muted">No subjects assigned to this student.</p>
                    @else
                        <ul class="list-group">
                            @foreach($studentSubjects as $subject)
                                <li class="list-group-item border-0">{{ $subject->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Assigned Teachers Card -->
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Assigned Teachers</h4>
                </div>
                <div class="card-body">
                    @if($teacherCount === 0)
                        <p class="text-muted">No teachers assigned to this student's subjects.</p>
                    @else
                        <ul class="list-group">
                            @foreach($teachers as $teacher)
                                <li class="list-group-item border-0">
                                    {{ $teacher->name }} (Subjects:
                                    @foreach($teacher->subjects as $subject)
                                        {{ $subject->name }}@if(!$loop->last), @endif
                                    @endforeach
                                    )
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Exams Card -->
        <div class="col-md-12">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Exams</h4>
                </div>
                <div class="card-body">
                    @if($exams->isEmpty())
                        <p class="text-muted">No exams available for this section.</p>
                    @else
                        <div class="row">
                            @foreach($exams as $exam)
                                <div class="col-md-3 mb-4">
                                    <div class="exam-card shadow-sm">
                                        <div class="card-header">
                                            <strong>Exam Name : {{ $exam->exam_name }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <i class="bi bi-book-fill"></i> <strong>Subject:</strong> {{ $exam->subject->name }}
                                            </div>
                                            <div class="mb-2">
                                                <i class="bi bi-calendar-event"></i> <strong>Date:</strong> {{ \Carbon\Carbon::parse($exam->exam_date)->format('F j, Y') }}
                                            </div>
                                            <div class="mb-2">
                                                <i class="bi bi-clock-fill"></i> <strong>Time:</strong> {{ \Carbon\Carbon::parse($exam->exam_time)->format('g:i A') }}
                                            </div>
                                            <div class="mb-2">
                                                <i class="bi bi-stopwatch"></i> <strong>Duration:</strong> {{ $exam->duration }} minutes
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{ route('student.show.instruction', $exam->id) }}" class="btn btn-outline-primary btn-sm">Start Exam</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
