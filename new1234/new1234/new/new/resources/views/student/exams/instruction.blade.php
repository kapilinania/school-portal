@extends('layouts.student')

@section('title', 'Exam Instructions')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Instructions for {{ $exam->exam_name }}</div>
                <div class="card-body">
                    <p><strong>Student:</strong> {{ $student->name }}</p>
                    <p><strong>Exam:</strong> {{ $exam->exam_name }}</p>
                    <p><strong>Instructions:</strong> Please read the instructions carefully before proceeding.</p>
                    <ol>
                        <li>1. Ensure you have a stable internet connection throughout the exam.</li>
                        <li>2. Do not refresh or close the browser during the exam.</li>
                        <li>3. Read each question carefully before answering.</li>
                        <li>4. You are not allowed to use external resources or ask for help during the exam.</li>
                        <li>5. Once you start the exam, make sure to submit your answers before the time runs out.</li>
                    </ol>
                    <a href="{{ route('student.show.rules', $exam->id) }}" class="btn btn-primary">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
