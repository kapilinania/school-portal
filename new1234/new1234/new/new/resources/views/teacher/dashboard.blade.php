@extends('layouts.teacher')

@section('title', 'Teacher - Dashboard')

@section('content')

<div class="mt-4">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome {{ $teacher->name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Teacher</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Teacher ID</h6>
                                <h3>{{ $teacher->teacher_id }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-01.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Mobile Number</h6>
                                <h3>{{ $teacher->mobile_number }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Students Assigned</h6>
                                <h3>
                                    @php
                                        $totalStudents = 0; // Initialize total students
                                        foreach ($classWiseCounts as $data) {
                                            foreach ($data['subjects'] as $subjectData) {
                                                $totalStudents += $subjectData['student_count'];
                                            }
                                        }
                                        echo $totalStudents; // Display total students
                                    @endphp
                                </h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-02.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Subjects Assigned</h6>
                                <h3>{{ $totalSubjects }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-03.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-8">
                <div class="card flex-fill comman-shadow">
                    <div class="card-header">
                        <h5 class="card-title">Students Assigned by Section and Subject</h5>
                    </div>
                    <div class="pt-3 pb-3">
                        <div class="table-responsive lesson">
                            <table class="table table-center">
                                <thead>
                                    <tr>
                                        <th class="text-cener">Section</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-end">Student Count</th>
                                        {{-- <th>Students</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classWiseCounts as $sectionId => $data)
                                        @foreach ($data['subjects'] as $subject => $subjectData)
                                            <tr >
                                                <td>{{ $data['section_name'] }}</td>
                                                <td class="text-center">{{ $subject }}</td>
                                                <td>{{ $subjectData['student_count'] }}</td>
                                                {{-- <td>
                                                    <ul>
                                                        @foreach ($subjectData['students'] as $student)
                                                            <li>{{ $student->name }} ({{ $student->roll_number }})</li>
                                                        @endforeach
                                                    </ul>
                                                </td> --}}
                                            </tr>
                                        @endforeach
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
