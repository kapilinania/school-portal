@php
use Carbon\Carbon;
@endphp

@extends('layouts.student')

@section('title', 'Student - Dashboard')

@section('content')

<div class="mt-4">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome {{ $student->name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Student</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Registration Number</h6>
                                <h3>{{ $student->admission_no }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-01.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Assigned Teacher(s)</h6>
                                <h3>{{ $teacherCount }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-02.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Mobile Number</h6>
                                <h3>{{ $student->mobile_number }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/student-icon-01.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Student Name</h6>
                                <h3>{{ $student->name }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/student-icon-02.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <!-- Student's Section -->
       <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Your Information</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">
                    <h5>Your Section:</h5>
                    <span class="text-primary fw-bold">{{ $studentSection->name }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5>Your Subjects:</h5>
                    <div class="d-flex flex-wrap">
                        @if($studentSubjects->isEmpty())
                            <span class="badge bg-secondary text-white">No Subjects Assigned</span>
                        @else
                            @foreach ($studentSubjects as $subject)
                                <span class="badge bg-info text-white me-2 mb-2">{{ $subject->name }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Teachers and their Subjects -->
<div class="row mt-4">
    <div class="col-12">
        <h4>Your Teachers and Subjects</h4>
        @if($teachers->isEmpty())
            <div class="alert alert-warning" role="alert">
                No teachers assigned to your section.
            </div>
        @else
            <div class="row">
                @foreach($teachers as $teacher)
                    <div class="col-md-4 mb-3">
                        <div class="card border-light shadow-sm hover-shadow">
                            <div class="card-body">
                                <h5 class="card-title d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i>
                                    {{ $teacher->name }}
                                </h5>
                                <p class="card-text">
                                    Subjects: 
                                    @foreach ($teacher->subjects as $subject)
                                        <span class="">{{ $subject->name }}</span>@if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Optional: Include Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!-- Optional: Add a bit of CSS for hover effects -->
<style>
    .hover-shadow {
        transition: box-shadow 0.3s ease;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
</style>


    </div>
</div>

@endsection
