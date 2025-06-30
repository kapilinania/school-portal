@extends('layouts.teacher')

@section('title', 'Teacher - Exam')

@section('content')
<div class="mt-4">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Schedule New Exam</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Schedule New Exam</li>
                    </ul>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($exams->isEmpty())
            <p>No exams have been created yet.</p>
        @else
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Exam Name ...">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Class ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="button" class="btn btn-primary">Search</button>
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
                                        <h3 class="page-title">Scheduled Exams</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('teacher.exams.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Schedule New Exam
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Exam Name</th>
                                            <th>Class</th>
                                            <th>Duration</th>
                                            <th>Exam Date</th>
                                            <th>Subject</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($exams as $exam)
                                            <tr>
                                                <td>{{ $exam->exam_name }}</td>
                                                <td>{{ $exam->section->name }}</td>
                                                <td>{{ $exam->duration }}</td>
                                                <td>{{ $exam->subject ? $exam->subject->name : 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d F Y') }}</td>
                                                <td class="text-end">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('teacher.exams.edit', $exam->id) }}" class="btn btn-warning text-dark">Edit</a>
                                                    
                                                    <!-- Delete Form with Confirmation -->
                                                    <form action="{{ route('teacher.exams.destroy', $exam->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this exam?');">Delete</button>
                                                    </form>
                                    
                                                    <!-- Add Questions Button -->
                                                    <a href="{{ route('teacher.questions.create', $exam->id) }}" class="btn btn-success text-white">Add Questions</a>
                                    
                                                    <!-- Student Detail Button -->
                                                    <a href="{{ route('teacher.exams.studentDetail', $exam->id) }}" class="btn btn-info text-white">Student Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputExamName = document.querySelector('input[placeholder="Search by Exam Name ..."]');
        const searchInputClass = document.querySelector('input[placeholder="Search by Class ..."]');
        const searchButton = document.querySelector('.search-student-btn button');
        const tableRows = document.querySelectorAll('.datatable tbody tr');

        searchButton.addEventListener('click', function() {
            const searchExamName = searchInputExamName.value.toLowerCase();
            const searchClass = searchInputClass.value.toLowerCase();
            let found = false;

            tableRows.forEach(row => {
                const examName = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                const className = row.querySelector('td:nth-child(2)').innerText.toLowerCase();

                if ((searchExamName === '' || examName.includes(searchExamName)) &&
                    (searchClass === '' || className.includes(searchClass))) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            if (!found) {
                const noResults = document.createElement('tr');
                noResults.innerHTML = '<td colspan="4" class="text-center">No results found</td>';
                noResults.classList.add('no-results');
                const existingNoResults = document.querySelector('.no-results');
                if (!existingNoResults) {
                    document.querySelector('.datatable tbody').appendChild(noResults);
                }
            } else {
                const existingNoResults = document.querySelector('.no-results');
                if (existingNoResults) {
                    existingNoResults.remove();
                }
            }
        });

        document.querySelectorAll('input[placeholder]').forEach(input => {
            input.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    searchButton.click();
                }
            });
        });
    });
</script>
@endsection
