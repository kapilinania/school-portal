@extends('layouts.master')

@section('content')
<div class="container my-5">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Add Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('students') }}">Student</a></li>
                        <li class="breadcrumb-item active">Add Students</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <!-- Student Profile Section -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body text-center">
                    <img src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('assets/default-avatar.png') }}" alt="Student Photo" class="img-fluid rounded-circle shadow mb-3" style="width: 120px; height: 120px;">
                    <h4 class="text-primary">{{ $student->name }}</h4>
                    <p class="text-muted">{{ $student->email }}</p>
                    <div class="mt-3">
                        <span class="badge  px-3 py-2" style="background-color: #3d5ee1">Class - {{ $student->section->name }}</span>

                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card shadow-sm border-0">
                <div class="card-header  text-white text-center">
                    <h5>Contact Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Father's Name:</strong> {{ $student->father_name }}</p>
                    <p><strong>Mobile Number:</strong> {{ $student->mobile_number }}</p>
                    <p><strong>Admission No:</strong> {{ $student->admission_no }}</p>
                    <p><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
                    <p><strong>Gender:</strong> {{ ucfirst($student->gender) }}</p>
                    {{-- <p><strong>Religion:</strong> {{ $student->religion }}</p> --}}
                    <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($student->dob)->format('d M, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Details Section -->
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header text-white">
                    <h4>Student Details</h4>
                </div>
                <div class="card-body">
                    <!-- Tab Buttons with JS-based Interaction -->
                    <div class="d-flex justify-content-between mb-4">
                        <button class="btn btn-outline-primary" id="btnTeachers">Assigned Teachers</button>
                        <button class="btn btn-outline-primary" id="btnResults">Exam Results</button>
                    </div>

                    <!-- Assigned Teachers Section -->
                    <div id="teachersSection">
                        <h5 class="text-secondary mb-3">Assigned Teachers</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Teacher Name</th>
                                        <th>Subjects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->name }}</td>
                                            <td>
                                                @foreach($teacher->subjects as $subject)
                                                    <span class="badge " style="background-color: #3d5ee1">{{ $subject->name }}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">No teachers assigned for this section.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Exam Results Section -->
                    <div id="resultsSection" style="display: none;">
                        <h5 class="text-secondary mb-3">Exam Results</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Teacher</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($student->examResults as $result)
                                        @php
                                            $exam = $result->exam;
                                            $totalPoints = $exam->total_points; // Total points from the exam
                                            $score = $result->score; // Score or points achieved by the student
                                            $percentage = $totalPoints > 0 ? ($score / $totalPoints) * 100 : 0; // Calculate percentage
                                            $progressClass = 'bg-success'; // Default color
                    
                                            // Change color based on percentage
                                            if ($percentage < 50) {
                                                $progressClass = 'bg-danger';
                                            } elseif ($percentage < 75) {
                                                $progressClass = 'bg-warning';
                                            } elseif ($percentage < 100) {
                                                $progressClass = 'bg-info';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $exam->exam_name }}</td>
                                            <td>{{ $exam->teacher->name }}</td>
                                            <td>
                                                {{-- {{ $score }}/{{ $totalPoints }} ({{ round($percentage, 2) }}%) --}}
                                                <div class="progress mt-2" style="height: 20px;">
                                                    <div class="progress-bar {{ $progressClass }}" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                        {{ round($percentage, 2) }}%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No exam results available.</td>
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

<!-- JavaScript for Tab Interaction -->
<script>
    document.getElementById('btnTeachers').addEventListener('click', function() {
        document.getElementById('teachersSection').style.display = 'block';
        document.getElementById('resultsSection').style.display = 'none';
    });

    document.getElementById('btnResults').addEventListener('click', function() {
        document.getElementById('teachersSection').style.display = 'none';
        document.getElementById('resultsSection').style.display = 'block';
    });
</script>
@endsection
