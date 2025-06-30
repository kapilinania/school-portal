@extends('layouts.teacher')

@section('title', 'Teacher- Student Answer')

@section('content')




<!-- -----side content goes here ---  -->

<div class="">
    <div class="content container-fluid">
    <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ __('Student Answer') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('Student Answer') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Exam: {{ $exam->exam_name }}</h2>
        </div>
        <div class="card-body">
            <h4 class="text-primary">Student Information</h4>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                    <p><strong>Email:</strong> {{ $student->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Mobile Number:</strong> {{ $student->mobile_number }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Results Section -->
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Exam Results</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="result-info-box bg-light text-center p-3 mb-3 rounded shadow-sm">
                        <h5 class="text-secondary">Total Questions</h5>
                        <p class="display-4">{{ $questions->count() }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="result-info-box bg-light text-center p-3 mb-3 rounded shadow-sm">
                        <h5 class="text-secondary">Total Points</h5>
                        <p class="display-4">{{ $exam->total_points }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="result-info-box bg-light text-center p-3 mb-3 rounded shadow-sm">
                        <h5 class="text-secondary">Score</h5>
                        <p class="display-4 text-success" id="total-score">{{ $studentExam->score }}</p>
                    </div>
                </div>
            </div>
            <!-- Optionally, add a progress bar to show performance -->
            <div class="progress mt-4">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($studentExam->score / $exam->total_points) * 100 }}%;" aria-valuenow="{{ $studentExam->score }}" aria-valuemin="0" aria-valuemax="{{ $exam->total_points }}">
                    {{ round(($studentExam->score / $exam->total_points) * 100) }}%
                </div>
            </div>
        </div>
    </div>

    <!-- --another section si here---  -->
        

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">{{ __('Student Answer') }}</h3>
                                </div>
                                
                            </div>
                        </div>

                        <div class="table-responsive">
                        <form id="update-scores-form" action="{{ route('teacher.updateScores', ['studentExam' => $studentExam->id]) }}" method="POST">
                            @csrf
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                    <th>Question</th>
                                    <th>Question Type</th>
                                    <th>Question Image</th>
                                    <th>Options</th>
                                    <th>Selected Option/Answer</th>
                                    <th>Correct Option/Answer</th>
                                    <th>Points</th>
                                    <th>Number Given</th>
                                    <th>Result</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        @php
                                            $selectedOption = $studentExam->answers[$question->id] ?? 'No Answer';
                                            $correctOption = $question->correct_option;
                                            $isCorrect = $selectedOption === $correctOption;
                                            $currentPoints = $isCorrect && $question->question_type == 'objective' ? $question->points : 0;
                                            $updatedPoints = $studentExam->updated_points[$question->id] ?? ($question->question_type == 'subjective' ? 0 : null);
                                        @endphp
                                        <tr>
                                            <td>{{ $question->question }}</td>
                                            <td>{{ ucfirst($question->question_type) }}</td>
                                            <td>
                                                @if($question->question_image)
                                                    <img src="{{ asset('storage/' . $question->question_image) }}" alt="Question Image" width="100">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>
                                                @if($question->question_type == 'objective')
                                                    <ul>
                                                        <li>A: {{ $question->option_a }}</li>
                                                        <li>B: {{ $question->option_b }}</li>
                                                        <li>C: {{ $question->option_c }}</li>
                                                        <li>D: {{ $question->option_d }}</li>
                                                    </ul>
                                                @else
                                                    <p>N/A</p>
                                                @endif
                                            </td>
                                            <td>{{ $selectedOption }}</td>
                                            <td>
                                                @if($question->question_type == 'objective')
                                                    {{ ucfirst($correctOption) }}
                                                @else
                                                    {{ $question->subjective_answer }}
                                                @endif
                                            </td>
                                            <td>{{ $question->points }}</td>
                                            <td>
                                                @if ($question->question_type == 'subjective')
                                                    <input type="number" name="scores[{{ $question->id }}]" class="form-control subjective-score" value="{{ $updatedPoints }}" max="{{ $question->points }}" step="0.001">
                                                @else
                                                    {{ $isCorrect ? $question->points : 0 }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($isCorrect && $question->question_type == 'objective')
                                                    <span class="text-success">Correct</span>
                                                @elseif (!$isCorrect && $question->question_type == 'objective')
                                                    <span class="text-danger">Wrong</span>
                                                @else
                                                    <span class="text-info">Subjective</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>             
                        
                        <button type="submit" class="btn btn-primary mt-2">Update Scores</button>
                    </form>  
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('update-scores-form').addEventListener('submit', function (event) {
            // Confirmation alert
            const confirmation = confirm('Are you sure you want to update the student score?');
            if (!confirmation) {
                event.preventDefault(); // Stop form submission if the user clicks "Cancel"
                return;
            }

            const subjectiveScores = document.querySelectorAll('.subjective-score');
            let totalScore = {{ $studentExam->score }};
            let valid = true;

            subjectiveScores.forEach(function (input) {
                const maxPoints = parseFloat(input.getAttribute('max'));
                const score = parseFloat(input.value);

                if (score > maxPoints || isNaN(score)) {
                    alert('Score cannot be greater than the maximum points or invalid');
                    input.focus();
                    valid = false;
                    return false;
                }

                totalScore += score;
            });

            const examTotalPoints = {{ $exam->total_points }};
            if (totalScore > examTotalPoints) {
                alert('Total score cannot exceed the maximum points for the exam.');
                valid = false;
            }

            if (!valid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });
</script>
@endsection
