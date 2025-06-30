@extends('layouts.master')

@section('title', 'Teacher: Detail')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-white">
            <h3 class="mb-0">{{ $teacher->name }}</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Teacher ID:</strong> {{ $teacher->teacher_id }}</p>
                    <p><strong>Email:</strong> {{ $teacher->email }}</p>
                    <p><strong>Mobile Number:</strong> {{ $teacher->mobile_number }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    @if($teacher->profile_image)
                        <img src="{{ asset('storage/' . $teacher->profile_image) }}" 
                             class="img-fluid rounded-circle" 
                             alt="{{ $teacher->name }}'s Photo" 
                             style="max-width: 150px;">
                    @else
                        <p>No Photo Available</p>
                    @endif
                </div>
            </div>

            <h4 class="mt-4">Class & Subjects</h4>
            @php
                $sections = [];
                foreach ($teacher->subjects as $subject) {
                    $sections[$subject->pivot->section_id][] = $subject->name;
                }
            @endphp

            <div class="accordion" id="accordionExample">
                @foreach ($sections as $sectionId => $subjects)
                    @php
                        $section = \App\Models\Section::find($sectionId);
                    @endphp
                    <div class="accordion-item mb-3 shadow-sm" style="border-radius: 15px; border: 1px solid #ddd;">
                        <h2 class="accordion-header" id="heading{{ $sectionId }}">
                            <button class="accordion-button" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $sectionId }}" 
                                    aria-expanded="false" 
                                    aria-controls="collapse{{ $sectionId }}"
                                    style="background-color: #f8f9fa; color: #007bff; border-radius: 15px;">
                                {{ $section->name ?? 'Unknown Section' }}
                            </button>
                        </h2>
                        <div id="collapse{{ $sectionId }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $sectionId }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #fff; border-radius: 0 0 15px 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <ul class="list-group">
                                    @foreach ($subjects as $subjectName)
                                        <li class="list-group-item" style="border-radius: 10px; margin-bottom: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            {{ $subjectName }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h4 class="mt-4">Exams</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Exam Name</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Total Questions</th>
                            <th>Total Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teacher->exams as $exam)
                            <tr>
                                <td>{{ $exam->exam_name }}</td>
                                <td>{{ $exam->section->name }}</td>
                                <td>{{ $exam->subject->name ?? 'No Subject' }}</td>
                                <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('Y-m-d') }}</td>
                                <td>{{ $exam->exam_time }}</td>
                                <td>{{ $exam->total_questions }}</td>
                                <td>{{ $exam->total_points }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No exams found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


