@extends('layouts.master')

@section('title', 'Teacher')



@section('content')




<!-- -----middle content goes here ---  -->

<div class="mt-4">
    <div class="content container-fluid">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Teacher</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('teachers') }}">Teacher</a></li>
                            <li class="breadcrumb-item active">All Teacher</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Form -->
        <div class="teacher-group-form">
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
        <!-- /Search Form -->

        <!-- Teacher Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Teacher</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-teacher table-hover table-center mb-0 datatable table-striped">
                                <thead class="teacher-thread">
                                    <tr>
                                        
                                        <th>Teacher ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($teachers as $teacher)
                                    <tr>
                                        
                                        <td>{{ $teacher->teacher_id }}</td> 
                                        <td>
                                            <a href="{{ route('admin.teachers.show', ['teacher' => $teacher->id]) }}" class="avatar avatar-sm me-2">
                                                <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $teacher->profile_image) }}" alt="User Image">
                                            </a>
                                            <a href="{{ route('admin.teachers.show', ['teacher' => $teacher->id]) }}">{{ $teacher->name }}</a>
                                            

                                        </td>
                                        
                                        
                                        
                                        
                                        <td>{{ $teacher->email }}</td>
                                        <td>{{ $teacher->mobile_number }}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                

                                                <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm mt-0 mt-0">
                                                    <a href="javascript:;"  class="btn btn-sm bg-success-light me-2">
                                                      <i class="feather-trash-2"></i>
                                                    </a>
                                                </button>
                                            </form>
                                                <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-sm bg-danger-light mt-1">
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
        <!-- /teachers Table -->
    </div>

    

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInputId = document.querySelector('input[placeholder="Search by ID ..."]');
    const searchInputName = document.querySelector('input[placeholder="Search by Name ..."]');
    const searchInputPhone = document.querySelector('input[placeholder="Search by Phone ..."]');
    const searchInputClass = document.querySelector('input[placeholder="Search by Class ..."]');
    const searchButton = document.querySelector('.search-student-btn button');
    const tableRows = document.querySelectorAll('.datatable tbody tr');

    searchButton.addEventListener('click', function() {
        const searchId = searchInputId.value.toLowerCase();
        const searchName = searchInputName.value.toLowerCase();
        const searchPhone = searchInputPhone.value.toLowerCase();
        const searchClass = searchInputClass.value.toLowerCase();
        let found = false;

        tableRows.forEach(row => {
            // Adjust column indices according to the actual table structure
            const id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            const name = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            const phone = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
            
            // You can skip class filtering if it's not present in the table
            if ((searchId === '' || id.includes(searchId)) &&
                (searchName === '' || name.includes(searchName)) &&
                (searchPhone === '' || phone.includes(searchPhone))) {
                row.style.display = '';
                found = true;
            } else {
                row.style.display = 'none';
            }
        });

        if (!found) {
            const noResults = document.createElement('tr');
            noResults.innerHTML = '<td colspan="5">Teacher not found</td>'; 
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

