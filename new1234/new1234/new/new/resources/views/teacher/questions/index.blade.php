@extends('layouts.teacher')

@section('title', 'Exam -  Question')

@section('content')

<!-- -----side content goes here ---  -->

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

        <div class="page-header mt-4" >
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Questions for {{ $exam->exam_name }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $exam->exam_name }}</li>
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
                                    <h3 class="page-title">Questions </h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('teacher.questions.create', $exam->id) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Question</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>ID</th>
                                    <th>Question</th>
                                    <th>Question Type</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th>Correct Option / Answer</th>
                                    <th>Points</th>
                                    <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($questions as $question)
                                    <tr>
                                        <td>{{ $question->index }}</td>
                                        <td>{{ $question->question }}</td>
                                        <td>{{ ucfirst($question->question_type) }}</td>
                                        @if($question->question_type == 'objective')
                                            <td>{{ $question->option_a }}</td>
                                            <td>{{ $question->option_b }}</td>
                                            <td>{{ $question->option_c }}</td>
                                            <td>{{ $question->option_d }}</td>
                                            <td>{{ ucfirst($question->correct_option) }}</td>
                                        @else
                                            <td colspan="4">N/A</td>
                                            <td>{{ $question->subjective_answer }}</td>
                                        @endif
                                        <td>{{ $question->points }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('teacher.questions.edit', [$exam->id, $question->id]) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('teacher.questions.destroy', [$exam->id, $question->id]) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No questions found for this exam.</td>
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
