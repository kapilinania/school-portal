@extends('layouts.teacher')

@section('title', 'Teacher- Result - Generate')

@section('content')



<div class="mt-4">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ __('Generate Results') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('Generate Results') }}</li>
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
                                    <h3 class="page-title">{{ __('Generate Results') }}</h3>
                                </div>
                                
                            </div>
                        </div>

                        <div class="table-responsive">
                            <form action="{{ route('teacher.generateResults') }}" method="POST">
                            @csrf
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>{{ __('Select') }}</th>
                                        <th>{{ __('Student Name') }}</th>
                                        <th>{{ __('Exam Name') }}</th>
                                        <th>{{ __('Result Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    @foreach($exams as $exam)
                                        @php
                                            $studentExam = $exam->studentResults->where('student_id', $student->id)->first();
                                        @endphp
                                        @if ($studentExam)
                                            <tr>
                                                <td><input type="checkbox" name="students[]" value="{{ $studentExam->id }}"></td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $exam->exam_name }}</td>
                                                <td>
                                                    @if ($studentExam->result_generated)
                                                        <span>Result Generated</span>
                                                    @else
                                                        <span>Waiting for Result</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary mt-3">Generate Results</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
