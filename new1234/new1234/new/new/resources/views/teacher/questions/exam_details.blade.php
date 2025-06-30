@extends('layouts.teacher')

@section('title', 'Exam - Details')

@section('content')

<div class="">
    <div class="content container-fluid">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="page-header mt-4">
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
                                    <h3 class="page-title">Exams List</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <!-- Optionally add a button to add new exams -->
                                    <!-- <a href="{{ route('teacher.exams.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Exam</a> -->
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Exam Name</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Total Questions</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($exams as $exam)
                                        <tr>
                                            <td>{{ $exam->id }}</td>
                                            <td>{{ $exam->exam_name }}</td>
                                            <td>{{ $exam->section->name ?? 'N/A' }}</td> <!-- Display N/A if section is null -->
                                            <td>{{ $exam->subject->name ?? 'N/A' }}</td> <!-- Display N/A if subject is null -->
                                            <td>{{ $exam->total_questions }}</td>
                                            <td>{{ $exam->duration }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No data available</td>
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
