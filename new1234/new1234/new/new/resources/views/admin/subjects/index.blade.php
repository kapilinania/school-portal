@extends('layouts.master')

@section('title', 'Student : Subject')

@section('content')


    <!-- ---side content goes here --  -->

    <div class="mt-4">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subjects</li>
                        </ul>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="student-group-form">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by Class ...">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by Subject ...">
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
                                            <h3 class="page-title">Subjects</h3>
                                        </div>

                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            {{-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a> --}}
                                            <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th>Class</th>
                                                <th>Subjects</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subjects as $sectionId => $subjectGroup)
                                                <tr>
                                                    <!-- Retrieve the section name using section ID -->
                                                    <td>{{ $sections[$sectionId]->name ?? 'Unknown Section' }}</td>
                                                    <td>
                                                        @foreach ($subjectGroup as $subject)
                                                            {{ $subject->name }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="actions">
                                                            <!-- Delete Form -->
                                                            <form
                                                                action="{{ route('admin.subjects.destroy', ['section' => $sectionId]) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm bg-danger-light mt-1"
                                                                    onclick="return confirm('Are you sure you want to delete this subject?')">
                                                                    <i class="feather-trash"></i>
                                                                </button>
                                                            </form>

                                                            <!-- Edit Link -->
                                                            <a href="{{ route('admin.subjects.edit', ['section' => $sectionId]) }}"
                                                                class="btn btn-sm bg-success-light mt-1">
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
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInputClass = document.querySelector('input[placeholder="Search by Class ..."]');
            const searchInputSubject = document.querySelector('input[placeholder="Search by Subject ..."]');
            const searchButton = document.querySelector('.search-student-btn button');
            const tableRows = document.querySelectorAll('.datatable tbody tr');

            searchButton.addEventListener('click', function() {
                const searchClass = searchInputClass.value.toLowerCase();
                const searchSubject = searchInputSubject.value.toLowerCase();
                let found = false;

                tableRows.forEach(row => {
                    const className = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                    const subjectNames = row.querySelector('td:nth-child(2)').innerText
                    .toLowerCase();

                    // Check if the row matches both Class and Subject
                    if ((searchClass === '' || className.includes(searchClass)) &&
                        (searchSubject === '' || subjectNames.includes(searchSubject))) {
                        row.style.display = ''; // Show the row
                        found = true;
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });

                // Display "No results found" message if no match
                if (!found) {
                    const noResults = document.createElement('tr');
                    noResults.innerHTML = '<td colspan="3">No results found</td>';
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

            // Trigger search on Enter key press
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
