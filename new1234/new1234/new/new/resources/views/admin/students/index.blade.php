@extends('layouts.master')

@section('title', 'Student')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('students') }}">Student</a></li>
                        <li class="breadcrumb-item active">All Students</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <!-- Search Form -->
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-2 col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by ID ...">
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by Name ...">
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by Phone ...">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by Class ...">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="search-student-btn">
                    <button type="button" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Students</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                {{-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a> --}}
                                <a href="{{ route('admin.students.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th style="display: none">
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </th>
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>Admission Number</th>
                                    <th>DOB</th>
                                    <th>Parent Name</th>
                                    <th>Mobile Number</th>
                                    <th>Class</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td style="display: none">
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </td>
                                    {{-- <td>{{ $student->id }}</td> --}}
                                    <td>
                                        @if($student->photo)
                                            <a href="{{ url('student-details') }}" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{ asset('storage/' . $student->photo) }}" alt="User Image"></a>
                                            <a href="{{ route('admin.students.show', ['student' => $student->id ?? 1]) }}"  style="color: blue">{{ $student->name }}</a>
                                        @else
                                            No Photo
                                        @endif
                                    </td>
                                    <td>{{ $student->admission_no }}</td>
                                    <td>{{ $student->dob }}</td>
                                    <td>{{ $student->father_name }}</td>
                                    <td>{{ $student->mobile_number }}</td>
                                    <td>{{ $student->section->name ?? 'No Section' }}</td>

                                    <td class="text-end">
                                        <div class="actions">
                                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm mt-0 mt-0">
                                                    <a href="javascript:;" class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-trash-2"></i>
                                                    </a>
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm bg-danger-light mt-1">
                                                <i class="feather-edit"></i>
                                            </a>
                                        </div>
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
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInputs = {
        id: document.querySelector('input[placeholder="Search by ID ..."]'),
        name: document.querySelector('input[placeholder="Search by Name ..."]'),
        phone: document.querySelector('input[placeholder="Search by Phone ..."]'),
        studentClass: document.querySelector('input[placeholder="Search by Class ..."]')
    };
    const tableRows = document.querySelectorAll('.datatable tbody tr');

    // Function to filter the table based on input values
    function filterTable() {
        const searchValues = {
            id: searchInputs.id.value.toLowerCase(),
            name: searchInputs.name.value.toLowerCase(),
            phone: searchInputs.phone.value.toLowerCase(),
            studentClass: searchInputs.studentClass.value.toLowerCase()
        };
        let found = false;

        tableRows.forEach(row => {
            const id = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            const name = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
            const phone = row.querySelector('td:nth-child(7)').innerText.toLowerCase();
            const studentClass = row.querySelector('td:nth-child(8)').innerText.toLowerCase();

            // Checking if the row matches the search criteria
            if (
                (searchValues.id === '' || id.includes(searchValues.id)) &&
                (searchValues.name === '' || name.includes(searchValues.name)) &&
                (searchValues.phone === '' || phone.includes(searchValues.phone)) &&
                (searchValues.studentClass === '' || studentClass.includes(searchValues.studentClass))
            ) {
                row.style.display = ''; // Show row
                found = true;
            } else {
                row.style.display = 'none'; // Hide row
            }
        });

        // Handle case where no results are found
        const noResultsRow = document.querySelector('.no-results');
        if (!found) {
            if (!noResultsRow) {
                const noResults = document.createElement('tr');
                noResults.classList.add('no-results');
                noResults.innerHTML = '<td colspan="9">Student not found</td>';
                document.querySelector('.datatable tbody').appendChild(noResults);
            }
        } else {
            if (noResultsRow) {
                noResultsRow.remove();
            }
        }
    }

    // Adding event listeners to each input field to trigger filtering on every input change
    Object.values(searchInputs).forEach(input => {
        input.addEventListener('input', filterTable);
    });
});
</script>
@endsection

