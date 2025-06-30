

@extends('layouts.student')

@section('title', 'Exam - Details')
@section('content')
<!-- <div class="container">
    <h2>Exams</h2>
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
    <table class="table">
        <thead>
            <tr>
                <th>Exam Name</th>
                <th>Section</th>
                <th>Teacher</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($exams as $exam)
                <tr>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->section }}</td>
                    <td>{{ $exam->teacher->name }}</td>
                    <td>{{ $exam->exam_date }}</td>
                    <td>{{ $exam->exam_time }}</td>
                    <td>
                        @php
                            $examDateTime = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $exam->exam_date . ' ' . $exam->exam_time, 'Asia/Kolkata');
                            $now = Carbon\Carbon::now('Asia/Kolkata');
                            $studentExam = App\Models\StudentExam::where('student_id', Auth::guard('student')->id())->where('exam_id', $exam->id)->first();
                        @endphp

                        @if ($studentExam)
                            <button class="btn btn-secondary" disabled>Already Submitted</button>
                        @elseif ($now->greaterThanOrEqualTo($examDateTime))
                            <a href="{{ route('student.exams.show', $exam->id) }}" class="btn btn-primary">Take Test</a>
                        @else
                            <button class="btn btn-secondary" disabled>Not Available</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No exams found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div> -->


<!-- -----side content goes here ---  -->

<div class="mt-4">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Exam Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Exam Details</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Exam Details</h3>
                                </div>
                                
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Class</th>
                                        <th>Teacher</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($exams as $exam)
                                    <tr>
                                        <td>{{ $exam->exam_name }}</td>
                                        <td>{{ $exam->section->name }}</td>
                                        <td>{{ $exam->teacher->name }}</td>
                                        <td>{{ $exam->exam_date }}</td>
                                        <td>{{ $exam->exam_time }}</td>
                                        <td>
                                            @php
                                                $examDateTime = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $exam->exam_date . ' ' . $exam->exam_time, 'Asia/Kolkata');
                                                $now = Carbon\Carbon::now('Asia/Kolkata');
                                                $studentExam = App\Models\StudentExam::where('student_id', Auth::guard('student')->id())->where('exam_id', $exam->id)->first();
                                            @endphp

                                            @if ($studentExam)
                                                <button class="btn btn-secondary" disabled>Already Submitted</button>
                                            @elseif ($now->greaterThanOrEqualTo($examDateTime))
                                                <a href="{{ route('student.exams.show', $exam->id) }}" class="btn btn-primary text-white">Take Test</a>
                                            @else
                                                <button class="btn btn-secondary" disabled>Not Available</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No exams found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
