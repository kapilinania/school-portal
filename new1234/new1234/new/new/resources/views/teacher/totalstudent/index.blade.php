@extends('layouts.teacher')

@section('title', 'Total Students by Class')

@section('content')

<div class="mt-4">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ __('Student List') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('Student List') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                    <input type="text" id="search-id" class="form-control" placeholder="Search by ID ...">
                </div>
            </div>
            
            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                    <input type="text" id="search-class" class="form-control" placeholder="Search by Class Name ...">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="search-student-btn">
                    <button type="button" id="search-btn" class="btn btn-primary">Search</button>
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
                                    <h3 class="page-title">Student List</h3>
                                </div>
                            </div>
                        </div>
        
                        <div class="table-responsive">
                            <table id="students-table" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>ID</th>
                                        <th>Class Name</th>
                                        <th>Total Students</th>
                                        <th>Actions</th> <!-- Add this column for "View More" -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 1; @endphp
                                    @forelse($studentsGroupedBySection as $sectionId => $sectionData)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $sectionData['section']->name }}</td>
                                        <td>{{ $sectionData['total_students'] }}</td>
                                        <td>
                                            <a href="{{ route('teacher.totalstudent.show', ['class' => $sectionData['section']->id]) }}" class="btn btn-info text-white">View More</a>
                                        </td> <!-- Add View More button here -->
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No students found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <p id="no-data-message" style="display:none; color: red;">No data found</p> <!-- No data found message -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBtn = document.getElementById('search-btn');
        const searchId = document.getElementById('search-id');
        const searchClass = document.getElementById('search-class');
        const table = document.getElementById('students-table');
        const tbody = table.querySelector('tbody');
        const noDataMessage = document.getElementById('no-data-message');
    
        function filterTable() {
            const idValue = searchId.value.toLowerCase();
            const classValue = searchClass.value.toLowerCase();
    
            let hasData = false;
    
            Array.from(tbody.rows).forEach(row => {
                const idCell = row.cells[0].textContent.toLowerCase();
                const classCell = row.cells[1].textContent.toLowerCase();
    
                const matchesId = idValue === '' || idCell.includes(idValue);
                const matchesClass = classValue === '' || classCell.includes(classValue);
    
                if (matchesId && matchesClass) {
                    row.style.display = '';
                    hasData = true;
                } else {
                    row.style.display = 'none';
                }
            });
    
            noDataMessage.style.display = hasData ? 'none' : 'block';
        }
    
        searchBtn.addEventListener('click', filterTable);
        searchId.addEventListener('input', filterTable);
        searchClass.addEventListener('input', filterTable);
    });
</script>

@endsection
