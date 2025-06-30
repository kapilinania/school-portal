@extends('layouts.teacher')

@section('title', 'Student Details')

@section('content')

<div class="container mt-4">
    <h3>{{ __('Student Detail') }}</h3>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Exam Information</h4>
            <p>Exam Name: {{ $exam->exam_name }}</p>
            <p><strong>Section:</strong> {{ $exam->section->name }}</p>
            <p><strong>Subject:</strong> {{ $exam->subject->name }}</p>
            <p><strong>Exam Date:</strong> {{ \Carbon\Carbon::parse($exam->exam_date)->format('d F Y') }}</p>
            <p><strong>Duration:</strong> {{ $exam->duration }} minutes</p>
        </div>
    </div>

    <!-- Display Search Results -->
    @if($students->isNotEmpty())
        <form action="{{ route('teacher.generateResults') }}" method="POST" id="resultForm">
            @csrf
            <div class="table-responsive">
                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>{{ __('Student Name') }}</th>
                            <th>{{ __('Father Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Mobile Number') }}</th>
                            <th>{{ __('Class') }}</th>
                            <th>{{ __('Score') }}</th>
                            <th>{{ __('Exam Name') }}</th>
                            <th>{{ __('Teacher Name') }}</th>
                            <th>{{ __('Actions') }}</th>
                            <th>Copy Status</th>
                            <th>Result Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            @foreach($student->studentExams as $studentExam)
                                @if(
                                    $studentExam->exam->teacher->name === auth()->user()->name && 
                                    $student->section->id === $exam->section->id &&
                                    $studentExam->exam->exam_name === $exam->exam_name && 
                                    $studentExam->exam->subject->id === $exam->subject->id
                                )
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="students[]" value="{{ $studentExam->id }}" {{ $studentExam->result_generated ? 'disabled' : '' }}>
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->father_name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->mobile_number }}</td>
                                        <td>{{ $student->section->name }}</td>
                                        <td>{{ $studentExam->score ?? 'N/A' }}</td>
                                        <td>{{ $studentExam->exam->exam_name ?? 'No Exam' }}</td>
                                        <td>{{ $studentExam->exam->teacher->name ?? 'No Teacher' }}</td>
                                        <td>
                                            @if($studentExam)
                                                <a href="{{ route('teacher.questions.student_answers', [$studentExam->exam_id, $student->id]) }}" class="btn btn-info">View Answers</a>
                                            @else
                                                <span>No Answers</span>
                                            @endif
                                        </td>
                                        <td>0 or 1</td>
                                        <td>
                                            @if($studentExam->result_generated)
                                                <span class="text-success">Result Generated</span>
                                            @else
                                                <span class="text-danger">Waiting for Result</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mt-3" id="generateResultsBtn">Generate Results</button>
            </div>
        </form>

        <!-- Alert for Result Generation -->
        <div id="resultAlert" class="alert d-none mt-3" role="alert"></div>
    @else
        <p>{{ __('No students found matching the search criteria.') }}</p>
    @endif
</div>

@section('scripts')
<script>
    document.getElementById('resultForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Show the danger alert while processing
        var alertDiv = document.getElementById('resultAlert');
        alertDiv.className = "alert alert-danger";
        alertDiv.innerHTML = "Generating results... Please wait.";
        alertDiv.classList.remove('d-none');

        // Simulate an asynchronous operation (e.g., AJAX request)
        setTimeout(() => {
            // Here you can send the form data via AJAX or submit the form
            // For demo purposes, we simulate success
            alertDiv.className = "alert alert-success";
            alertDiv.innerHTML = "Results generated successfully!";
            alertDiv.classList.remove('d-none');

            // You can uncomment the following line to actually submit the form
            // this.submit();
        }, 2000); // Simulate a delay (2 seconds)
    });
</script>
@endsection

@endsection
