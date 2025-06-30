@extends('layouts.master')

@section('title', 'Student : Department')

@section('content')
<div class="mt-3">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Classes</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Class</a></li>
                        <li class="breadcrumb-item active">Classes</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by ID ..." id="search-id">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by class ..." id="search-class">
                    </div>
                </div>
                
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="button" class="btn btn-primary" id="search-button">Search</button>
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
                                        <h3 class="page-title">Classes</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('admin.sections.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>ID</th> <!-- ID Column Added -->
                                        <th>Class</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sections as $section)
                                        <tr>
                                            <td class="serial-number">{{ $section->id }}</td> <!-- Display ID -->
                                            <td>{{ $section->name }}</td>
                                            <td class="text-center">
                                                <div class="actions">
                                                    <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.sections.destroy', $section->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to delete this class?')">
                                                            <i class="feather-trash"></i>
                                                        </button>
                                                    </form>
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
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInputId = document.getElementById('search-id');
    const searchInputClass = document.getElementById('search-class');
    const searchButton = document.getElementById('search-button');
    const tableRows = document.querySelectorAll('.datatable tbody tr');

    // Function to update serial numbers
    function updateSerialNumbers() {
        let serial = 1;
        tableRows.forEach(row => {
            if (row.style.display !== 'none') { // Only for visible rows
                row.querySelector('.serial-number').innerText = serial++;
            }
        });
    }

    // Search button functionality
    searchButton.addEventListener('click', function() {
        const searchId = searchInputId.value.toLowerCase();
        const searchClass = searchInputClass.value.toLowerCase();
        let found = false;

        tableRows.forEach(row => {
            const id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            const className = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            
            // Check if the row matches the search
            if ((searchId === '' || id.includes(searchId)) &&
                (searchClass === '' || className.includes(searchClass))) {
                row.style.display = ''; // Show row
                found = true;
            } else {
                row.style.display = 'none'; // Hide row
            }
        });

        // If no results found
        const existingNoResults = document.querySelector('.no-results');
        if (!found) {
            if (!existingNoResults) {
                const noResults = document.createElement('tr');
                noResults.innerHTML = '<td colspan="3">No results found</td>'; 
                noResults.classList.add('no-results');
                document.querySelector('.datatable tbody').appendChild(noResults);
            }
        } else {
            if (existingNoResults) {
                existingNoResults.remove();
            }
        }

        updateSerialNumbers(); // Update serial numbers after search
    });

    // Update serial numbers on page load
    updateSerialNumbers();

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
