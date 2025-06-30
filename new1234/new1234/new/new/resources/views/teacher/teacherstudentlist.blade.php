@extends('layouts.teacher')

@section('title', 'Teacher - Student List')

@section('content')

<div class="mt-4">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ __('Student List') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('Student List') }}</li>
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
                                    <h3 class="page-title">Student List</h3>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>{{ __('Student Name') }}</th>
                                        <th>{{ __('Father Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Mobile Number') }}</th>
                                        <th>{{ __('Class') }}</th>
                                        <th>{{ __('Score') }}</th>
                                        <th>{{ __('Exam Name') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->father_name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->mobile_number }}</td>
                                            <td>{{ $student->section->name }}</td>

                                            <!-- Calculate the score from exam results if available -->
                                            <td>
                                                @php
                                                    $studentExam = $exams->filter(function($exam) use ($student) {
                                                        return $exam->studentResults->where('student_id', $student->id)->first();
                                                    })->first();
                                                @endphp
                                                @if ($studentExam)
                                                    {{ $studentExam->studentResults->where('student_id', $student->id)->first()->score ?? 'N/A' }}
                                                @else
                                                    <span>Not Taken Exam</span>
                                                @endif
                                            </td>

                                            <!-- Display exam name if available -->
                                            <td>
                                                @if ($studentExam)
                                                    {{ $studentExam->exam_name }}
                                                @else
                                                    <span>No Exam</span>
                                                @endif
                                            </td>

                                            <!-- Action button to view student answers if the exam is taken -->
                                            <td>
                                                @if ($studentExam)
                                                    <a href="{{ route('teacher.questions.student_answers', [$studentExam->id, $student->id]) }}" class="btn btn-info">View Answers</a>
                                                @else
                                                    <span>No Answers</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">{{ __('No students found in your Class.') }}</td>
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
