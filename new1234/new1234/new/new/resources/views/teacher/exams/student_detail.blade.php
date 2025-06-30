@extends('layouts.teacher')

@section('title', 'Exam Student Details')

@section('content')
<div class="mt-4">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Exam Details: {{ $exam->exam_name }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Exam Student Details</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Exam Information</h4>
                <p><strong>Section:</strong> {{ $exam->section->name }}</p>
                <p><strong>Subject:</strong> {{ $exam->subject->name }}</p>
                <p><strong>Exam Date:</strong> {{ \Carbon\Carbon::parse($exam->exam_date)->format('d F Y') }}</p>
                <p><strong>Duration:</strong> {{ $exam->duration }} minutes</p>
                <p><strong>Total Students:</strong> {{ $totalStudents }}</p>
                <p><strong>Students Submitted:</strong> {{ $studentsSubmitted }}</p>
            </div>
        </div>

       
    </div>
</div>



<div class="container">
    <h1>Student Details for Exam: {{ $exam->exam_name }}</h1>
    
    @if ($students->isEmpty())
        <div class="alert alert-warning">
            No students found for this exam.
        </div>
    @else
        <div class="card">
            <div class="card-header">
                Total Students: {{ $totalStudents }} | Submitted: {{ $studentsSubmitted }}
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->section->name }}</td>
                                <td>
                                    @if ($student->pivot->submitted) <!-- Check if submitted -->
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
