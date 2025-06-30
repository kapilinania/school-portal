@extends('layouts.student')

@section('title', 'Exam Rules')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Exam Rules for {{ $exam->exam_name }}</div>
                <div class="card-body">
                    <p><strong>Rules:</strong> Please follow the rules and guidelines during the exam.</p>
                    <ol>
                        <li>1. Ensure your device is fully charged or plugged in throughout the exam.</li>
                        <li>2. Do not open any other browser windows or tabs during the exam.</li>
                        <li>3. Maintain silence and avoid any distractions during the exam.</li>
                        <li>4. Any attempt to cheat will result in disqualification from the exam.</li>
                        <li>5. The exam timer will continue even if your device gets disconnected; reconnect quickly if needed.</li>
                        <li>6. All answers must be submitted before the exam time expires, or they won't be counted.</li>
                    </ol>
                    <a href="{{ route('student.start.exam', $exam->id) }}" class="btn btn-primary">Start Exam</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
